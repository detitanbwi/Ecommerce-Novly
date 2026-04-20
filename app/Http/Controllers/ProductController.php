<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::where('is_active', true)->latest();
        
        if ($request->category) {
            $query->whereHas('category', function($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }
        
        $products = $query->paginate(12);
        
        return view('catalog.index', compact('products'));
    }

    public function show($slug)
    {
        $product = Product::with('category')->where('is_active', true)->where('slug', $slug)->firstOrFail();
        return view('catalog.show', compact('product'));
    }
}
