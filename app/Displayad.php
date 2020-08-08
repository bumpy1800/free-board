<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Displayad extends Model
{
    protected $fillable = [
      'id',
      'category',
      'co_name',
      'director',
      'phone',
      'email',
      'division',
      'title',
      'term',
      'hopemoney',
      'contents',
      'image',
      'date',
    ];

    public $timestamps = false;
    protected $table = 'displayad';
}
