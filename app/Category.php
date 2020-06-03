<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
  protected $fillable = [
    'id',
    'name'
  ];

  public $timestamps = false;
  protected $table = 'category';
}
