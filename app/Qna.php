<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Qna extends Model
{
  protected $fillable = [
    'id',
    'title',
    'contents',
    'category',
    'reg_date'
  ];

  public $timestamps = false;
  protected $table = 'qna';
}
