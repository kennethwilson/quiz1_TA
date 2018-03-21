<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class UserModel extends Model
{
  public $timestamps = false;
  protected $table = "user";
  protected $fillable = ['name','email','password'];
  protected $guarded = [];
  public function myItems()
  {
        return $this->hasMany('App\Model\ItemModel','user_id','id');
  }
}
