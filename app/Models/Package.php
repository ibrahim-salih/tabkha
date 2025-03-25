<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;

    protected $table = "packages";
    protected $fillable = ['type','title','days','description','price','status','created_at','updated_at'];
}
