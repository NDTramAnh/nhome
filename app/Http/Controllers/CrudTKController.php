use Illuminate\Pagination\LengthAwarePaginator;

public function thongKe(Request $request)
{
    $filter = $request->input('filter');
    $keyword = $request->input('keyword');
    $month = $request->input('month', now()->format('Y-m'));
    $tab = $request->input('tab');

    // HÀNG TỒN
    $products = Product::all();
    $collection = $products->map(function ($product) {
        $tonKho = $product->quantity;
        $tongNhap = ImportOrdersDetail::where('id_product', $product->id)->sum('quantity');
        $tongBan = ExportOrderDetail::where('product_id', $product->id)->sum('quantity');
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

    // Lọc + Tìm kiếm
    $filtered = $collection->filter(function ($item) use ($filter, $keyword) {
        $matchKeyword = !$keyword || stripos($item['ten'], $keyword) !== false || stripos($item['ma'], $keyword) !== false;
        $matchFilter = !$filter || $item['trangThai'] === $filter;
        return $matchKeyword && $matchFilter;
    })->values();

    // PHÂN TRANG (cho Collection)
    $page = $request->get('page', 1);
    $perPage = 10;
    $baoCaoTon = new LengthAwarePaginator(
        $filtered->forPage($page, $perPage),
        $filtered->count(),
        $perPage,
        $page,
        ['path' => $request->url(), 'query' => $request->query()]
    );

    // BIỂU ĐỒ
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

    // NHẬP HÀNG
    if ($tab === 'nhaphang') {
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

        return view('users.thongke', compact('tab', 'tongPhieuNhap', 'tongSoLuongNhap', 'tongGiaTriNhap', 'baoCaoTon', 'dates', 'importValues', 'exportValues'));
    }

    // XUẤT HÀNG
    if ($tab === 'xuathang') {
        $tongPhieuXuat = DB::table('export_orders')
            ->whereMonth('created_at', Carbon::parse($month)->month)
            ->whereYear('created_at', Carbon::parse($month)->year)
            ->count();

        $tongSoLuongXuat = DB::table('export_order_details')
            ->whereMonth('created_at', Carbon::parse($month)->month)
            ->whereYear('created_at', Carbon::parse($month)->year)
            ->sum('quantity');

        return view('users.thongke', compact('tab', 'tongPhieuXuat', 'tongSoLuongXuat', 'baoCaoTon', 'dates', 'importValues', 'exportValues'));
    }

    // MẶC ĐỊNH
    return view('users.thongke', compact('baoCaoTon', 'dates', 'importValues', 'exportValues'));
}
