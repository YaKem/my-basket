'use strict';

const btn = document.getElementById('btn');
const frm = document.getElementById('form-container');

btn.addEventListener('click', () => {
    frm.classList.toggle('hide');

    const icon = document.querySelector('#btn i');
    icon.classList.toggle('fa-arrow-down');
    icon.classList.toggle('fa-arrow-right');
});