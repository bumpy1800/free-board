<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Popup_category extends Model
{
    protected $fillable = [
      'id'
    ];

    public $timestamps = false;
    protected $keyType = 'String';
    protected $table = 'popup_category';
}
