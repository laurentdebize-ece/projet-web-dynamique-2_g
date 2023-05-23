const deleteBtn = document.getElementById('f-delete');
const addBtn = document.getElementById('f-add');
const form_del = document.getElementById('form-delete');
const form_add = document.getElementById('form-add');


deleteBtn.addEventListener('click', () => {
    form_del.classList.add('active');
    form_add.classList.remove('active');
});


addBtn.addEventListener('click', () => {
    form_add.classList.add('active');
    form_del.classList.remove('active');
});


document.addEventListener('DOMContentLoaded', function () {
    const closeBtn = document.querySelectorAll('.close-btn');
    for (let i = 0; i < closeBtn.length; i++) {
        closeBtn[i].addEventListener('click', () => {
            form_add.classList.remove('active');
            form_del.classList.remove('active');
        });
    }
});