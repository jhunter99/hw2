<?php

use Illuminate\Routing\Controller;
use App\Models\Cliente;
use App\Models\Corso;
use App\Models\Insegnamento;
use App\Models\Istruttore;


class CorsiController extends Controller
{
    public function start(){
        if(session('cliente_id') !== null){
            $cliente = Cliente::find(session('cliente_id'));
            return view("corsi")->with('username',$cliente->username);
        }
        else {
            return view("corsi")->with('username', null);
        }
    }

    public function aggiungiBlocchi(){
        $blocchi = array();
        $corsi = array('SALA PESI', 'ZUMBA', 'FUNCTIONAL TRAINING', 'INDOOR CYCLING', 'KARATE', 'GINNASTICA CORRETTIVA');

        for($i=0;$i<count($corsi);$i++){
            $blocco = array();

            $corso = Corso::where('nome', $corsi[$i])->first();
            $blocco['nome'] = $corso->nome;
            $blocco['num_iscritti'] = $corso->num_iscritti;
            $blocco['image_url'] = $corso->image_url;

            $insegnamenti = Insegnamento::where('corso', $corso->id)->get();

            for($j=0;$j<count($insegnamenti);$j++){
                $info_istr = array();

                $istruttore = Istruttore::find($insegnamenti[$j]->istruttore);
                $info_istr['nome'] = $istruttore->nome . ' ' . $istruttore->cognome;
                $info_istr['formazione'] = $istruttore->formazione;
                $blocco['istruttori'][] = $info_istr;
            } 

            $blocchi[] = $blocco;
        }

        return $blocchi; 
    }
}
