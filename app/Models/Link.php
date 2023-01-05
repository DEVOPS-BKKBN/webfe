<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    protected $fillable=['title','slug','photo','url','status'];
    public $timestamps = false;
}