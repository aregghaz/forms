<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answers extends Model
{
    protected $casts = [
        'field_answers' => 'array',
    ];
    protected $fillable = ['login_ip'];
}
