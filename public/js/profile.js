function onJsonAnagrafica(json){
    console.log('Questo è il JSON_ANAGRAFICA ricevuto:');
    console.log(json);
    const anagrafica = document.querySelector('#anagrafica');

    const nome = document.createElement('span');
    const cognome = document.createElement('span');
    const nascita = document.createElement('span');
    const email = document.createElement('span');
    const username = document.createElement('span');

    nome.textContent = "Nome: " + json.nome;
    cognome.textContent = "Cognome: " + json.cognome;
    nascita.textContent = "Nascita: " + json.nascita;
    email.textContent = "Email: " + json.email;
    username.textContent = "Username: " + json.username;

    anagrafica.appendChild(nome);
    anagrafica.appendChild(cognome);
    anagrafica.appendChild(nascita);
    anagrafica.appendChild(email);
    anagrafica.appendChild(username);
}

function onJsonAbbonamenti(json){
    console.log('Questo è il JSON_ABBONAMENTI ricevuto:');
    console.log(json);

    const table_abbonamenti = document.querySelector('#abbonamenti table');
    for(let i=0;i<json.length;i++){
        const riga = document.createElement('tr')
        const corso = document.createElement('td');
        const tipo = document.createElement('td');
        const inizio = document.createElement('td');
        const quota = document.createElement('td');
        const scadenza = document.createElement('td');

        corso.textContent = json[i].corso;
        tipo.textContent = json[i].tipo;
        inizio.textContent = json[i].inizio;
        scadenza.textContent = json[i].scadenza;
        quota.textContent = json[i].quota;
        
        riga.appendChild(corso);
        riga.appendChild(tipo);
        riga.appendChild(inizio);
        riga.appendChild(scadenza);
        riga.appendChild(quota);
        table_abbonamenti.appendChild(riga);
    }
}

function onResponse(response){
    return response.json();
}

function onResponseAbbonamenti(response){
    return response.json();
}

function inserisciContenuto(){
    fetch('profile/anagrafica').then(onResponse).then(onJsonAnagrafica);

    fetch('profile/abbonamenti').then(onResponse).then(onJsonAbbonamenti);
}

function mostraMenù(){
    const menù_account = document.querySelector('#menù_account');
    if(mostra===false){
        menù_account.classList.remove('hidden');
        mostra = true;
    }
    else {
        menù_account.classList.add('hidden');
        mostra = false;
    }
}

inserisciContenuto();

let mostra = false;

const account = document.querySelector('#account');
account.addEventListener('click',mostraMenù);

