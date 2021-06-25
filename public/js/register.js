function checkNome(){
    const input = document.querySelector('.nome input');
    const error = document.querySelector('.nome .errore_p');
    if(input.value.length === 0){
        error.classList.remove('hidden');
        errors['nome'] = 'Nome non valido!';
    }
    else {
        error.classList.add('hidden');
        errors['nome'] = undefined;
    }
}

function checkCognome(){
    const input = document.querySelector('.cognome input');
    const error = document.querySelector('.cognome .errore_p');
    if(input.value.length === 0){
        error.classList.remove('hidden');
        errors['cognome'] = 'Cognome non valido!';
    }
    else {
        error.classList.add('hidden');
        errors['cognome'] = undefined;
    }
}

function checkNascita(){
    const input = document.querySelector('.nascita input');
    const error = document.querySelector('.nascita .errore_p');
    if(input.value.length === 0){
        error.classList.remove('hidden');
        errors['nascita'] = 'Data di nascita non valida!';
    }
    else {
        error.classList.add('hidden');
        errors['nascita'] = undefined;
    }
}

function onJsonEmail(json){
    if (json.exists) {
        const error = document.querySelector('.email .errore_p');
        error.textContent = "Esiste già un utente registrato con questa email!";
        error.classList.remove('hidden');
        errors['email'] = 'Esiste già un utente registrato con questa email!';
    }
    else{
        error.classList.add('hidden');
        errors['email'] = undefined;
    }
}

function onJsonUsername(json){
    if (json.exists) {
        const error = document.querySelector('.username .errore_p');
        error.textContent = "Esiste già un utente registrato con questo username!";
        error.classList.remove('hidden');
        errors['username'] = 'Esiste già un utente registrato con questo username!';
    }
    else{
        error.classList.add('hidden');
        errors['username'] = undefined;
    }
}

function onResponse(response){
    return response.json();
}

function checkEmail(){
    const input = document.querySelector('.email input');
    const error = document.querySelector('.email .errore_p');
    if(input.value.length === 0){
        error.textContent = 'Email non valida!';
        error.classList.remove('hidden');
        errors['email'] = 'Email non valida!';
    }
    else {
        error.classList.add('hidden');
        errors['email'] = undefined;
        fetch("register/email/" + encodeURIComponent(input.value)).then(onResponse).then(onJsonEmail);
    }
}

function checkUsername(){
    const input = document.querySelector('.username input');
    const error = document.querySelector('.username .errore_p');
    if(input.value.length === 0){
        error.textContent = 'Username non valido!';
        error.classList.remove('hidden');
        errors['username'] = 'Username non valido!';
    }
    else {
        error.classList.add('hidden');
        errors['username'] = undefined;
        fetch("register/username/" + encodeURIComponent(input.value)).then(onResponse).then(onJsonUsername);
    }
}

function checkPassword(){
    const input = document.querySelector('.password input');
    const error = document.querySelector('.password .errore_p');
    const regExp = new RegExp("^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,})");

    if(!regExp.test(input.value)){
        error.classList.remove('hidden');
        errors['password'] = 'Password non valida!';
    }
    else{
        error.classList.add('hidden');
        errors['password'] = undefined;
    }
}

function checkForm(event){
    if(form.nome.value.length === 0 || form.cognome.value.length === 0 || form.nascita.value.length === 0 ||
    form.email.value.length === 0 || form.username.value.length === 0 || form.password.value.length === 0){
        event.preventDefault();
        document.querySelector('.errore').classList.remove('hidden');
    }
    else if(errors.nome || errors.cognome || errors.nascita || errors.email || errors.username || errors.password){
        event.preventDefault();
        document.querySelector('.errore').classList.remove('hidden');
    }
}

let errors = [];

document.querySelector('.nome input').addEventListener('blur', checkNome);
document.querySelector('.cognome input').addEventListener('blur', checkCognome);
document.querySelector('.nascita input').addEventListener('blur', checkNascita);
document.querySelector('.email input').addEventListener('blur', checkEmail);
document.querySelector('.username input').addEventListener('blur', checkUsername);
document.querySelector('.password input').addEventListener('blur', checkPassword);

const form = document.querySelector('form');
form.addEventListener('submit',checkForm);



