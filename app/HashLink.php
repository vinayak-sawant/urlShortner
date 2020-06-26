<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HashLink extends Model
{
    protected $fillable = [
        'code', 'link', 'counter'
    ];
}
