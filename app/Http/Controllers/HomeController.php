<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('search');
        $products = Product::when($query, function ($queryBuilder) use ($query) {
            return $queryBuilder->where('name', 'like', "%$query%");
        })->paginate(9); // Use pagination with search

        $products->appends(['search' => $query]); // Preserve search query in pagination links

        return view('home', compact('products', 'query'));
    }
}