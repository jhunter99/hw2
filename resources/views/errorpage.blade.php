<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel='stylesheet' href='{{ url("css/errorpage.css") }}'>
        <title>Error Page</title>
    </head>

    <body>
        <section>
            <div class='text'>Per visualizzare questa pagina devi prima effettuare l'accesso!</div>
            <div class='buttons'>
                <a href='{{ url("home") }}'>Torna alla home</a>
                <a href='{{ url("login") }}'>Accedi</a>
            </div>
        </section>
    </body>
</html>