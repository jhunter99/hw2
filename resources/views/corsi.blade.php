<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Corsi</title>
        <link rel='stylesheet' href='{{ url("css/corsi.css") }}'>
        <script src='{{ url("js/corsi.js") }}' defer></script>
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
        <section>
            <div id='title'>Scopri tutti i nostri corsi</div>
            <div class='griglia'></div>
        </section>
        <footer>
            <div class="info">Power Fitness Gym</div>
            <div class="info">Via Roma, 50 - Catania(CT)</div>
            <div id="firma">Powered by Gerlando Maria Cacciatore, Matricola O46002238</div>
        </footer>
    </body>
</html>