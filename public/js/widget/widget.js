'use strict';
class Widget {
    constructor() {
        this.openBtn = null;
        this.openBtnClass = 'fixed bottom-8 right-8 bg-blue-500 text-white py-4 px-4 rounded-full cursor-pointer z-20';
        this.openBtnId = 'widget-open-btn';
        this.openBtnText = "💬";
        this.closeBtn = null;
        this.closeBtnClass = 'hidden flex items-center justify-center fixed h-6 w-6 bottom-114 right-10 bg-blue-500 text-white rounded-full cursor-pointer z-20';
        this.closeBtnId = 'widget-close-btn';
        this.closeBtnText = 'X';
        this.iframe = null;
        this.iframeClass = 'fixed bottom-8 right-8 w-80 h-114 z-10 rounded-lg hidden';
        this.iframeSrc = "/widget";
    }
    run() {
        this.addOpenBtn();
        this.addCloseBtn();
        this.addFrame();
    }
    addEventListeners() {
        this.openBtn.addEventListener('click', this.toggleBtn.bind(this));
        this.closeBtn.addEventListener('click', this.toggleBtn.bind(this));
    }
    addOpenBtn() {
        this.openBtn = document.createElement('div');
        this.openBtn.id = this.openBtnId;
        this.openBtn.textContent = this.openBtnText;
        this.openBtn.setAttribute('class', this.openBtnClass);
        document.body.appendChild(this.openBtn);
    }
    addCloseBtn() {
        this.closeBtn = document.createElement('div');
        this.closeBtn.id = this.closeBtnId;
        this.closeBtn.textContent = this.closeBtnText;
        this.closeBtn.setAttribute('class', this.closeBtnClass);
        document.body.appendChild(this.closeBtn);
    }
    addFrame() {
        this.iframe = document.createElement('iframe');
        this.iframe.src = this.iframeSrc;
        this.iframe.setAttribute('class', this.iframeClass);
        document.body.appendChild(this.iframe);
    }
    toggleBtn() {
        this.openBtn.classList.toggle('hidden');
        this.closeBtn.classList.toggle('hidden');
        this.iframe.classList.toggle('hidden');
    }
}
const widget = new Widget();
widget.run();
widget.addEventListeners();
