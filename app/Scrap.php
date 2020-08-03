<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Scrap extends Model
{
  protected $fillable = [
    'id',
    'post_id',
    'user_id',
  ];

  public $timestamps = false;
  protected $table = 'scrap';
}
