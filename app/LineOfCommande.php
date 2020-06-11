<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LineOfCommande extends Model
{
    protected $fillable = [
        'idPlat','idCommande','quantity','Prix'
    ];
}
