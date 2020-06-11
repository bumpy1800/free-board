<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Popup extends Model
{
    protected $fillable = [
      'id',
      'category',
      'image',
      'name',
      'reg_date',
      'status'
    ];

    public $timestamps = false;
    protected $table = 'popup';
}
