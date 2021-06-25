<html>
<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}" id="token" >
    <link rel='stylesheet' href='{{ url("css/nutrizione_online.css") }}'>
    <script src='{{ url("js/nutrizione_online.js") }}' defer></script>
    <title>Nutrizione Online</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css2?family=Syne+Mono&display=swap" rel="stylesheet">
</head>
<body>
    <header>
        <div id="logo">
            <img src='{{ url("img/LOGO.gif") }}'>
        </div>
        <div class='nav'>
            <nav>
                <a href='{{ url("home") }}'>Home</a>
                <a href='{{ url("chi-siamo") }}'>Chi siamo</a>
                <a href='{{ url("corsi") }}'>Corsi</a>
                <a href='{{ url("contattaci") }}'>Contattaci</a>

                @if(isset($username))
                    <span id='account'>{{ $username }}</span>
                @endif
                @if(!isset($username))
                    <a href='{{ url("login") }}'>Accedi</a>
                @endif
            </nav>
        </div>
        @if(isset($username))
            <div id='menù_account' class='hidden'>
                <a href='{{ url("profile") }}'>My Profile</a>
                <a href='{{ url("inscription") }}'>Iscriviti</a>
                <a href='{{ url("logout") }}'>Esci</a>
            </div>
        @endif
    </header>
    <section class='first'>
        <h1>Benvenuti nel nostro servizio di nutrizione online!</h1>
        <div>Questo servizio permette di calcolare le calorie di singoli alimenti, di ricette ed anche di interi menù.</div>
        <div>Inserisci nell'apposita barra di ricerca il singolo alimento(o il singolo ingrediente), 
             specificando prima la quantità(in grammi) e poi l'alimento.<br>
             Esempio: 100g pollo<br>
             N.B. In caso di errore controlla meglio la sintassi o scrivi in Inglese(seleziona ENG dal menù a tendina).
        </div>
        <div>Clicca 'Aggiungi'(o premi 'Invio') per aggiungere l'alimento alla lista.</div>
        <div>Quando hai terminato la lista degli ingredienti, clicca 'Calcola' per calcolare le calorie
             o 'Rimuovi' per cancellare la lista.
        </div>
        <div>
            Clicca 'Salva' per salvare le tue ricette preferite. Se desideri visualizzare le tue ricette
            preferite clicca 'Vedi ricette salvate',<br> altrimenti clicca 'Elimina' per rimuovere la singola ricetta salvata.
        </div>
    </section>
    <form>Alimento: 
        <input type='text' id='barra'>
        <input type='submit' id='submit' value='Aggiungi'>
        <select name="lingua" id="lingua">
            <option value='ITA'>ITA</option>
            <option value='ENG'>ENG</option>
        </select>
    </form>
    <section class='tabelle'>
        <div class='tab_lista'>
            <div class='lista'>
                <ol>
                </ol>
            </div>
            <div class='buttons_lista'>
                <button id='calculate'>Calcola</button>
                <button id='remove'>Rimuovi</button>
            </div>
        </div>
        <div class='tab_output'>
            <div id='output'>
                <h2>Analisi Nutrizionale</h2>
                <div class='line'></div>
                <div class='contents'></div>
            </div>
            <form id='form_save'>
                <input type='text' id='nome_ricetta' placeholder='Inserisci un nome alla ricetta'>
                <input type='submit' value='Salva'>
            </form>
        </div>
        <div class='tab_ricette'>
            <button id='visualizza'>Vedi ricette salvate</button>
            <div id='ricette' class='hidden'>
                <h2>Ricette salvate</h2>
                <div class='container_r'></div>
            </div>
        </div>
    </section>
    <footer>
        <div class="info">Power Fitness Gym</div>
        <div class="info">Via Roma, 50 - Catania(CT)</div>
        <div id="firma">Powered by Gerlando Maria Cacciatore, Matricola O46002238</div>
    </footer>
</body>
</html>