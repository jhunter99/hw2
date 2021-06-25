function onJsonCarica(json){
    console.log('Json Carica:');
    console.log(json);

    const sezione_pref = document.querySelector('.preferences');
    sezione_pref.innerHTML = '';

    for(let i=0;i<json.length;i++){
        let blocco_pref = document.createElement('div');
        const titolo_pref = document.createElement('h1');
        const img_pref = document.createElement('img');
        const yellow_star = document.createElement('button');

        titolo_pref.textContent = json[i].titolo;
        img_pref.src = json[i].image_src;
        yellow_star.classList.add('yellow_star');
    
        blocco_pref.appendChild(img_pref);
        blocco_pref.appendChild(titolo_pref);
        blocco_pref.appendChild(yellow_star);
        sezione_pref.appendChild(blocco_pref);
        yellow_star.addEventListener('click',rimuoviPreferiti);
    }
}

function onResponseCarica(response){
    console.log('Response Carica:');
    console.log(response);

    return response.json();
}

function caricaPreferiti(){
    fetch('home/caricaPreferiti').then(onResponseCarica).then(onJsonCarica);
}

function abilitaPreferiti(){
    let white_stars = document.querySelectorAll('.white_star');
    for(let i=0;i<white_stars.length;i++){
        white_stars[i].classList.remove('hidden');
    }
}

function onJsonContenuto(json){
    console.log('Questo è il JSON ricevuto:');
    console.log(json);

    const grid = document.querySelector('.griglia');
    for (let i=0; i<json.length;i++){
        const blocco = document.createElement('div');
        const title = document.createElement('h1');
        const image = document.createElement('img');
        const description = document.createElement('div');
        const buttonDetails = document.createElement('button');
        const white_star = document.createElement('button');

        title.textContent = json[i].title;
        image.src = json[i].image_src;
        description.textContent = json[i].description;
        buttonDetails.textContent = 'Mostra più dettagli';
    
        description.classList.add('hidden');
        buttonDetails.classList.add('dettagli');
        white_star.classList.add('white_star');
        white_star.classList.add('hidden');

        buttonDetails.addEventListener('click',dettagli);
        white_star.addEventListener('click',aggiungiPreferiti);
        
        blocco.appendChild(image);
        blocco.appendChild(title);
        blocco.appendChild(description);
        blocco.appendChild(white_star);
        blocco.appendChild(buttonDetails);
        grid.appendChild(blocco);
    }

    if(account){
        abilitaPreferiti();
    }
}

function onResponseContenuto(response){
    return response.json();
}

function inserisciContenuto(){
    fetch('home/blocchi').then(onResponseContenuto).then(onJsonContenuto);
}

function onJsonPubblicità(json){
    console.log('JSON ricevuto');
    console.log(json);
    const container = document.querySelector('#container');
    for(let i=0;i<json.length;i++){
        const product = json[i];

        const blocco = document.createElement('div');
        const image = document.createElement('img');
        const title = document.createElement('span');
        const price = document.createElement('span');

        image.src = product.image_url;
        title.textContent = product.product_name;
        price.textContent = '$' + product.current_price;
        price.classList.add('bold');

        blocco.appendChild(image);
        blocco.appendChild(title);
        blocco.appendChild(price);

        container.appendChild(blocco);
    }
}

function onResponsePubblicità(response) {
    return response.json();
}

function inserisciPubblicità(){
    fetch('home/amazonApi').then(onResponsePubblicità).then(onJsonPubblicità);
}

function dettagli(event){
    const bottone = event.currentTarget;
    const testo = bottone.parentNode.querySelector('div');
    if(mostra_dettagli === false){
        testo.classList.remove('hidden');
        bottone.textContent = 'Mostra meno dettagli';
        mostra_dettagli = true;
    }
    else {
        testo.classList.add('hidden');
        bottone.textContent = 'Mostra più dettagli';
        mostra_dettagli = false;
    }
}

function onResponseRimuovi(response){
    console.log('Response Rimuovi:');
    console.log(response);

    caricaPreferiti();
}

function rimuoviPreferiti(event){
    const yellow_star = event.currentTarget;
    const title = yellow_star.parentNode.querySelector('h1').textContent;
    fetch('home/rimuoviPreferiti/' + encodeURIComponent(title)).then(onResponseRimuovi);
}

function onResponseAggiungi(response){
    console.log('Response Aggiungi:');
    console.log(response);

    caricaPreferiti();
}

function aggiungiPreferiti(event){
    const white_star = event.currentTarget;
    const titolo = white_star.parentNode.querySelector('h1').textContent;

    fetch('home/aggiungiPreferiti/' + encodeURIComponent(titolo)).then(onResponseAggiungi);
}

function search(event) {
    const text_barra = event.currentTarget.value;
    const titoli = document.querySelectorAll('.griglia div h1');

    for(titolo of titoli){
        titolo.parentNode.classList.add('hidden')
    }

    for(titolo of titoli){
        if((titolo.textContent.toUpperCase().indexOf(text_barra.toUpperCase()))!==-1){
            titolo.parentNode.classList.remove('hidden');
        }
    }
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

function mostraPreferiti(event){
    const prefButton = event.currentTarget;
    const sezione_pref = document.querySelector('.preferences');
    if(mostra_preferiti===false){
        sezione_pref.classList.remove('hidden');
        mostra_preferiti = true;
        prefButton.textContent = 'Nascondi Preferiti';
    }
    else {
        sezione_pref.classList.add('hidden');
        mostra_preferiti = false;
        prefButton.textContent = 'Mostra Preferiti';
    }
}

inserisciContenuto();
inserisciPubblicità();

let mostra = false;
let mostra_dettagli = false;
let mostra_preferiti = false;

const barra = document.querySelector('#cerca input');
barra.addEventListener('keyup',search);

const account = document.querySelector('#account');
if(account){
    account.addEventListener('click',mostraMenù);
    caricaPreferiti();
    const prefButton = document.querySelector('.prefButton');
    prefButton.classList.remove('hidden');
    prefButton.addEventListener('click',mostraPreferiti);
}


