<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Singo extends Model
{
    protected $fillable = [
      'id',
      'category_id',
      'post_id',
      'post_writer',
      'reporter',
      'title',
      'content',
      'solution',
      'status'
    ];

    public $timestamps = false;
    protected $table = 'singo';
}
