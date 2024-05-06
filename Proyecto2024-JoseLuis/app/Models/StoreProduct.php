<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoreProduct extends Model
{
    use HasFactory;

    public function users()
    {
        return $this->belongsToMany(User::class, 'store_products_users')->withPivot('rating');
    }

}
