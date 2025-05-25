<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ExportOrder;
class HomeController extends Controller
{
    public function index()
    {
        return view('home'); // Giao diện trang chủ
    }

    public function product()
    {
        return view('product');
    }

    public function importOrder()
    {
        return view('importorder');
    }

     public function exportOrder(Request $request)
    {
        // Lấy dữ liệu export orders từ DB
        $search = $request->input('search');

        $query = ExportOrder::query();

        if ($search) {
            $query->where('code', 'like', "%$search%")
                  ->orWhere('customer', 'like', "%$search%");
        }

        $exportOrders = $query->paginate(5);  

        // Trả về view export orders, truyền biến $exportOrders
        return view('exportorder.exportorder', compact('exportOrders'));
    }

    public function users()
    {
        return view('users');
    }

    public function suppliers()
    {
        return view('suppliers');
    }

    public function inventoryReport()
    {
        return view('inventoryreport');
    }
}
