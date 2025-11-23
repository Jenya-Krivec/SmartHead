'use strict';
class Chat{
    constructor(){
        this.messagesContainer = document.getElementById('message-container');
        this.inputContainer = document.getElementById('input-container');
        this.attach = document.getElementById('attach');
        this.fileContainer = document.getElementById('file-container');
        this.sendBtn = document.getElementById('send-btn');
        this.error = document.getElementById('error');
        this.name = document.querySelector('input[name="name"]');
        this.phone = document.querySelector('input[name="phone"]');
        this.email = document.querySelector('input[name="email"]');
        this.subject = document.querySelector('input[name="subject"]');
        this.message = document.querySelector('textarea[name="message"]');
        this.file = null;
        this.param = {};
        this.token = null;
        this.expireToken = null;
        this.setToken();
        this.displayInputs();
        this.defaultDate = '2025-11-23 00:00:00';
        this.getTickets();
        setInterval(this.getTickets.bind(this), 5000);
        this.incomingMessageClass = 'border-2 border-gray-200 px-2 pt-2 mt-2 bg-white rounded-l-lg rounded-tr-lg ml-10';
        this.outgoingMessageClass = 'border-2 border-gray-200 px-2 pt-2 mt-2 bg-white rounded-r-lg rounded-tl-lg mr-10';
        this.subjectClass = 'border-b-2 border-gray-200';
        this.textClass = 'text-xs';
        this.fileClass = 'text-blue-500 text-xs border-t-2 border-gray-200';
        this.dateStyle = 'font-size:8px;';
    }
    addEventListeners(){
        let inputFile = this.attach.children[1];
        this.attach.children[0].addEventListener('click', function(){inputFile.click();});
        inputFile.addEventListener('change', this.addFile.bind(this));
        this.fileContainer.children[1].addEventListener('click', this.removeFile.bind(this));
        this.sendBtn.addEventListener('click', this.send.bind(this));
        this.error.children[0].children[1].addEventListener('click', this.closeError.bind(this));
    }
    setToken(){
        let token = localStorage.getItem('widgetToken');
        if (!token) {
            this.expireToken = 'customer_' + Math.random().toString(36).substring(2) + Date.now();
        }else {
            this.token= token;
        }
    }
    displayInputs(){
        if (!this.token) {
            this.name.classList.remove('hidden');
            this.phone.classList.remove('hidden');
            this.email.classList.remove('hidden');
        }
    }
    hideInputs(){
        !this.name.classList.contains('hidden') ? this.name.classList.add('hidden') : '';
        !this.phone.classList.contains('hidden') ? this.phone.classList.add('hidden') : '';
        !this.email.classList.contains('hidden') ? this.email.classList.add('hidden') : '';
    }
    clearInputs(){
        this.name.value = '';
        this.phone.value = '';
        this.email.value = '';
        this.subject.value = '';
        this.message.value = '';
    }
    saveToken(token){
        this.token = token;
        localStorage.setItem('widgetToken', this.token);
    }
    addFile(event){
        let element=event.target;
        this.file=element.files[0];
        this.fileContainer.children[0].innerHTML=this.file.name;
        this.fileContainer.classList.remove('hidden');
        this.inputContainer.classList.remove('h-12');
        this.inputContainer.classList.add('h-18');
    }
    removeFile(){
        this.file=null;
        this.fileContainer.children[0].innerHTML='';
        this.fileContainer.classList.add('hidden');
        this.inputContainer.classList.add('h-12');
        this.inputContainer.classList.remove('h-18');
    }
    setData(){
        this.param={
            'name':this.name.value,
            'phone':this.phone.value,
            'email':this.email.value,
            'subject':this.subject.value,
            'message':this.message.value,
            'token':this.token ? this.token : this.expireToken,
            'isIncoming':1,
        };
        if(this.file){
            this.param['file']=this.file;
        }
    }
    getData(){
        this.setData();
        let data = new FormData();
        for (let key in this.param){
            data.append(key, this.param[key]);
        }
        return data;
    }
    getCSRF(){
        return document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    }
    send(){
        this.closeError();
        const options = {
            method: 'POST',
            body: this.getData(),
            headers: {
                'X-CSRF-TOKEN': this.getCSRF()
            }
        };
        fetch('/api/tickets', options).then(async response => {
                if (!response.ok) {
                    if (response.status === 422) {
                        const errorData = await response.json();
                        throw errorData.errors;
                    }
                    throw new Error(response.status);
                }
                return response.json();
            }).then(data => {
                this.saveToken(data.data.token);
                this.hideInputs();
                this.clearInputs();
                if (this.file) {
                    this.removeFile();
                }
                Number(data.data.getTickets) ? this.getTickets() : this.insertMessage(data.data);
            }).catch(errors => {
                this.displayError(errors);
            });
    }
    displayError(errors){
        this.error.classList.remove('hidden');
        for (let key in errors) {
            this.error.children[1].innerHTML += "<p class='text-red-500'>"+errors[key][0]+"</p>";
        }
    }
    closeError(){
        this.error.classList.add('hidden');
        this.error.children[1].innerHTML = '';
    }
    getLastMessage(){
        return this.messagesContainer.children.length > 0 ? this.messagesContainer.lastElementChild.lastElementChild.innerHTML : this.defaultDate;
    }
    getTickets(){
        if (!this.token) {
            return null;
        }
        this.closeError();
        const options = {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': this.getCSRF()
            }
        };
        fetch('/api/tickets?token='+this.token+'&created_at='+this.getLastMessage(), options).then(async response => {
            if (!response.ok) {
                if (response.status === 422) {
                    const errorData = await response.json();
                    throw errorData.errors;
                }
                throw new Error(response.status);
            }
            return response.json();
        }).then(data => {
            this.insertMessages(data.data);
        }).catch(errors => {
            console.log(errors);
        });
    }
    insertMessages(messages){
        for (let i = 0; i < messages.length; i++) {
            this.insertMessage(messages[i]);
        }
    }
    insertMessage(message){
        const messageContainer = document.createElement('div');
        const subject = document.createElement('div');
        const text = document.createElement('div');
        const date = document.createElement('div');
        messageContainer.className = Number(message.is_incoming) ? this.incomingMessageClass : this.outgoingMessageClass;
        subject.className = this.subjectClass;
        subject.textContent = message.subject;
        text.className = this.textClass;
        text.textContent = message.text;
        date.style = this.dateStyle;
        date.className = 'date';
        date.textContent = message.created_at;
        messageContainer.appendChild(subject);
        messageContainer.appendChild(text);
        if (message.file) {
            const file = document.createElement('div');
            file.className = this.fileClass;
            file.textContent = message.file;
            messageContainer.appendChild(file);
        }
        messageContainer.appendChild(date);
        this.messagesContainer.appendChild(messageContainer);
        messageContainer.scrollIntoView({block: "start", behavior: "smooth"});
    }

}
new Chat().addEventListeners();
