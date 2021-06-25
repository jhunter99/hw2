<?php

use Illuminate\Routing\Controller;
use App\Models\Cliente;
use App\Models\Blocco_homepage;
use App\Models\Preferiti;

class HomeController extends Controller
{
    public function home(){
        //Leggiamo l'utente connesso
        if(session('cliente_id') !== null){
            $cliente = Cliente::find(session('cliente_id'));
            return view('home')->with('username',$cliente->username);
        }
        else{
            return view('home')->with('username',null);
        }
    }

    public function aggiungiBlocchi(){
        $blocchi = Blocco_homepage::all();

        return $blocchi;
    }

    public function searchAmazon() {
	    $apihost = "amazon-product-price-data.p.rapidapi.com";
	    $apikey = "9d774d61bdmsh348f077b5608a7cp19a621jsncdfc223328d2";

	    $query = urlencode("B000GISTZ4,B01LZ2UP91,B07N64YD2Y,B009VV7G60,B0734CCWGR");

	    $curl = curl_init();

	    curl_setopt($curl, CURLOPT_URL, "https://amazon-product-price-data.p.rapidapi.com/product?asins=" . $query . "&locale=US");
	    curl_setopt($curl, CURLOPT_HTTPHEADER, ["x-rapidapi-host: $apihost", "x-rapidapi-key: $apikey"]);
	    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

	    $result = curl_exec($curl);
	    echo $result;
	    curl_close($curl);
    }

    public function aggiungiPreferiti($query){
        $blocco_cl = Blocco_homepage::where('title', $query)->first();

        $newPreferito = Preferiti::create([
            'cliente' => session('cliente_id'),
            'titolo' => $query,
            'image_src' => $blocco_cl->image_src
        ]); 
    }

    public function caricaPreferiti(){
        $preferiti = Preferiti::where('cliente', session('cliente_id'))->get();

        return $preferiti;
    }

    public function rimuoviPreferiti($query){
        $ricetta = Preferiti::where('cliente', session('cliente_id'))->where('titolo', $query);
        $ricetta->delete();
    }
}
