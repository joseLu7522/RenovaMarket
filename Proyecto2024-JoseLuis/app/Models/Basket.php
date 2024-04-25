<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Basket extends Model
{
    use HasFactory;

    public function storeProducts()
    {
        return $this->belongsToMany(StoreProduct::class)->withPivot('quantity', 'total_price');
    }
}
