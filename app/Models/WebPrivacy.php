<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebPrivacy extends Model
{
    /** @use HasFactory<\Database\Factories\WebPrivacyFactory> */
    use HasFactory;

    protected $table = 'web_privacies';

    protected $fillable = ['name', 'description', 'created_at', 'updated_at'];
}
