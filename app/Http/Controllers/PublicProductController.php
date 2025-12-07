<?php

namespace App\Http\Controllers;

use App\Models\PublicProduct;
use Illuminate\Http\Request;

class PublicProductController extends Controller
{
    public function index()
    {
        return response()->json(PublicProduct::all());
    }

    public function show($id)
    {
        $p = PublicProduct::where('_id', (int)$id)->first(); //puede ser tambien id (tambien no funciona)
        if(!$p){
            return "no existe";

        }
         return $p;
    }
}
