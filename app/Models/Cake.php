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
}
