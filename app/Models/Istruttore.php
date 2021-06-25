<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Istruttore extends Model {

    protected $table = 'istruttore';

    protected $fillable = [
        'nome',
        'cognome',
        'data_di_nascita',
        'formazione',
    ];

    public function insegnamenti(){
        return $this->belongsToMany("App\Models\Insegnamento");
    }
}

?>