<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ExportOrder;
use App\Models\Product;

class ExportOrderController extends Controller
{
    // Trang danh sách phiếu xuất
    public function index()
    {
        $exportOrders = ExportOrder::paginate(5);
        return view('exportorder.exportorder', compact('exportOrders'));
    }

    // Trang tạo mới phiếu xuất
    public function create()
    {
          $products = Product::all();
        return view('exportorder.create', compact('products'));
    }

    // Lưu phiếu xuất mới
    public function store(Request $request)
    {
        $request->validate([
            'ma_phieu' => 'required|unique:export_orders,id_export',
            'khach_hang' => 'required',
            'nguoi_tao' => 'required',
            'ngay_tao' => 'required|date',
            'tri_gia' => 'required|numeric',
        ]);

        ExportOrder::create([
            'id_export' => $request->ma_phieu,
            'id_customer' => $request->khach_hang,
            'id_user' => $request->nguoi_tao,
            'create_at' => $request->ngay_tao,
            'total_price' => $request->tri_gia,
        ]);

        return redirect()->route('exportorder.index')->with('success', 'Tạo phiếu xuất thành công!');
    }
}
