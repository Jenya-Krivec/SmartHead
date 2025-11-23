'use strict';
class Preloader {
    constructor() {
        this.preloader = document.getElementById('preloader');
    }
    addEventListeners() {
        window.addEventListener('load', this.hide.bind(this));
    }
    hide() {
        setTimeout(function () {
            this.preloader.classList.add('hidden');
        }.bind(this), 100);
    }
}
new Preloader().addEventListeners();
