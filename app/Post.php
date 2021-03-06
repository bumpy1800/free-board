<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
  protected $fillable = [
    'id',
    'title',
    'contents',
    'user_id',
    'reg_date',
    'ip',
    'view',
    'good',
    'bad',
    'comments',
    'hits',
    'head',
    'notice',
    'gallery_id',
    'password',
    'thumbnail'
  ];

  public $timestamps = false;
  protected $table = 'post';
}
