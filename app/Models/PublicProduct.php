<?php

namespace App\Models;

// use Jenssegers\Mongodb\Eloquent\Model as MongoModel;
// use Jenssegers\Mongodb\Eloquent\Model as MongoModel; // <– ESTA ES LA CLASE CORRECTA
// use Jenssegers\Mongodb\Eloquent\Model as MongoModel;
use MongoDB\Laravel\Eloquent\Model as MongoModel;


class PublicProduct extends MongoModel
{
    protected $connection = 'mongodb';
    protected $collection = 'products_public';

    protected $primaryKey = '_id';
    public $incrementing = false;
    protected $keyType = 'int';

    
    // protected $casts = [
    //     '_id' => 'integer',   // <<--- SOLUCIONA EL PROBLEMA
    //     'stock' => 'integer',
    //     'price' => 'float',
    //     'is_active' => 'boolean',
    // ];


    protected $fillable = [
        '_id',
        'name',
        'description',
        'stock',
        'price',
        'is_active'
    ];
}
