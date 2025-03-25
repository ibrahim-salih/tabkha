<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Charge extends Model
{
    use SoftDeletes; // Add this line to enable soft deletes
    use HasFactory;

    protected $table = "cooker_charge";
    protected $fillable = ['user_type','cooker_id','user_id','admin_id','image','mobile','price','status_of','resonse','created_at','updated_at','deleted_at'];

    public function cooker(){
        return $this->belongsTo('App\Models\Cooker','cooker_id');
    }

    public function user(){
        return $this->belongsTo('App\Models\User','user_id');
    }
}
