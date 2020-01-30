<?php
 
namespace App;
 
use Illuminate\Database\Eloquent\Model;
 
class Users1 extends Model
{
    protected $fillable = [
        'name'
    ];
	public $timestamps = false;
}