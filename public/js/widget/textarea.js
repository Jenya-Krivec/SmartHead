'use strict';
class Textarea {
    constructor() {
        this.textarea = document.querySelector('textarea');
        this.fileContainer = document.getElementById('file-container');
        this.subject = document.querySelector('input[name="subject"]');
    }
    addEventListeners() {
        this.textarea.addEventListener('input', this.resize.bind(this));
    }
    resize(){
        this.textarea.style.height = "auto";
        let height=Math.max(this.textarea.scrollHeight, this.textarea.offsetHeight) - 17;
        this.textarea.style.height = height + "px";
        this.textarea.style.overflow = height > 300 ? 'visible' : null;
        this.subject.style.bottom =  height > 176 ? 176 + "px" : height + "px";
        this.fileContainer.style.bottom =  height > 176 ? 216 + "px" : (height + 40) + "px";
    }
}
new Textarea().addEventListeners();
