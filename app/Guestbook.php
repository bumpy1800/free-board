<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Guestbook extends Model
{
  protected $fillable = [
    'id',
    'write_user_id',
    'user_id',
    'contents',
    'secret',
    'reg_date'
  ];

  public $timestamps = false;
  protected $table = 'guestbook';
}
