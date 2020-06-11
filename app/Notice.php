<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notice extends Model
{
    protected $fillable = [
      'id',
      'title',
      'contents',
      'reg_date',
      'view'
    ];

    public $timestamps = false;
    protected $table = 'notice';
}
