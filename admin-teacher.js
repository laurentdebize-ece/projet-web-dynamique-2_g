const deleteBtn = document.getElementById('f-delete');
const addBtn = document.getElementById('f-add');
const form_del = document.getElementById('form-delete');
const form_add = document.getElementById('form-add');
const evalPBtn = document.getElementById('f-evalP');
const form_evalP = document.getElementById('form-evalP');


deleteBtn.addEventListener('click', () => {
    form_del.classList.add('active');
    form_add.classList.remove('active');
});


addBtn.addEventListener('click', () => {
    form_add.classList.add('active');
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
            form_evalP.classList.remove('active');
        });
    }
});


function chargement() {
    var prof = document.getElementById("maListeProf").value;
    
    var xhr = new XMLHttpRequest();

    xhr.open("GET", "getMatiere.php?prof=" + prof, true);
    xhr.send();
    
    xhr.onreadystatechange = function () {
        
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                
                var matieres = JSON.parse(xhr.responseText);
                
                
                var selectMatieres = document.getElementById("maListeComp");
                selectMatieres.innerHTML = ""; 
                console.log(selectMatieres)
                for (var i = 0; i < matieres.length; i++) {
                    var option = document.createElement("option");
                    option.value = matieres[i];
                    option.textContent = matieres[i];
                    selectMatieres.appendChild(option);
                    console.log("Option ajoutée : ", option)
                }
            } 
        }
    };
}

