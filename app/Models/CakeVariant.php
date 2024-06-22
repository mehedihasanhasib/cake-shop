<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CakeVariant extends Model
{
    use HasFactory;
    protected $table = "cake_variants";
    protected $fillable = [
        'variant_name'
    ];

    public function cakes(){
        return $this->hasMany(Cake::class, 'cake_variant_id');
    }
}
