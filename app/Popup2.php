<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Popup2 extends Model
{
    protected $fillable = [
      'id',
      'image',
      'name',
      'reg_date',
      'status'
    ];

    public $timestamps = false;
    protected $table = 'popup2';
}
