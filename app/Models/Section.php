<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\SoftDeletes;

class Section extends Model
{
    /** @use HasFactory<\Database\Factories\SectionFactory> */
    use HasFactory;
    use SoftDeletes; // Add this line to enable soft deletes
    // use HasTranslations;

    protected $table = 'sections';

    protected $fillable = ['name', 'slug', 'status', 'deleted_at', 'created_at', 'updated_at'];

    public function categories()
    {
        return $this->hasMany('App\Models\Category', 'section_id');
    }

    public function scopeActive($query)
    {
        return $query->where('status', '1');
    }

    public function scopeNot($query)
    {
        return $query->where('id','!=', '1')->where('id','!=', '2')->where('id','!=', '3')->where('id','!=', '4')->where('id','!=', '5')->where('id','!=', '6')->where('id','!=', '7')->where('id','!=', '8');
    }

}
