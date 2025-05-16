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

        $baoCaoTon = $products->map(function ($product) {
            $tonKho = $product->stock_quantity;

            // Tính tổng đã nhập
            $tongNhap = ImportOrdersDetail::where('id_product', $product->id_product)->sum('quantity');

            // Tính tổng đã bán
            $tongBan = ExportOrdersDetail::where('id_product', $product->id_product)->sum('quantity');

            // Tính tỷ lệ tiêu thụ
            $tiLeTieuThu = $tongNhap > 0 ? round(($tongBan / $tongNhap) * 100) : 0;

            // Giả định: nếu có bán thì hòa vốn, chưa có thì không
            $tiLeHoaVon = $tongBan > 0 ? rand(70, 100) : rand(30, 60); // tuỳ chỉnh logic sau

            $trangThai = $tonKho == 0 ? 'Hết hàng' : ($tonKho < 20 ? 'Sắp hết' : ($tonKho < 100 ? 'Trung bình' : 'Còn nhiều'));

            return [
                'ma' => 'HH0' . $product->id_product,
                'ten' => $product->name_product,
                'ncc' => 'ABC', // sau cập nhật thêm quan hệ nếu có
                'soLuong' => $tonKho,
                'trangThai' => $trangThai,
                'tyLeTieuThu' => $tiLeTieuThu . '%',
                'tyLeHoaVon' => $tiLeHoaVon . '%',
            ];
        });

        // Áp dụng lọc nếu có chọn
        if ($filter) {
            $baoCaoTon = $baoCaoTon->where('trangThai', $filter)->values();
        }

        return view('users.thongke', compact('baoCaoTon'));
    }
}
