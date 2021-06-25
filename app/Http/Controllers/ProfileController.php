<?php

use Illuminate\Routing\Controller;
use App\Models\Cliente;
use App\Models\Abbonamento;
use App\Models\Corso;

class ProfileController extends Controller
{
    public function start(){
        if(session('cliente_id') !== null){
            $cliente = Cliente::find(session('cliente_id'));
            return view("profile")->with('username',$cliente->username);
        }
        else {
            return view("errorpage");
        }
    }

    public function anagrafica(){
        $anagrafica = array();
        $cliente = Cliente::find(session('cliente_id'));

        $anagrafica['nome'] = $cliente->nome;
        $anagrafica['cognome'] = $cliente->cognome;
        $anagrafica['nascita'] = $cliente->data_di_nascita;
        $anagrafica['email'] = $cliente->email;
        $anagrafica['username'] = $cliente->username;

        return $anagrafica;
    }

    public function abbonamenti(){
        $abbonamenti = array();

        $abbonamenti_cl = Abbonamento::where('cliente', session('cliente_id'))->get();
       
        for($i=0;$i<count($abbonamenti_cl);$i++){
            $abbonamento = array();

            $corso = Corso::find($abbonamenti_cl[$i]->corso);
            $abbonamento['corso'] = $corso->nome;
            $abbonamento['tipo'] = $abbonamenti_cl[$i]->tipo;
            $abbonamento['inizio'] = $abbonamenti_cl[$i]->data_inizio;
            $abbonamento['quota'] = $abbonamenti_cl[$i]->quota;
            $abbonamento['scadenza'] = $abbonamenti_cl[$i]->scadenza;

            $abbonamenti[] = $abbonamento;
        }

        return $abbonamenti;
    }
}
