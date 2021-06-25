<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Signup</title>
        <link rel='stylesheet' href='{{ url("css/register.css") }}'>
        <script src='{{ url("js/register.js") }}' defer></script>
    </head>
    <body>
        <section>
            <main>
                <div class='container'>
                    <!-- Se il submit non va a buon fine, i dati inseriti restano nel form -->
                    <form name='registrazione' method='post'>
                        <input type='hidden' name='_token' value='{{ $csrf_token }}'>
                        <div class='nome'>
                            <label>Nome <input type='text' name='nome' value='{{ $old_nome }}'></label>
                            <div class='errore_p hidden'>Nome non valido!</div>
                        </div>
                        <div class='cognome'>
                            <label>Cognome <input type='text' name='cognome' value='{{ $old_cognome }}'></label>
                            <div class='errore_p hidden'>Cognome non valido!</div>
                        </div>
                        <div class='nascita'>
                            <label>Data di Nascita <input type='text' name='nascita' value='{{ $old_nascita }}' placeholder='formato AAAA-MM-DD'></label>
                            <div class='errore_p hidden'>Data di nascita non valida!</div>
                        </div>
                        <div class='email'>
                            <label>Email <input type='text' name='email' value='{{ $old_email }}'></label>
                            <div class='errore_p hidden'>Email non valida!</div>
                        </div>
                        <div class='username'>
                            <label>Username <input type='text' name='username' value='{{ $old_username }}'></label>
                            <div class='errore_p hidden'>Username non valido!</div>
                        </div>
                        <div class='password'>
                            <label>Password <input type='password' name='password' value='{{ $old_password }}'></label>
                            <div class='errore_p hidden'>
                                La password deve essere di 8 caratteri e deve contenere almeno una lettera maiuscola,
                                una lettera minuscola, un numero ed un carattere speciale!
                            </div>
                        </div>
                        <label>&nbsp; <input type='submit' value='Registrazione'></label>
                    </form>
                    <div class='buttons'>
                        <a href='{{ url("home") }}'>Torna alla home</a>
                    </div>
                </div>
            </main>
            <div class='errore hidden'>Impossibile completare la registrazione! Controlla i campi</div>
        </section>
    </body>
</html>

