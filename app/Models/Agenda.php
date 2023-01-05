<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Agenda extends Model
{
    protected $fillable=['title','slug','description','photo','pejabat','status','tanggal','lang'];

    public function getCreatedAtAtribute(){
        return Carbon::parse($this->attributes['tanggal'])
                ->translatedFormat('d F Y');
    }
}
