<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Login</title>
        <link rel="stylesheet" href='{{ url("css/login.css")}}'>
        <script src='{{ url("js/login.js") }}' defer></script>
    </head>
    <body>
        <section>
            <main>
                <div class='container'>
                    <form name='login' method='post'>
                        <input type='hidden' name='_token' value='{{ $csrf_token }}'>
                        <label>Username <input type='text' name='username'></label>
                        <label>Password <input type='password' name='password'></label>
                        <label>&nbsp; <input type='submit' value='Accedi'></label>
                    </form>
                    <div class='buttons'>
                        <a href='{{ url("register") }}'>Non hai un account? Registrati.</a>
                        <a href='{{ url("home") }}'>Torna alla home</a>
                    </div>
                </div>
            </main>
            @if($error_message !== '')
                <div class='error'>{{ $error_message }}</div>
            @endif
            <div class='error hidden'>Username o Password non validi!</div>
        </section>
    </body>
</html>