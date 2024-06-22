<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cake extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'price',
        'cake_variant_id'
    ];

    public function images()
    {
        return $this->hasMany(Image::class, 'cake_id');
    }

    public function cake_variant()
    {
        return $this->belongsTo(CakeVariant::class, 'cake_variant_id');
    }
}
