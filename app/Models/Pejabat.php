<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pejabat extends Model
{
    protected $fillable=['nama','slug','description','photo','jabatan','status','lang'];

    public function jabatan_info(){
        return $this->hasOne('App\Models\Jabatan','id','post_cat_id');
    }
}
