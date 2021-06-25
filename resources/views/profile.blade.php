<html>
    <head>
        <title>My Profile</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel = 'stylesheet' href = '{{ url("css/profile.css") }}'>
        <script src='{{ url("js/profile.js") }}' defer></script>
        <link href='{{ url("https://fonts.googleapis.com/css2?family=Syne+Mono&display=swap") }}' rel="stylesheet">
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
        <div id='anagrafica' class='container'>
            <h2>Dati Anagrafici</h2>
        </div>
        <div id='abbonamenti' class='container'>
            <h2>I miei abbonamenti</h2>
            <table>
                <tr><th>CORSO</th><th>TIPO</th><th>INIZIATO IL</th><th>SCADE IL</th><th>COSTO</th></tr>
            </table>
        </div>
        <footer>
            <div class="info">Power Fitness Gym</div>
            <div class="info">Via Roma, 50 - Catania(CT)</div>
            <div id="firma">Powered by Gerlando Maria Cacciatore, Matricola O46002238</div>
        </footer>
    </body>
</html>