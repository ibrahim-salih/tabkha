<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    protected $table = "cities";
    protected $fillable = ['state_id','name','status','created_at','updated_at'];

    public function state(){
        return $this->belongsTo('App\Models\State','state_id');
    }
}
