const i_subject = document.getElementById('i-sub');
const i_skillzz = document.getElementById('i-ski');
const i_student = document.getElementById('i-stu');
const i_teacher = document.getElementById('i-tea');

i_student.addEventListener('click', () => {
    window.location.href = 'Admin-Student.php';
});

i_skillzz.addEventListener('click', () => {
    window.location.href = 'Admin-Skillzz.php';
});

i_teacher.addEventListener('click', () => {
    window.location.href = 'Admin-Teacher.php';
});

i_subject.addEventListener('click', () => {
    window.location.href = 'Admin-Subject.php';
});


// yep.addEventListener('click', () => {
//     for (var i = 0; i < inputElements.length; i++) {
//         var inputValue = inputElements[i].value;
//         var inputCheck = inputElements[i].checked;
//         if (inputCheck) {
//             if (inputValue === '3') {
//                 console.log('oups');
//             } else if (inputValue === '4') {
//                 console.log('aie');
//             } else {
//                 console.log('ouille');
//             }
//         }
//     }
// });