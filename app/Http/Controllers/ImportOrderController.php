<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ImportOrder;
use App\Models\User;
use App\Models\Supplier;
use App\Models\ImportOrderDetail;
use App\Models\Product;
class ImportOrderController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $importOrders = ImportOrder::when($search, function ($query, $search) {
            $query->where('id_import', 'like', "%$search%")
                ->orWhereHas('user', fn($q) => $q->where('name', 'like', "%$search%"));
        })
            ->with(['user', 'supplier'])
            ->get();

        return view('import', compact('importOrders'));
    }

    public function create()
    {
        $suppliers = Supplier::all();
        $users = User::all();
        $products = Product::select('id_product', 'name_product', 'price')->get();

        return view('addImport', compact('suppliers', 'users', 'products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id_product',
            'supplier_id' => 'required|exists:suppliers,id_supplier',
            'user_id' => 'required|exists:users,id',
            'quantity' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
            'import_date' => 'required|date',
            'note' => 'nullable|string',
        ]);

        
        $importOrder = ImportOrder::create([

            'supplier_id' => $request->supplier_id,
            'user_id' => $request->user_id,
            'total_price' => $request->price * $request->quantity,
            'import_date' => $request->import_date,
        ]);

       
        ImportOrderDetail::create([
            'id_import' => $importOrder->id_import,
            'id_product' => $request->product_id,
            'quantity' => $request->quantity,
            'price' => $request->price,
        ]);

        return redirect()->route('import.page') 
            ->with('success', 'Đã thêm phiếu nhập thành công!');
    }

    public function show($id)
    {
        $order = ImportOrder::with(['user', 'supplier', 'details.product'])->findOrFail($id);
        return view('inform', compact('order'));
    }

    public function destroy($id)
    {
        $order = ImportOrder::findOrFail($id);
        $order->details()->delete(); 
        $order->delete(); 

        return redirect()->route('import.page')->with('success', 'Đã xóa phiếu nhập thành công!');
    }
}



