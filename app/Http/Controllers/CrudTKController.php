<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Product;
use App\Models\ImportOrdersDetail;
use App\Models\ExportOrdersDetail;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

/**
 * CRUD User controller
 */
class CrudTKController extends Controller
{
    public function thongKe(Request $request)
    {
        $products = Product::all();
        $filter = $request->input('filter');
        $keyword = $request->input('keyword');

        $baoCaoTon = $products->map(function ($product) {
            $tonKho = $product->stock_quantity;
            $tongNhap = ImportOrdersDetail::where('id_product', $product->id_product)->sum('quantity');
            $tongBan = ExportOrdersDetail::where('id_product', $product->id_product)->sum('quantity');
            $tiLeTieuThu = $tongNhap > 0 ? round(($tongBan / $tongNhap) * 100) : 0;
            $trangThai = $tonKho == 0 ? 'Hết hàng' : ($tonKho < 20 ? 'Sắp hết' : ($tonKho < 100 ? 'Trung bình' : 'Còn nhiều'));

            return [
                'ma' => 'HH0' . $product->id_product,
                'ten' => $product->name_product,
                'ncc' => 'ABC',
                'soLuong' => $tonKho,
                'trangThai' => $trangThai,
                'tyLeTieuThu' => $tiLeTieuThu . '%',
            ];
        });

        // Kết hợp tìm kiếm và lọc nếu có
        $baoCaoTon = $baoCaoTon->filter(function ($item) use ($keyword, $filter) {
            $matchKeyword = !$keyword || stripos($item['ten'], $keyword) !== false || stripos($item['ma'], $keyword) !== false;
            $matchFilter = !$filter || $item['trangThai'] === $filter;
            return $matchKeyword && $matchFilter;
        })->values();


        return view('users.thongke', compact('baoCaoTon'));
    }
}
