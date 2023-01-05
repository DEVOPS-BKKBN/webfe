<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    protected $fillable=['lang','short_des','description','photo','address','phone','email','logo','layanan','maps','favicon'];
}
