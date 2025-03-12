<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    /** @use HasFactory<\Database\Factories\CategoryFactory> */
    use HasFactory;
    use SoftDeletes; // Add this line to enable soft deletes
    // use HasTranslations;

    protected $table = 'categories';

    protected $fillable = ['section_id','name', 'slug', 'status', 'deleted_at', 'created_at', 'updated_at'];

    public function section(){
        return $this->belongsTo('App\Models\Section','section_id');
    }

    public function foods()
    {
        return $this->hasMany('App\Models\Food', 'category_id');
    }

    public function scopeActive($query)
    {
        return $query->where('status', '1');
    }
}
