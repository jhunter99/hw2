<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Iscrizione</title>
        <link rel='stylesheet' href='{{ url("css/inscription.css") }}'>
        <script src='{{ url("js/inscription.js") }}' defer></script>
    </head>
    <body>
        <section>
            <div class='description'>Attraverso questo form è possibile iscriversi ad uno dei nostri corsi</div>
            <main>
                <div class='container'>
                    <form name='iscrizione' method='post'>
                        <input type='hidden' name='_token' value='{{ $csrf_token }}'>
                        <div class='corso'>
                            <label>Corso <input type='text' name='corso' value='{{ $old_corso }}'></label>
                            <div class='errore_p hidden'>Corso non valido!</div>
                        </div>
                        <div class='tipo'>
                            <label>Tipo di Abbonamento <input type='text' name='tipo' value='{{ $old_tipo }}'></label>
                            <div class='errore_p hidden'>Tipo di abbonamento non valido!</div>
                        </div>
                        <div class='data_inizio'>
                            <label>Data di inizio <input type='text' name='data_inizio' value='{{ $old_data_inizio }}' placeholder='formato YYYY-MM-DD'></label>
                            <div class='errore_p hidden'>Data di inizio non valida!</div>
                        </div>
                        <label>&nbsp; <input type='submit' value='Iscriviti'></label>
                    </form>
                    <div class='buttons'>
                            <a href='{{ url("home") }}'>Torna alla home</a>
                    </div>
                </div>
            </main>
            <div class='errore hidden'>Error</div>
        </section>
    </body>
</html>