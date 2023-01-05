<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengumuman extends Model
{
    protected $fillable=['lang','status','title','link','tanggal','photo','slug','desfile','file'];
}