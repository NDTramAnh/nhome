<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Models\ImportOrder;
use App\Models\ImportOrdersDetail;
use App\Models\ExportOrderDetail;
use Carbon\Carbon;
use Illuminate\Pagination\LengthAwarePaginator;

class CrudTKController extends Controller
{
    public function thongKe(Request $request)
    {
        $filter = $request->input('filter');
        $keyword = $request->input('keyword');
        $month = $request->input('month') ?? now()->format('Y-m');
        $tab = $request->input('tab') ?? 'ton';

        // DATES dùng cho biểu đồ và tab khác
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
            return DB::table('export_order_details')
                ->whereDate('created_at', $date)
                ->sum('quantity');
        });

        // Báo cáo hàng tồn
        $products = Product::all();
        $collection = $products->map(function ($product) {
            $tonKho = $product->quantity;
            $tongNhap = ImportOrdersDetail::where('id_product', $product->id)->sum('quantity');
            $tongBan = ExportOrderDetail::where('product_id', $product->id)->sum('quantity'); // Sửa ở đây
            $tiLeTieuThu = $tongNhap > 0 ? round(($tongBan / $tongNhap) * 100) : 0;
            $trangThai = $tonKho == 0 ? 'Hết hàng' : ($tonKho < 20 ? 'Sắp hết' : ($tonKho < 100 ? 'Trung bình' : 'Còn nhiều'));

            return [
                'ma' => 'HH0' . $product->id,
                'ten' => $product->name,
                'ncc' => 'ABC',
                'soLuong' => $tonKho,
                'trangThai' => $trangThai,
                'tyLeTieuThu' => $tiLeTieuThu . '%',
            ];
        });

        $filtered = $collection->filter(function ($item) use ($filter, $keyword) {
            $matchKeyword = !$keyword || stripos($item['ten'], $keyword) !== false || stripos($item['ma'], $keyword) !== false;
            $matchFilter = !$filter || $item['trangThai'] === $filter;
            return $matchKeyword && $matchFilter;
        })->values();

        $page = $request->get('page', 1);
        $perPage = 10;
        $baoCaoTon = new LengthAwarePaginator(
            $filtered->forPage($page, $perPage),
            $filtered->count(),
            $perPage,
            $page,
            ['path' => $request->url(), 'query' => $request->query()]
        );

        // Nhập hàng
        $tongPhieuNhap = ImportOrder::whereMonth('import_date', Carbon::parse($month)->month)
            ->whereYear('import_date', Carbon::parse($month)->year)
            ->count();

        $tongSoLuongNhap = ImportOrdersDetail::join('import_orders', 'import_orders_detail.id_import', '=', 'import_orders.id_import')
            ->whereMonth('import_orders.import_date', Carbon::parse($month)->month)
            ->whereYear('import_orders.import_date', Carbon::parse($month)->year)
            ->sum('import_orders_detail.quantity');

        $tongGiaTriNhap = ImportOrdersDetail::join('import_orders', 'import_orders_detail.id_import', '=', 'import_orders.id_import')
            ->whereMonth('import_orders.import_date', Carbon::parse($month)->month)
            ->whereYear('import_orders.import_date', Carbon::parse($month)->year)
            ->sum(DB::raw('quantity * price'));

        $dsPhieuNhap = DB::table('import_orders')
            ->join('users', 'import_orders.user_id', '=', 'users.id')
            ->join('suppliers', 'import_orders.supplier_id', '=', 'suppliers.id_supplier')
            ->whereMonth('import_date', Carbon::parse($month)->month)
            ->whereYear('import_date', Carbon::parse($month)->year)
            ->select('import_orders.*', 'users.name as user_name', 'suppliers.name_supplier as supplier_name')
            ->orderBy('import_date', 'desc')
            ->get();

        // Thống kê số lượng nhập theo nhà cung cấp (cho biểu đồ)
        $supplierStats = DB::table('import_orders')
            ->join('suppliers', 'import_orders.supplier_id', '=', 'suppliers.id_supplier')
            ->join('import_orders_detail', 'import_orders.id_import', '=', 'import_orders_detail.id_import')
            ->whereMonth('import_orders.import_date', Carbon::parse($month)->month)
            ->whereYear('import_orders.import_date', Carbon::parse($month)->year)
            ->select('suppliers.name_supplier as supplier_name', DB::raw('SUM(import_orders_detail.quantity) as total'))
            ->groupBy('suppliers.name_supplier')
            ->orderByDesc('total')
            ->get();




        // Xuất hàng
        $tongPhieuXuat = DB::table('export_orders')
            ->whereMonth('created_at', Carbon::parse($month)->month)
            ->whereYear('created_at', Carbon::parse($month)->year)
            ->count();

        $tongSoLuongXuat = DB::table('export_order_details')
            ->whereMonth('created_at', Carbon::parse($month)->month)
            ->whereYear('created_at', Carbon::parse($month)->year)
            ->sum('quantity');

        return view('users.thongke', compact(
            'tab',
            'month',
            'baoCaoTon',
            'dates',
            'importValues',
            'exportValues',
            'tongPhieuNhap',
            'tongSoLuongNhap',
            'tongGiaTriNhap',
            'tongPhieuXuat',
            'tongSoLuongXuat',
            'dsPhieuNhap',
            'supplierStats'
        ));
    }
}
