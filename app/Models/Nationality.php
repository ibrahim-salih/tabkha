<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Nationality extends Model
{
    /** @use HasFactory<\Database\Factories\NationalityFactory> */
    use HasFactory;
    use SoftDeletes; // Add this line to enable soft deletes
    // use HasTranslations;

    protected $table = 'nationalities';
    
    protected $fillable = ['name','status','deleted_at','created_at','updated_at'];

    public function scopeActive($query)
    {
        return $query->where('status', '1');
    }
}
