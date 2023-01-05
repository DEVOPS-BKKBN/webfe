<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $fillable=['parent_id','title','url','class','position','group_id','active','target','lang'];
    public $timestamps = false;
}
