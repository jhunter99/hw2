<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Corso extends Model {

    protected $table = 'corso';

    protected $fillable = [
        'nome',
        'num_iscritti',
        'image_url'
    ];

    public function abbonamenti(){
        return $this->hasMany("App\Models\Abbonamento");
    }

    public function insegnamenti(){
        return $this->belongsToMany("App\Models\Insegnamento");
    }
}

?>