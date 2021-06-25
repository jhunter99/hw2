<?php

use Illuminate\Routing\Controller;
use App\Models\Cliente;

class LoginController extends Controller
{
    public function login(){
        //Se già loggato, porto il cliente direttamente alla home
        if(session('cliente_id') !== null){
            return redirect ('home');
        }
        //altrimenti lo inoltro alla pagina di login
        else {
            $error_message = '';
            $old_username = Request::old('username');
            if($old_username){
                $error_message = 'Username o Password non validi!';
            }
            return view('login')
                ->with('csrf_token', csrf_token())
                ->with('error_message', $error_message);
        }
    }

    public function checkLogin(){
        //Verifichiamo che l'utente esiste
        $cliente = Cliente::where('username',request('username'))->where('password',request('password'))->first();
    
        //Se le credenziali sono corrette, salvo una sessione con l'username e reindirizzo alla view della home
        if(isset($cliente)){
            Session::put('cliente_id', $cliente->id);
            return redirect ('home');
        }

        //Se sono scorette, reindirizzo alla view della login 
        else{
            return redirect ('login')->withInput();
        }
    }

    public function logout(){
        Session::flush();
        return redirect ('home');
    }
}

?>