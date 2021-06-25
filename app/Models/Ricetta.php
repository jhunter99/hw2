<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ricetta extends Model {

    protected $table = 'ricetta';

    protected $primaryKey = 'ID';

    protected $fillable = [
        'cliente',
        'nome',
        'ingredienti',
        'calorie',
        'grassi',
        'grassi_saturi',
        'carboidrati',
        'zuccheri',
        'proteine'
    ];

    public $timestamps = false;

    public function cliente(){
        return $this->belongsTo("App\Models\Cliente");
    }
}

?>