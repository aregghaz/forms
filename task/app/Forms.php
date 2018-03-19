<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Forms extends Model
{
    protected $casts = [
        'field' => 'array',
    ];
}
