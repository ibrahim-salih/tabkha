<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Foodlist extends Model
{
    /** @use HasFactory<\Database\Factories\FoodlistFactory> */
    use HasFactory;
    use SoftDeletes; // Add this line to enable soft deletes
    // use HasTranslations;
    protected $table = 'foodlists';

    protected $fillable = ['section_id','category_id','name','slug','status','deleted_at','created_at','updated_at'];

    public function scopeActive($query)
    {
        return $query->where('status', '1');
    }
    public function section(){
        return $this->belongsTo('App\Models\Section','section_id');
    }

    public function category(){
        return $this->belongsTo('App\Models\Category','category_id');
    }
}
