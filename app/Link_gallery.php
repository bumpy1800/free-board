<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Link_gallery extends Model
{
    protected $fillable = [
      'id',
      'gallery_id',
      'add_gallery_id'
    ];

    public $timestamps = false;
    protected $table = 'link_gallery';
}
