<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function getCategories()
    {
        $categroies = Category::all();

        return response()->json([
            'categroies' => $categroies ,
        ]);
    }
}
