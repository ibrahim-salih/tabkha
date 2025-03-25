<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ChargeValue extends Model
{
    use SoftDeletes; // Add this line to enable soft deletes
    use HasFactory;

    protected $table = "cooker_charge_value";
    protected $fillable = ['user_type','cooker_id','user_id','charge','total_charge','total_use','created_at','updated_at','deleted_at'];

    public function cooker(){
        return $this->belongsTo('App\Models\Cooker','cooker_id');
    }

    public function user(){
        return $this->belongsTo('App\Models\User','user_id');
    }

    // public function parentChage(){
    //     return $this->belongsTo('App\Models\Charge','user_id');
    // }

}
