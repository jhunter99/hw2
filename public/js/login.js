function checkForm(event){
    if(form.username.value.length === 0 || form.password.value.length === 0){
        event.preventDefault();
        document.querySelector('.error').classList.remove('hidden');
    }
}

const form = document.querySelector('form');
form.addEventListener('submit',checkForm);