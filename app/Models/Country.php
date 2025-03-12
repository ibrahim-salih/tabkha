<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Country extends Model
{
    use HasFactory;
    use SoftDeletes; // Add this line to enable soft deletes
    // use HasTranslations;

    protected $table = 'countries';
    
    protected $fillable = ['name','status','deleted_at','created_at','updated_at'];

    public function states(){
        return $this->hasMany('App\Models\State','country_id');
    }
}
