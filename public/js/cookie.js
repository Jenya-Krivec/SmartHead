'use strict';
class Cookie {
    constructor() {
        this.cookie = document.getElementById('cookie-message');
        this.cookieAccept = document.getElementById('cookie-accept');
        this.cookieDecline = document.getElementById('cookie-decline');
    }
    addEventListeners() {
        setTimeout(this.initialize.bind(this), 100);
        this.cookieAccept.addEventListener('click', this.accept.bind(this));
        this.cookieDecline.addEventListener('click', this.toggle.bind(this));
    }
    initialize() {
        if (localStorage.getItem('cookie') !== 'true') {
            this.cookie.classList.remove('hidden');
            setTimeout(function (){
                this.cookie.style.bottom = '0px';
            }.bind(this), 500);

        }
    }
    toggle() {
        this.cookie.classList.toggle('hidden');
    }
    accept() {
        localStorage.setItem('cookie', 'true');
        this.toggle();
    }
}
new Cookie().addEventListeners();
