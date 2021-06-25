<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href='{{ url("css/home.css") }}'>
        <script src='{{ url("js/home.js") }}' defer></script>
        <link href='{{ url("https://fonts.googleapis.com/css2?family=Abel&family=Oxygen&family=Syne+Mono&display=swap") }}' rel="stylesheet">
        <title>Power Fitness Gym</title>
    </head>
    <body>
        <header>
            <div id="overlay"></div>
            <div id="logo">
                <img src='{{ url("img/LOGO.gif") }}'>
            </div>
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
            @if(isset($username))
                <div id='menù_account' class='hidden'>
                <a href='{{ url("profile") }}'>My Profile</a>
                <a href='{{ url("inscription") }}'>Iscriviti</a>
                <a href='{{ url("logout") }}'>Esci</a>
                </div>
            @endif
            <div id="menu">
                <div></div>
                <div></div>
                <div></div>
            </div>
            @if(isset($username))
                <div id='welcome'>Benvenuto {{ $username }}</div>
            @endif
            <h1>Power Fitness Gym</h1>
        </header>
        <div class="prefButton hidden">Mostra Preferiti</div>
        <div class="hidden preferences"></div>
        <div id = 'cerca'>
            <label>Cerca per Titolo <input type='text'></label>
        </div>
        <section>
            <div class='banner' id='container'></div>
            <div class="griglia"></div>
            <div class='banner' id='nutrition'>
                Per massimizzare i risultati ottenibili dall'allenamento è fondamentale seguire una scrupolosa alimentazione. 
                Un' alimentazione con un adeguato apporto calorico, povera di grassi e ricca di carboidrati complessi e proteine è
                imprescindibile per il mantenimento di un' ottima forma fisica, nonchè indispensabile per la prevenzione di numerose patologie.<br>
                Il nostro obiettivo è quello di fornire agli abbonati benessere a 360 gradi. Ecco perchè abbiamo riservato solo per voi un 
                esclusivo servizio di nutrizione online.
                <div>Clicca <a href='{{ url("nutrizione_online") }}'>qui</a> per maggiori dettagli</div>
            </div>
        </section>
        <footer>
            <div class="info">Power Fitness Gym</div>
            <div class="info">Via Roma, 50 - Catania(CT)</div>
            <div id="firma">Powered by Gerlando Maria Cacciatore, Matricola O46002238</div>
        </footer>
    </body>
</html>