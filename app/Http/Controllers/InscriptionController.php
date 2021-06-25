<?php

use Illuminate\Routing\Controller;
use App\Models\Abbonamento;
use App\Models\Corso;


class InscriptionController extends Controller
{

    public function start(){
        if(session('cliente_id') !== null){
            $old_corso = Request::old('corso');
            $old_tipo = Request::old('tipo');
            $old_data_inizio = Request::old('data_inizio');

            return view('inscription')
                ->with('csrf_token', csrf_token())
                ->with('old_corso', $old_corso)
                ->with('old_tipo', $old_tipo)
                ->with('old_data_inizio', $old_data_inizio);
        }
        else {
            return view("errorpage");
        }
    }

    protected function create()
    {
        $request = request();

        if($this->countErrors($request) === 0) {
            $results = array();

            $corso = $request['corso'];
            $tupla_corso = Corso::where('nome', $corso)->first();
            $tipo = $request['tipo'];
            $data_inizio = $request['data_inizio'];

            $results = $this->calcola($corso, $tipo, $data_inizio);

            /*Inserisco l'Abbonamento*/
            $newAbbonamento =  Abbonamento::create([
            'cliente' => session('cliente_id'),
            'corso' => $tupla_corso->id,
            'tipo' => $tipo,
            'data_inizio' => $data_inizio,
            'quota' => $results['quota'],
            'scadenza' => $results['scadenza']
            ]);

            if($newAbbonamento){
                return redirect('home');
            }
            else{
                return redirect('inscription')->withInput();
            }
        }
        else{
            return redirect('inscription')->withInput();
        }
    }

    private function countErrors($data) {
        $error = array();

        /*Validazione corso*/
        $corsi = array('FUNCTIONAL TRAINING', 'INDOOR CYCLING', 'SALA PESI', 'ZUMBA', 'KARATE', 'GINNASTICA CORRETTIVA');
        $ok1 = false;
        for($i=0;$i<count($corsi);$i++){
            $corso = strtoupper($data['corso']);
            if($corso === $corsi[$i]){
                $ok1 = true;
                break;
            }
        }
        if($ok1 === false){
            $error['corso'] = "Corso non valido!";
        }
    
        /*Validazione tipo abbonamento*/
        $tipi = array('MENSILE', 'TRIMESTRALE', 'SEMESTRALE', 'ANNUALE');
        $ok2 = false;
        for($i=0;$i<count($tipi);$i++){
            $tipo_abbonamento = strtoupper($data['tipo']);
            if($tipo_abbonamento === $tipi[$i]){
                $ok2 = true;
                break;
            }
        }
        if($ok2 === false){
            $error['abb'] = "Tipo di abbonamento non valido!";
        }

        return count($error);
    }

    private function calcola($corso, $tipo, $data_inizio){
        $results = array();
        $tipo = strtoupper($tipo);

        /*Converto la stringa della data di inizio in un oggetto di classe DateTime*/
        $date_scad = date_create($data_inizio);
       
        switch($tipo) {
            case 'MENSILE': {
                $quota_abb = 40; 
                date_add($date_scad, date_interval_create_from_date_string('1 month'));
                /*Salvo la scadenza come stringa nel formato YYYY-MM-DD*/
                $scadenza_abb = date_format($date_scad, 'Y-m-d');
                $results['quota'] = $quota_abb;
                $results['scadenza'] = $scadenza_abb;
                break;
            }
            case 'TRIMESTRALE': {
                $quota_abb = 105; 
                date_add($date_scad, date_interval_create_from_date_string('3 months'));
                $scadenza_abb = date_format($date_scad, 'Y-m-d');
                $results['quota'] = $quota_abb;
                $results['scadenza'] = $scadenza_abb;
                break;
            }
            case 'SEMESTRALE': {
                $quota_abb = 180; 
                date_add($date_scad, date_interval_create_from_date_string('6 months'));
                $scadenza_abb = date_format($date_scad, 'Y-m-d');
                $results['quota'] = $quota_abb;
                $results['scadenza'] = $scadenza_abb;
                break;
            }
            case 'ANNUALE': {
                $quota_abb = 300; 
                date_add($date_scad, date_interval_create_from_date_string('1 year'));
                $scadenza_abb = date_format($date_scad, 'Y-m-d');
                $results['quota'] = $quota_abb;
                $results['scadenza'] = $scadenza_abb;
                break;
            }
        }
        
        return $results;
    }
}
?>
