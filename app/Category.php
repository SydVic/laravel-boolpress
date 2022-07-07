<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    // posts al plurale perchè la categoria può avere tanti post
    public function posts() {
        //  hasMany perchè è la tabella 'principale', come sopra può avere tanti post
        return $this->hasMany('App\Post');
    }
}
