<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Product;
use App\Models\ImportOrdersDetail;
use App\Models\ExportOrdersDetail;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
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


        $month = $request->input('month', now()->format('Y-m')); // lấy theo tháng hoặc mặc định tháng hiện tại

        $dates = collect(range(1, Carbon::parse($month)->daysInMonth))->map(function ($day) use ($month) {
            return Carbon::parse($month)->day($day)->format('Y-m-d');
        });

        $importValues = $dates->map(function ($date) {
            return DB::table('import_orders_detail')
                ->join('import_orders', 'import_orders_detail.id_import', '=', 'import_orders.id_import')
                ->whereDate('import_orders.import_date', $date)
                ->sum('import_orders_detail.quantity');
        });

        $exportValues = $dates->map(function ($date) {
            return DB::table('export_orders_details')
                ->join('export_orders', 'export_orders_details.id_export', '=', 'export_orders.id_export')
                ->whereDate('export_orders.create_at', $date)
                ->sum('export_orders_details.quantity');
        });

        return view('users.thongke', [
            'baoCaoTon'    => $baoCaoTon,
            'dates'        => $dates->toArray(),
            'importValues' => $importValues->toArray(),
            'exportValues' => $exportValues->toArray(),
            'tab'          => $request->input('tab'),
        ]);
    }
}
