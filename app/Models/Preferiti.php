<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Preferiti extends Model {

    protected $table = 'preferiti';

    protected $fillable = [
        'cliente',
        'titolo',
        'image_src',
    ];

    public $timestamps = false;

    public function cliente(){
        return $this->belongsTo("App\Models\Cliente");
    }
}

?>