<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Policy extends Model
{
    protected $fillable = [
      'id',
      'name',
      'content'
    ];

    public $timestamps = false;
    protected $table = 'policy';
}
