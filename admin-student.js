const deleteBtn = document.getElementById('f-delete');
const addBtn = document.getElementById('f-add');
const editBtn = document.getElementById('f-edit');
const form_del = document.getElementById('form-delete');
const form_add = document.getElementById('form-add');
const form_edit = document.getElementById('form-edit');
const evalPBtn = document.getElementById('f-evalP');
const form_evalP = document.getElementById('form-evalP');


deleteBtn.addEventListener('click', () => {
    form_del.classList.add('active');
    form_edit.classList.remove('active');
    form_add.classList.remove('active');
});


addBtn.addEventListener('click', () => {
    form_add.classList.add('active');
    form_del.classList.remove('active');
    form_edit.classList.remove('active');
});


editBtn.addEventListener('click', () => {
    form_edit.classList.add('active');
    form_add.classList.remove('active');
    form_del.classList.remove('active');
});

evalPBtn.addEventListener('click', () => {
    form_evalP.classList.add('active');
});



document.addEventListener('DOMContentLoaded', function () {
    const closeBtn = document.querySelectorAll('.close-btn');
    for (let i = 0; i < closeBtn.length; i++) {
        closeBtn[i].addEventListener('click', () => {
            form_add.classList.remove('active');
            form_del.classList.remove('active');
            form_edit.classList.remove('active');
            form_evalP.classList.remove('active');x
        });
    }
});

function chargement() {
    var eleve = document.getElementById("maListeE").value;
    
    var xhr = new XMLHttpRequest();

    xhr.open("GET", "getComp.php?eleve=" + eleve, true);
    xhr.send();
    
    xhr.onreadystatechange = function () {
        
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                
                var competence = JSON.parse(xhr.responseText);
                console.log(competence)
                console.log(competence.length)
                
                var selectMatieres = document.getElementById("maListeComp");
                selectMatieres.innerHTML = ""; 
                console.log(selectMatieres)
                for (var i = 0; i < competence.length; i++) {
                    var option = document.createElement("option");
                    option.value = competence[i];
                    option.textContent = competence[i];
                    selectMatieres.appendChild(option);
                    console.log("Option ajoutée : ", option)
                }
            } 
        }
    };
}