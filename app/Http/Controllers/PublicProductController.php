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

    public function show($sqlite_id)
    {
        return response()->json(
            PublicProduct::where('sqlite_id', $sqlite_id)->firstOrFail()
        );
    }
}
