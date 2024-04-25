<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoreProduct extends Model
{
    use HasFactory;

    public function baskets()
    {
        return $this->belongsToMany(Basket::class)->withPivot('quantity', 'total_price');
    }
}
