<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CookerChart extends Model
{
    use HasFactory;
    protected $table = "cooker_charts";
    protected $fillable = ['user_type','cooker_id','user_id','name','city','browser','device','os','latitude','longitude','created_at','updated_at'];

    public function cooker(){
        return $this->belongsTo('App\Models\Cooker','cooker_id');
    }

    public function user(){
        return $this->belongsTo('App\Models\User','user_id');
    }
}
