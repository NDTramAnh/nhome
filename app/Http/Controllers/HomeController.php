<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ExportOrder;
use App\Models\User;
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
    $users = User::with('roles')->paginate(10); // đảm bảo bạn load roles nếu có
    return view('users.list', ['users' => $users]);
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
