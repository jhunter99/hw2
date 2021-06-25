<?php

use App\Models\Cliente;

use Illuminate\Routing\Controller;

class RegisterController extends Controller {

    protected function create()
    {
        $request = request();

        if($this->countErrors($request) === 0) {
            /*Inserisco il Cliente*/
            $newCliente =  Cliente::create([
            'nome' => $request['nome'],
            'cognome' => $request['cognome'],
            'data_di_nascita' => $request['nascita'],
            'email' => $request['email'],
            'username' => $request['username'],
            'password' => $request['password']
            ]);

            if($newCliente){
                Session::put('cliente_id', $newCliente->id);
                return redirect('home');
            }
            else{
                return redirect('register')->withInput();
            }
        }
        else{
            return redirect('register')->withInput();
        }
    }

    private function countErrors($data) {
        $error = array();

        /*Validazione nome*/
        if(strlen($data['nome']) === 0){
            $error['nome'] = "Nome non valido!";
        }

        /*Validazione cognome*/
        if(strlen($data['cognome']) === 0){
            $error['cognome'] = "Cognome non valido!";
        }

         /*Validazione nascita*/
         if(strlen($data['nascita']) === 0){
            $error['nascita'] = "Data di nascita non valida!";
        }
        
        /*Validazione email*/
        if(strlen($data['email']) === 0){
            $error['email'] = "Email non valida!";
        }
        else {
            $email = Cliente::where('email',$data['email'])->first();
            if ($email !== null) {
                $error['email'] = "Esiste già un utente registrato con questa email!";
            }
        }
        
        /*Validazione username*/
        if(strlen($data['username']) === 0){
            $error['username'] = "Username non valido!";
        }
        else{
            $username = Cliente::where('username',$data['username'])->first();
            if ($username !== null) {
                $error['username'] = "Esiste già un utente registrato con questo username!";
            }
        }

        /*Validazione password*/
	    if(strlen($data['password']) < 8 || !preg_match("#[0-9]+#", $data['password']) || !preg_match("#[a-z]+#", $data['password']) ||
        !preg_match("#[A-Z]+#", $data['password']) || !preg_match("/[\'^£$%&*()}{@#~?><>,|=_+!-]/", $data['password'])) 
        {
            $error['password'] = "La password deve essere di 8 caratteri e deve contenere almeno una lettera maiuscola,
            una lettera minuscola, un numero ed un carattere speciale";
        }

        return count($error);
    }

    public function checkEmail($query) {
        $exist = Cliente::where('email', $query)->exists();
        return ['exists' => $exist];
    }

    public function checkUsername($query) {
        $exist = Cliente::where('username', $query)->exists();
        return ['exists' => $exist];
    }

    public function start(){
        if(session('cliente_id') !== null){
            return redirect('home');
        }
        else {
            $old_nome = Request::old('nome');
            $old_cognome = Request::old('cognome');
            $old_nascita = Request::old('nascita');
            $old_email = Request::old('email');
            $old_username = Request::old('username');
            $old_password = Request::old('password');

            return view('register')
                ->with('csrf_token', csrf_token())
                ->with('old_nome', $old_nome)
                ->with('old_cognome', $old_cognome)
                ->with('old_nascita', $old_nascita)
                ->with('old_email', $old_email)
                ->with('old_username', $old_username)
                ->with('old_password', $old_password); 
        }
    }
}

?>

