<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function search(Request $request)
    {
        $search = $request->input('q');

        $products = Product::where('code', 'like', "%$search%")
            ->orWhere('name', 'like', "%$search%")
            ->select('id', 'code', 'name', 'unit', 'price')
            ->limit(10)
            ->get();

        $results = [];

        foreach ($products as $product) {
            $results[] = [
                'id' => $product->id,
                'text' => $product->code . ' - ' . $product->name,
                'code' => $product->code,
                'name' => $product->name,
                'unit' => $product->unit,
                'price' => $product->price,
            ];
        }

        return response()->json(['results' => $results]);
    }
}
