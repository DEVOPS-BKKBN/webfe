<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Widget extends Model
{
    protected $fillable=['title','status','side','embed'];
    public $timestamps = false;
}