<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Qna_category extends Model
{
  protected $fillable = [
    'id'
  ];

  public $timestamps = false;
  protected $keyType = 'String';
  protected $table = 'qna_category';
}
