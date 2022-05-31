<?php

namespace App\Models;

use App\Models\Traits\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory,Translatable;
    protected $fillable = [
        'id',
        'name',
        'name_en',
        'description',
        'description_en',
        'code',
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
