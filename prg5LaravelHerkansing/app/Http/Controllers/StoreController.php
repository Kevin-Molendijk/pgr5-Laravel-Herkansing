<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    public function index(Request $request)
    {
        $products = Product::where([
        ['title', '!=', Null],
        [function ($query) use ($request) {
            if (($term = $request->term)) {
                $query->orWhere('title', 'LIKE', '%' . $term . '%')->get();
                }
            }]
        ])
            ->orderby("id", "desc")
            ->paginate(10);

        return view('store.storefront', compact('products'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function show($id) {
        $product = Product::find($id);
        return view('store.show', compact('product'));
    }
}
