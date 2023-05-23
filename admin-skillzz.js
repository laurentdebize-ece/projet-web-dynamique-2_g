const addBtn = document.getElementById('f-add');
const form_add = document.getElementById('form-add');


document.addEventListener('DOMContentLoaded', function () {
    const closeBtn = document.querySelectorAll('.close-btn');
    for (let i = 0; i < closeBtn.length; i++) {
        console.log('aie');
        closeBtn[i].addEventListener('click', () => {
            form_add.classList.remove('active');
        });
    }
});


addBtn.addEventListener('click', () => {
    form_add.classList.add('active');
});