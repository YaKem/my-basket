'use strict';

const btn = document.getElementById('btn');
const frm = document.getElementById('form-container');
const btnPen = document.querySelector('tbody a:first-of-type');

function arrowBtnHandler() {

    btn.addEventListener('click', () => {
        frm.classList.toggle('hide');
    
        const icon = document.querySelector('#btn i');
        icon.classList.toggle('fa-arrow-down');
        icon.classList.toggle('fa-arrow-right');

    });
}

window.addEventListener('DOMContentLoaded', () => {
    
    arrowBtnHandler();

});