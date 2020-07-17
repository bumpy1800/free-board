<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Logo extends Model
{
    protected $fillable = [
      'id',
      'pic',
      'name'
    ];

    public $timestamps = false;
    protected $table = 'logo';
}
