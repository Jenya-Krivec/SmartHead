'use strict';
class Chat{
    constructor(){
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
            'isIncoming':0,
        };
        if(this.file){
            this.param['file']=this.file;
        }
    }
    getData(){
        this.setData();
        return JSON.stringify(this.param);
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
                'Content-Type': 'application/json',
                'Accept': 'application/json',
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
                this.getTickets();
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

}
new Chat().addEventListeners();
