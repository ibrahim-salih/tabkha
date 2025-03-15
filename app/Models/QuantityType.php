<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class QuantityType extends Model
{
    /** @use HasFactory<\Database\Factories\QuantityTypeFactory> */
    use HasFactory;
    use SoftDeletes; // Add this line to enable soft deletes
    // use HasTranslations;
    protected $table = 'quantity_types';

    protected $fillable = ['name','slug','status','deleted_at','created_at','updated_at'];

    public function scopeActive($query)
    {
        return $query->where('status', '1');
    }
}
