<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blocco_homepage extends Model {

    protected $table = 'blocco_homepage';

    protected $fillable = [
        'title',
        'image_src',
        'description'
    ];
}

?>