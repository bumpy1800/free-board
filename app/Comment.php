<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
  protected $fillable = [
    'id',
    'user_id',
    'nouser_name',
    'nouser_pw',
    'contents',
    'reg_date',
    'post_id',
    'notice_id',
    'ip'
  ];

  public $timestamps = false;
  protected $table = 'comment';
}
