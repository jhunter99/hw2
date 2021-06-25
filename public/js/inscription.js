function checkCorso(){
    const inputValue = document.querySelector('.corso input').value;
    const error = document.querySelector('.corso .errore_p');
    
    const corsi = ['FUNCTIONAL TRAINING', 'INDOOR CYCLING', 'SALA PESI', 'ZUMBA', 'KARATE', 'GINNASTICA CORRETTIVA'];
    const corso = inputValue.toUpperCase();
    let ok1 = false;
    for(let i=0;i<corsi.length;i++){
        if(corso === corsi[i]){
            ok1 = true;
            break;
        }
    }

    if(ok1 === false){
        error.classList.remove('hidden');
        errors['corso'] = 'Corso non valido!';
    }
    else {
        error.classList.add('hidden');
        errors['corso'] = undefined;
    }
}

function checkTipo(){
    const inputValue = document.querySelector('.tipo input').value;
    const error = document.querySelector('.tipo .errore_p');

    const tipi = ['MENSILE', 'TRIMESTRALE', 'SEMESTRALE', 'ANNUALE'];
    const tipo = inputValue.toUpperCase(); 
    let ok2 = false;
    for(let i=0;i<tipi.length;i++){
        if(tipo === tipi[i]){
            ok2 = true;
            break;
        }
    }

    if(ok2 === false){
        error.classList.remove('hidden');
        errors['tipo'] = 'Tipo di abbonamento non valido!';
    }
    else {
        error.classList.add('hidden');
        errors['tipo'] = undefined;
    }
}

function checkDataInzio(){
    const inputValue = document.querySelector('.data_inizio input').value;
    const error = document.querySelector('.data_inizio .errore_p');

    if(inputValue.length === 0){
        error.classList.remove('hidden');
        errors['data_inizio'] = 'Data di inizio non valida!';
    }
    else {
        error.classList.add('hidden');
        errors['data_inizio'] = undefined;
    }
}

function checkForm(event){
    if(form.corso.value.length === 0 || form.tipo.value.length === 0 || form.data_inizio.value.length === 0){
        event.preventDefault();
        document.querySelector('.errore').classList.remove('hidden');
    }
    else if(errors.corso || errors.tipo || errors.data_inizio){
        event.preventDefault();
        const error = document.querySelector('.errore');
        const corso = document.querySelector('.corso input').value;
        error.textContent = 'Impossibile completare l\'iscrizione al corso ' + corso + '! ' + 'Controlla i campi.'
    }
}

let errors = [];

document.querySelector('.corso input').addEventListener('blur', checkCorso);
document.querySelector('.tipo input').addEventListener('blur', checkTipo);
document.querySelector('.data_inizio input').addEventListener('blur', checkDataInzio);

const form = document.querySelector('form');
form.addEventListener('submit',checkForm);
