<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use PDF;

class ProductController extends Controller
{
    public function index(Request $request)
{
     $query = Product::query();

    if ($request->has('search')) {
        $search = $request->input('search');
        $query
              ->Where('name_product', 'like', "%$search%");
    }

    $products = $query->paginate(10);  // hoặc all() nếu ít dữ liệu

    return view('products.index', compact('products'));
}

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
          'name_product' => 'required|string|unique:products,name_product',
        'category' => 'required|string|max:255',
        'description' => 'nullable|string',
        'stock_quantity' => 'required|integer',
        'price' => 'required|numeric',
        'status' => 'required|string',
    ]);

    $data['user_id'] = auth()->id();

    // Thêm thời gian tạo và cập nhật theo tên cột trong database
    $now = now();
    $data['create_at'] = $now;
    $data['update_at'] = $now;

    Product::create(array_merge(
        $request->all(),
        ['user_id' => auth()->id()]
    ));

    return redirect()->route('products.index')->with('success', 'Thêm sản phẩm thành công!');
    }

    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
        'name_product' => 'required|string|max:255',
        'status' => 'required|in:0,1,2',  // chỉ 3 giá trị hợp lệ
        'price' => 'required|numeric',
        'stock_quantity' => 'required|integer',
        'category' => 'required|string|max:255',
    ]);

    $product->update($validated);

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