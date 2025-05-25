<?php

namespace App\Http\Controllers;

use App\Models\Supplier;

class SupplierController extends Controller
{
    public function index()
    {
        $suppliers = Supplier::orderBy('create_at', 'desc')->paginate(10); // hoặc ->get() nếu không phân trang
        return view('suppliers.index', compact('suppliers'));
    }
}
