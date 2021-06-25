<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

    class Cliente extends Model {
        protected $table = 'cliente';

        protected $fillable = [
            'nome',
            'cognome',
            'data_di_nascita',
            'email',
            'username',
            'password'
        ];

        protected $hidden = 'password';

        public $timestamps = false;

        public function abbonamenti(){
            return $this->hasMany("App\Models\Abbonamento");
        }

        public function ricette(){
            return $this->hasMany("App\Models\Ricetta");
        }

        public function preferiti(){
            return $this->hasMany("App\Models\Preferiti");
        }
    }
?>


