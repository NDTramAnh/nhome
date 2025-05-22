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
        return $pdf->stream('phieu_nhap_'.$order->id_import.'.pdf');
    }
    public function index(Request $request)
    {
        $search = $request->input('search');
        $importOrders = ImportOrder::when($search, function ($query, $search) {
            $query->where('id_import', 'like', "%$search%")
                ->orWhereHas('user', fn($q) => $q->where('name', 'like', "%$search%"));
        })
            ->with(['user', 'supplier'])
            ->get();

        return view('import.import', compact('importOrders'));
    }

    public function create()
    {
        $suppliers = Supplier::all();
        $users = User::all();
        $products = Product::select('id_product', 'name_product', 'price')->get();

        return view('import.addImport', compact('suppliers', 'users', 'products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            
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


        ImportOrdersDetail::create([
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



