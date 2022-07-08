<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class userDetails extends Model
{
    // serve a specificare la tabella quando non corrisponde 
    protected $table = 'users_details';

    // ad ogni riga di users_details corrisponde un solo user
    public function user() {
        // belongs to perchè è la tabella 'secondaria' che dipende dalla tabella user, va nella tabella che la foreign key
        return $this->belongsTo('App\User');
    }
}
