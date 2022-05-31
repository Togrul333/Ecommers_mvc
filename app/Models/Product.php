<?php

namespace App\Models;

use App\Models\Traits\Translatable;
use App\Services\CurrencyConversion;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, Translatable;
    use SoftDeletes;
    protected $fillable = [
        'count',
        'name_en',
        'description_en',
    ];


    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function getPriceForCount()
    {
        if (!is_null($this->pivot)) {
            return $this->pivot->count * $this->price;
        }
        return $this->price;
    }

    public function scopeByCode($query,$code)
    {
        return $query->where('code',$code);
    }

    public function scopeNew($query)
    {
        return $query->where('new', 1);
    }

    public function scopeHit($query)
    {
        return $query->where('hit', 1);
    }

    public function scopeRecommend($query)
    {
        return $query->where('recommend', 1);
    }

    public function isAvailable()
    {
        return !$this->trashed() && $this->count > 0;
    }

    public function isNew()
    {
        return $this->new === 1;
    }

    public function isXit()
    {
        return $this->hit === 1;

    }

    public function isRecom()
    {
        return $this->recommend === 1;

    }

    public function getPriceAttribute($value)
    {
//        return $value;
        return round(CurrencyConversion::convert($value),2);
    }

}
