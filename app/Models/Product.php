<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['title', 'price', 'image', 'description', 'is_approved', 'created_by', 'updated_by', 'deleted_by'];

    protected $dates = ['deleted_at'];
}
