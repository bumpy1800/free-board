<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    protected $fillable = [
      'id',
      's_name',
      'name',
      'category_id',
      'link',
      'contents',
      'reason',
      'heads',
      'agree'
    ];

    public $timestamps = false;
    protected $table = 'gallery';
}
