const container = document.getElementById('container');
const loginButton = document.getElementById('loginE');
const signUpButton = document.getElementById('loginP');

signUpButton.addEventListener('click', () => {
	container.classList.add('panel-actif');
})

loginButton.addEventListener('click', () => {
	container.classList.remove('panel-actif');
})