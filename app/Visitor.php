<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    protected $fillable = [
      'id',
      'ip',
      'time',
      'refer',
      'agent'
    ];

    public $timestamps = false;
    protected $table = 'visitor';
}
