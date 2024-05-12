<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProduct extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function messages()
{
    return $this->hasMany(Message::class, 'user_product_id');
}
}
