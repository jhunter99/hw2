<?php

use Illuminate\Routing\Controller;
use App\Models\Cliente;
use App\Models\Ricetta;

class NutrizioneOnlineController extends Controller
{
    public function start(){
        if(session('cliente_id') !== null){
            $cliente = Cliente::find(session('cliente_id'));
            return view("nutrizione_online")->with('username',$cliente->username);
        }
        else {
            return view("errorpage");
        }
    }

    public function caricaRicette(){
        $ricette = array();

        $ricette_cl = Ricetta::where('cliente', session('cliente_id'))->get();
        for($i=0;$i<count($ricette_cl);$i++){
            $ricetta = array();

            $ricetta['nome'] = $ricette_cl[$i]->nome;
            $ricetta['ingredienti'] = $ricette_cl[$i]->ingredienti;
            $ricetta['calorie'] = $ricette_cl[$i]->calorie;
            $ricetta['grassi'] = $ricette_cl[$i]->grassi;
            $ricetta['grassi_saturi'] = $ricette_cl[$i]->grassi_saturi;
            $ricetta['carboidrati'] = $ricette_cl[$i]->carboidrati;
            $ricetta['zuccheri'] = $ricette_cl[$i]->zuccheri;
            $ricetta['proteine'] = $ricette_cl[$i]->proteine;

            $ricette[] = $ricetta;
        }

        return $ricette;
    }

    public function searchEdamam($query){
        $apihost = "edamam-edamam-nutrition-analysis.p.rapidapi.com";
        $apikey = "9d774d61bdmsh348f077b5608a7cp19a621jsncdfc223328d2";
    
        $query = urlencode($query);
    
        $curl = curl_init();
        
        curl_setopt($curl, CURLOPT_URL, "https://edamam-edamam-nutrition-analysis.p.rapidapi.com/api/nutrition-data?ingr=" . $query);
        curl_setopt($curl, CURLOPT_HTTPHEADER, ["x-rapidapi-host: $apihost", "x-rapidapi-key: $apikey"]);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        
        $result = curl_exec($curl);
        echo $result;
        curl_close($curl);
    }

    public function translate($query){
        $apihost = "translated-mymemory---translation-memory.p.rapidapi.com";
        $apikey = "9d774d61bdmsh348f077b5608a7cp19a621jsncdfc223328d2";

        $query = urlencode($query);

        $curl = curl_init();

        curl_setopt($curl, CURLOPT_URL, "https://translated-mymemory---translation-memory.p.rapidapi.com/api/get?q=" . $query . "&langpair=it%7Cen&de=a%40b.c&onlyprivate=0&mt=1");
        curl_setopt($curl, CURLOPT_HTTPHEADER, ["x-rapidapi-host: $apihost", "x-rapidapi-key: $apikey"]);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

        $result = curl_exec($curl);
        echo $result;
        curl_close($curl);
    }

    public function salvaRicetta(){
        $request = request();

        $newRicetta = Ricetta::create([
            'cliente' => session('cliente_id'),
            'nome' => $request['nome'],
            'ingredienti' => $request['ingredienti'],
            'calorie' => $request['calorie'],
            'grassi' => $request['grassi'],
            'grassi_saturi' => $request['grassi_saturi'],
            'carboidrati' => $request['carboidrati'],
            'zuccheri' => $request['zuccheri'],
            'proteine' => $request['proteine']
        ]);

        return $newRicetta;
    }

    public function eliminaRicetta($query){
        $ricetta = Ricetta::where('cliente', session('cliente_id'))->where('nome', $query);
        $ricetta->delete();
    }
}