<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ImportOrder;
use App\Models\User;
use App\Models\Supplier;
use App\Models\ImportOrdersDetail;
use App\Models\Product;
use Barryvdh\DomPDF\Facade\Pdf;
class ImportOrderController extends Controller
{
    public function import()
    {
        return view('import.import');
    }
    public function addImport()
    {
        return view('import.addImport');
    }
    public function informip()
    {
        return view('import.inform');
    }

    public function export($id)
    {
        $order = ImportOrder::with(['supplier', 'user', 'details.product'])->findOrFail($id);

        $pdf = Pdf::loadView('import.export_pdf', compact('order'));
        return $pdf->stream('phieu_nhap_' . $order->id_import . '.pdf');
    }
    public function index(Request $request)
    {
        $search = $request->input('search');

        $importOrders = ImportOrder::when($search, function ($query, $search) {
            $query->where('id_import', 'like', "%$search%")
                ->orWhereHas('user', fn($q) => $q->where('name', 'like', "%$search%"));
        })
            ->with(['user', 'supplier'])
            ->paginate(5);

        return view('import.import', compact('importOrders'));
    }

    public function create()
    {
        $suppliers = Supplier::all();
        $users = User::all();
        $products = Product::select('id', 'name', 'price')->get();

        return view('import.addImport', compact('suppliers', 'users', 'products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'supplier_id' => 'required|exists:suppliers,id_supplier',
            'user_id' => 'required|exists:users,id',
            'product_id' => 'required|array|min:1',
            'product_id.*' => 'required|exists:products,id',
            'import_price' => 'required|array|min:1',
            'import_price.*' => 'required|numeric|min:0',
            'quantity' => 'required|array|min:1',
            'quantity.*' => 'required|integer|min:1',
            'import_date' => 'required|date',
            'note' => 'nullable|string',
        ]);

        $total = 0;
        foreach ($request->product_id as $i => $pid) {
            $total += $request->import_price[$i] * $request->quantity[$i];
        }

        $importOrder = ImportOrder::create([
            'supplier_id' => $request->supplier_id,
            'user_id' => $request->user_id,
            'total_price' => $request->total_price,
            'import_date' => $request->import_date,
            'note' => $request->note,
        ]);

        $productIds = $request->input('product_id');        
        $prices = $request->input('import_price');          
        $quantities = $request->input('quantity');          

        
        foreach ($productIds as $index => $productId) {
            $price = $prices[$index];
            $quantity = $quantities[$index];

            ImportOrdersDetail::create([
                'id_import' => $importOrder->id_import,
                'id_product' => $productId,
                'price' => $price,
                'quantity' => $quantity,
            ]);

          
            $product = Product::find($productId);
            if ($product) {
                $product->quantity += $quantity;
                $product->save();
            }
        }

        
        return redirect()->route('import.page')->with('success', 'Thêm phiếu nhập thành công và cập nhật tồn kho sản phẩm.');
    }

    public function show($id)
    {
        $order = ImportOrder::with(['user', 'supplier', 'details.product'])->findOrFail($id);
        return view('import.inform', compact('order'));
    }

    public function destroy($id)
    {
        $order = ImportOrder::findOrFail($id);
        $order->details()->delete();
        $order->delete();

        return redirect()->route('import.page')->with('success', 'Đã xóa phiếu nhập thành công!');
    }
}



