<?php
namespace App;
use Darryldecode\Cart\CartCollection;
class DatabaseStorage {
public function has($key)
{
    return ('App\Models\DatabaseStorageModel')::find($key);
}
public function get($key)
{
    if($this->has($key))
    {
        return new CartCollection('App\Models\DatabaseStorageModel'::find($key)->wishlist_data);
    }
    else
    {
        return [];
    }
}
public function put($key, $value)
{
    if($row = ('App\Models\DatabaseStorageModel')::find($key))
    {
        // update
        $row->wishlist_data = $value;
        $row->save();
    }
    else
    {
        ('App\Models\DatabaseStorageModel')::create([
            'id' => $key,
            'wishlist_data' => $value
        ]);
    }
}
}
