<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use PDF;

class ProductController extends Controller
{
    public function index(Request $request)
{
    $query = Product::where('user_id', auth()->id());

    if ($request->filled('search')) {
        $search = $request->input('search');
        $query->where(function ($q) use ($search) {
            $q->where('name_product', 'like', "%{$search}%")
              ->orWhere('code', 'like', "%{$search}%");
        });
    }

    $products = $query->get();

    return view('products.index', compact('products'));
}

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'code' => 'required|string|unique:products,code',
            'name_product' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'description' => 'nullable|string',
            'stock_quantity' => 'required|integer',
            'price' => 'required|numeric',
            'status' => 'required|string',
        ]);
    
        // ✅ Gán user_id TRƯỚC khi tạo sản phẩm
        $data['user_id'] = auth()->id();
    
        // ✅ Bây giờ mới tạo
        Product::create($data);
    
        return redirect()->route('products.index')->with('success', 'Thêm sản phẩm thành công!');
    }

    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'code' => 'required|string|max:255',
            'name_product' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|string',
            'price' => 'required|numeric',
            'stock_quantity' => 'required|integer',
            'category' => 'required|string|max:255',
        ]);

        $product->update($request->all());

        return redirect()->route('products.index')->with('success', 'Cập nhật sản phẩm thành công.');
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Xóa sản phẩm thành công.');
    }
    public function printPDF()
    {
        $products = Product::where('user_id', auth()->id())->get();

        $pdf = PDF::loadView('products.print', compact('products'));
        return $pdf->download('danh_sach_san_pham.pdf');
    }
    public function show(Product $product)
{
    // Có thể kiểm tra user_id để đảm bảo user chỉ xem sản phẩm của mình
    if ($product->user_id !== auth()->id()) {
        abort(403); // Không có quyền truy cập
    }

    return view('products.show', compact('product'));
}
    
}
