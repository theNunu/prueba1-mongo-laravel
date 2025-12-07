<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\PublicProduct;

class Product extends Model
{
    protected $table = 'products';
    protected $primaryKey = 'product_id';
    protected $fillable = [
        'name',
        'description',
        'stock',
        'price',
        'is_active'
    ];

    protected static function boot()
    {
        parent::boot();
        
        // Cuando se crea en SQLite, crear copia en Mongo.
        static::created(function ($product) {
            // $data = $product->toArray();
            // $data['sqlite_id'] = $product->id;
            // PublicProduct::create($data);}
            $data = $product->toArray();
            $data['_id'] = $product->product_id;        // <<--- IMPORTANTÍSIMO
            // $data['sqlite_id'] = $product->product_id;
            PublicProduct::create($data);
        });

        static::updated(function ($product) {
            $data = $product->toArray();

            PublicProduct::where('_id', $product->product_id)->update($data);
            // $data = $product->toArray();
            // PublicProduct::where('sqlite_id', $product->id)->update($data);
        });

        static::deleted(function ($product) {
            PublicProduct::where('_id', $product->product_id)->delete();
            // PublicProduct::where('sqlite_id', $product->id)->delete();
        });
    }
}
