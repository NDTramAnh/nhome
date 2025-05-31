<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Product;
use PDF;

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
    public function index(Request $request)
    {
        $query = Product::query();

        if ($request->has('search')) {
            $search = $request->input('search');
            $query
                ->Where('name', 'like', "%$search%");
        }

        $products = $query->paginate(10);

        return view('products.index', compact('products'));
    }

    public function create()
    {
        if (!auth()->user()->roles->contains('name', 'admin')) {
            return back()->with('error', 'Bạn không có quyền thực hiện hành động này.');
        }
        return view('products.create');
    }

    public function store(Request $request)

    {

        $data = $request->validate([
            'name' => 'required|string|unique:products,name',
            'category' => 'required|string|max:255',
            'description' => 'nullable|string',
            'stock_quantity' => 'required|integer',
            'price' => 'required|numeric',
            'status' => 'required|string',
        ]);

        $data['user_id'] = auth()->id();

        // Thêm thời gian tạo và cập nhật
        $now = now();
        $data['create_at'] = $now;
        $data['update_at'] = $now;

        Product::create($data);

        return redirect()->route('products.index')->with('success', 'Thêm sản phẩm thành công!');
    }


    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required|in:0,1,2',  // chỉ 3 giá trị hợp lệ
            'price' => 'required|numeric',
            'quantity' => 'required|integer',
            'category' => 'required|string|max:255',
        ]);

        $product->update($validated);

        return redirect()->route('products.index')->with('success', 'Cập nhật sản phẩm thành công.');
    }

    public function destroy(Product $product)
    {

        if (!auth()->user()->roles->contains('name', 'admin')) {
            return back()->with('error', 'Bạn không có quyền thực hiện hành động này.');

            $product->delete();

            return redirect()->route('products.index')->with('success', 'Xóa sản phẩm thành công.');
        }
        $freshProduct = Product::find($product->id);
        if (!$freshProduct) {
            return back()->with('error', 'Xóa không hợp lệ. Sản phẩm không tồn tại hoặc đã bị xóa.');
        }
        $freshProduct->delete();
        return redirect()->route('products.index')->with('success', 'Xóa sản phẩm thành công.');
    }

    public function printPDF()
    {
        $products = Product::where('user_id', auth()->id())->get();

        $pdf = PDF::loadView('products.print', compact('products'));
        return $pdf->download('danh_sach_san_pham.pdf');
    }
    public function show($id)
    {
        $product = Product::find($id);
        if (!$product) {
            return response()->view('errors.404.products', [], 404);
        }
        return view('products.show', compact('product'));
    }
}
