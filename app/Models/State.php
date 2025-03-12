<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class State extends Model
{
    /** @use HasFactory<\Database\Factories\CityFactory> */
    use HasFactory;
    use SoftDeletes; // Add this line to enable soft deletes
    // use HasTranslations;
    protected $table = 'states';
    
    protected $fillable = ['country_id','name','status','deleted_at','created_at','updated_at'];

    public function country(){
        return $this->belongsTo('App\Models\Country','country_id');
    }
}
