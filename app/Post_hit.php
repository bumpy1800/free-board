<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post_hit extends Model
{
  protected $fillable = [
    'id',
    'post_id',
  ];

  public $timestamps = false;
  protected $table = 'post_hit';
}
