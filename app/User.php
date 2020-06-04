<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $fillable = [
      'id',
      'uid',
      'nick',
      'pwd',
      'name',
      'email',
      'chk_email',
      'reg_date',
      'status',
      'gallery_id'
    ];

    public $timestamps = false;
    protected $table = 'user';
}
