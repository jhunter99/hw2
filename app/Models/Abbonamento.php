<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Abbonamento extends Model {

    protected $table = 'abbonamento';

    protected $fillable = [
        'cliente',
        'corso',
        'tipo',
        'data_inizio',
        'quota',
        'scadenza'
    ];

    public $timestamps = false;

    public function cliente(){
        return $this->belongsTo("App\Models\Cliente");
    }

    public function corso(){
        return $this->belongsTo("App\Models\Corso");
    }
}

?>