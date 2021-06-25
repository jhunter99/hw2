function onJson_API1(json){
    console.log('JSON1 ricevuto');
    console.log(json);

    const lista_ord = document.querySelector('.lista ol');
    const item = document.createElement('li');
    const barra = document.querySelector('#barra');
    const text_barra = barra.value;

    /*Se l'alimento NON ha zero calorie, allora vuol dire che è presente nel server*/
    if(json.calories!==0){
        item.textContent = text_barra;
        lista_ord.appendChild(item);
        KCAL = KCAL + json.calories;
        FATS = FATS + json.totalNutrients.FAT.quantity;
        SATURATED_FATS = SATURATED_FATS + json.totalNutrients.FASAT.quantity;
        CARBS = CARBS + json.totalNutrients.CHOCDF.quantity;
        SUGARS = SUGARS + json.totalNutrients.SUGAR.quantity;
        PROTEINS = PROTEINS + json.totalNutrients.PROCNT.quantity;
    }
    /*Se ha zero calorie, allora NON è nel server*/
    else{
        item.textContent = 'Alimento non trovato! Controlla la sintassi';
        item.classList.add('red');
        lista_ord.appendChild(item);
    }
}

function onResponse_API1(response) {
    console.log('Response1 ricevuta!');
    return response.json();
}

function onJson_API2(json){
    console.log('JSON2 ricevuto');
    console.log(json);
    const testo_tradotto = encodeURIComponent(json.responseData.translatedText);

    fetch("nutrizione_online/edamamApi/" + testo_tradotto).then(onResponse_API1).then(onJson_API1);
}

function onResponse_API2(response){
    console.log('Response2 ricevuta');
    return response.json();
}

function translateFromItaToEng(text){
    fetch("nutrizione_online/mymemoryApi/" + text).then(onResponse_API2).then(onJson_API2);
}

function inserisciIngrediente(event){
    event.preventDefault();

    const barra = document.querySelector('#barra');
    let text_barra = encodeURIComponent(barra.value);
    const lang = document.querySelector('#lingua').value;
    if(lang === 'ITA'){
        translateFromItaToEng(text_barra);
    }
    else {
        fetch("nutrizione_online/edamamApi/" + text_barra).then(onResponse_API1).then(onJson_API1);
    }
}

function stampa(){
   const output_box = document.querySelector('#output .contents');
   
   output_box.innerHTML = '';

   const CALORIE = document.createElement('div');
   const GRASSI = document.createElement('div');
   const GRASSI_SATURI = document.createElement('div');
   const CARBOIDRATI = document.createElement('div');
   const ZUCCHERI = document.createElement('div');
   const PROTEINE = document.createElement('div');

   CALORIE.textContent = 'Calorie: ' + KCAL + 'kcal';
   GRASSI.textContent = 'Grassi: ' + FATS + 'g';
   GRASSI_SATURI.textContent = 'di cui acidi grassi saturi: ' + SATURATED_FATS + 'g';
   CARBOIDRATI.textContent = 'Carboidrati: ' + CARBS + 'g';
   ZUCCHERI.textContent = 'di cui zuccheri: ' + SUGARS + 'g';
   PROTEINE.textContent = 'Proteine: ' + PROTEINS + 'g';

   CALORIE.classList.add('moreSpace');
   GRASSI_SATURI.classList.add('moreSpace');
   ZUCCHERI.classList.add('moreSpace');

   output_box.appendChild(CALORIE);
   output_box.appendChild(GRASSI);
   output_box.appendChild(GRASSI_SATURI);
   output_box.appendChild(CARBOIDRATI);
   output_box.appendChild(ZUCCHERI);
   output_box.appendChild(PROTEINE);
}

function rimuovi(){
    const lista_ord = document.querySelector('.lista ol');
    lista_ord.innerHTML = '';

    /*Setto nuovamente a 0 le variabili globali*/
    KCAL = 0;
    FATS = 0;
    SATURATED_FATS = 0;
    CARBS = 0;
    SUGARS = 0;
    PROTEINS = 0;
}

function onJsonRicette(json){
    console.log('JSON ricette:');
    console.log(json);
    const container_r = document.querySelector('.container_r');
    container_r.innerHTML = '';

    for(let i=0;i<json.length;i++){
        const blocco_ricetta = document.createElement('div');
        const high = document.createElement('div');
        const nome = document.createElement('div');
        const button_elimina = document.createElement('button');
        const lista_ingr = document.createElement('div');
        const CALORIE = document.createElement('div');
        const GRASSI = document.createElement('div');
        const GRASSI_SATURI = document.createElement('div');
        const CARBOIDRATI = document.createElement('div');
        const ZUCCHERI = document.createElement('div');
        const PROTEINE = document.createElement('div');

        nome.textContent = json[i].nome;
        button_elimina.textContent = 'Elimina';
        lista_ingr.textContent = json[i].ingredienti;
        CALORIE.textContent = 'Calorie: ' + json[i].calorie + 'kcal';
        GRASSI.textContent = 'Grassi: ' + json[i].grassi + 'g';
        GRASSI_SATURI.textContent = 'di cui acidi grassi saturi: ' + json[i].grassi_saturi + 'g';
        CARBOIDRATI.textContent = 'Carboidrati: ' + json[i].carboidrati + 'g';
        ZUCCHERI.textContent = 'di cui zuccheri: ' + json[i].zuccheri + 'g';
        PROTEINE.textContent = 'Proteine: ' + json[i].proteine + 'g';

        high.classList.add('high');
        nome.classList.add('nome_ricetta');
        lista_ingr.classList.add('lista_ingredienti');
        CALORIE.classList.add('moreSpace');
        GRASSI_SATURI.classList.add('moreSpace');
        ZUCCHERI.classList.add('moreSpace');

        high.appendChild(nome);
        high.appendChild(button_elimina);
        blocco_ricetta.appendChild(high);
        blocco_ricetta.appendChild(lista_ingr);
        blocco_ricetta.appendChild(CALORIE);
        blocco_ricetta.appendChild(GRASSI);
        blocco_ricetta.appendChild(GRASSI_SATURI);
        blocco_ricetta.appendChild(CARBOIDRATI);
        blocco_ricetta.appendChild(ZUCCHERI);
        blocco_ricetta.appendChild(PROTEINE);
        container_r.appendChild(blocco_ricetta);

        button_elimina.addEventListener('click',eliminaRicetta);
    }
}

function onResponseRicette(response){
    return response.json();
}

function caricaRicette(){
    fetch('nutrizione_online/caricaRicette').then(onResponseRicette).then(onJsonRicette);
}

function onResponseAggiungi(response){
    console.log('Response Aggiungi:');
    console.log(response);
    /*Dopo l'inserimento della ricetta nel db, aggiorno la tabella lato client */
    caricaRicette();
}

function aggiungiAlDatabase(event){
    event.preventDefault();
    const token = document.querySelector("#token");
    const form_body = new FormData();
    const nome_ricetta = document.querySelector('#nome_ricetta').value;
    const ingredienti_node = document.querySelectorAll('.lista ol li');
    let lista_ingr;

    for(let i=0;i<ingredienti_node.length;i++){
        if(ingredienti_node[i].textContent == 'Alimento non trovato! Controlla la sintassi'){
            continue;
        }
        if(lista_ingr){
            lista_ingr = lista_ingr + ', ' + ingredienti_node[i].textContent;
        }
        else{
            lista_ingr = ingredienti_node[i].textContent;
        }
    }

    form_body.append('nome',nome_ricetta);
    form_body.append('ingredienti',lista_ingr);
    form_body.append('calorie',KCAL + 'kcal');
    form_body.append('grassi',FATS + 'g');
    form_body.append('grassi_saturi',SATURATED_FATS + 'g');
    form_body.append('carboidrati',CARBS + 'g');
    form_body.append('zuccheri',SUGARS + 'g');
    form_body.append('proteine',PROTEINS + 'g');
    
    fetch("nutrizione_online/salvaRicetta", {
        method: 'POST',
        headers:
        {
            'X-CSRF-TOKEN': token.content
        },
        body:form_body }).then(onResponseAggiungi);
}


function onResponseElimina(response){
    console.log('Response Elimina:');
    console.log(response);
    /*Dopo la cancellazione della ricetta dal db, aggiorno la tabella lato client */
    caricaRicette();
}

function eliminaRicetta(event){
    const button_elimina = event.currentTarget;
    const title_ricetta = button_elimina.parentNode.querySelector('div.nome_ricetta').textContent;
    fetch('nutrizione_online/eliminaRicetta/' + encodeURIComponent(title_ricetta)).then(onResponseElimina);
}

function mostraRicette(event){
    const tab_ricette = document.querySelector('#ricette');
    if(mostra === false){
        tab_ricette.classList.remove('hidden');
        event.currentTarget.textContent = 'Nascondi ricette';
        mostra = true;
    }
    else {
        tab_ricette.classList.add('hidden');
        event.currentTarget.textContent = 'Vedi ricette salvate';
        mostra = false;
    }
}

function mostraMenù(){
    const menù_account = document.querySelector('#menù_account');
    if(mostra_menù===false){
        menù_account.classList.remove('hidden');
        mostra_menù = true;
    }
    else {
        menù_account.classList.add('hidden');
        mostra_menù = false;
    }
}

let KCAL = 0;
let FATS = 0;
let SATURATED_FATS = 0;
let CARBS = 0;
let SUGARS = 0;
let PROTEINS = 0;

let mostra = false;
let mostra_menù = false;

caricaRicette();

const form = document.querySelector('form');
form.addEventListener('submit',inserisciIngrediente);

const bottone_calcola = document.querySelector('#calculate');
bottone_calcola.addEventListener('click',stampa);

const bottone_rimuovi = document.querySelector('#remove');
bottone_rimuovi.addEventListener('click',rimuovi);

const form_save = document.querySelector('#form_save');
form_save.addEventListener('submit', aggiungiAlDatabase);

const visualizza = document.querySelector('#visualizza');
visualizza.addEventListener('click', mostraRicette);

const account = document.querySelector('#account');
account.addEventListener('click',mostraMenù);


