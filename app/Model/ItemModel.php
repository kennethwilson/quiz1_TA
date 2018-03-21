<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ItemModel extends Model
{
  public $timestamps = false;
  protected $table = "item";
  protected $fillable = ['user_id','name','price','stock'];
  protected $guarded = [];
}
