<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;

class User extends Model implements Authenticatable
{
    use \Illuminate\Auth\Authenticatable;

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

    public function getAuthPassword() {
        return $this->pwd;
    }
}
