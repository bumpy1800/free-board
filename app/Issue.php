<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Issue extends Model
{
  protected $fillable = [
    'id',
    'keyword',
    'count',
    'search_date'
  ];

  public $timestamps = false;
  protected $table = 'issue';
}
