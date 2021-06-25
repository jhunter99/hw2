<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Insegnamento extends Model {

    protected $table = 'insegnamento';

    protected $fillable = [
        'istruttore',
        'corso',
    ];

    public $timestamps = false;

    public function corsi(){
        return $this->belongsToMany("App\Models\Corso");
    }

    public function istruttori(){
        return $this->belongsToMany("App\Models\Istruttore");
    }
}

?>