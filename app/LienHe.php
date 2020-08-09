<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LienHe extends Model
{
    protected $table = 'lien_he';
    protected $fillable = [
        'name',
        'dia_chi',
        'email',
        'detail'
    ];

}
