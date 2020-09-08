<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Singo_category extends Model
{
    protected $fillable = [
      'id',
      'name'
    ];

    public $timestamps = false;
    protected $table = 'singo_category';
}
