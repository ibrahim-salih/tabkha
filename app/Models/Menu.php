<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Menu extends Model
{
    /** @use HasFactory<\Database\Factories\MenuFactory> */
    use HasFactory;
    use SoftDeletes; // Add this line to enable soft deletes
    // use HasTranslations;
    protected $table = 'menus';

    protected $fillable = ['section_id','category_id','food_id','cooker_id','Qtype_id','country_id','state_id','image','description','video','price','minQty','bforeOrder','timeEnd','status','view','meta_description','meta_keywords','deleted_at','created_at','updated_at'];

    public function section(){
        return $this->belongsTo('App\Models\Section','section_id');
    }

    public function category(){
        return $this->belongsTo('App\Models\Category','category_id');
    }

    public function food(){
        return $this->belongsTo('App\Models\Foodlist','food_id');
    }
    public function cooker(){
        return $this->belongsTo('App\Models\Cooker','cooker_id');
    }
    public function qtype(){
        return $this->belongsTo('App\Models\QuantityType','Qtype_id');
    }
    public function country(){
        return $this->belongsTo('App\Models\Country','country_id');
    }

    public function state(){
        return $this->belongsTo('App\Models\State','state_id');
    }
}
