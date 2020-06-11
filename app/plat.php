<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class plat extends Model
{
    protected $fillable = [
        'name','description', 'categorie', 'prix', 'image', 
    ];
}
