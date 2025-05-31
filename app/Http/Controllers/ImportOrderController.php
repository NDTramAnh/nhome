<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ImportOrder;
use App\Models\User;
use App\Models\Supplier;
use App\Models\ImportOrdersDetail;
use App\Models\Product;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

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
    $order = ImportOrder::with(['supplier', 'user', 'details.product'])->find($id);

    if (!$order) {
        // Trả về trang lỗi riêng cho phiếu nhập (import)
        return response()->view('errors.404_import', [], 404);
        // Nếu bạn đặt file blade ở thư mục con import, dùng 'import.404_import'
        // return response()->view('import.404_import', [], 404);
    }

    $pdf = PDF::loadView('import.export_pdf', compact('order'));
    return $pdf->stream('phieu_nhap_' . $order->id_import . '.pdf');
}

    public function index(Request $request)
    {
        $search = $request->input('search');
        $page = $request->input('page', 1);


        if (!is_numeric($page) || intval($page) < 1) {
            return redirect()->route('import.page')
                ->with('error', 'Không tìm thấy trang.');
        }
        $page = intval($page);


        $queryCount = ImportOrder::when($search, function ($query, $search) {
            $query->where('id_import', 'like', "%$search%")
                ->orWhereHas('user', fn($q) => $q->where('name', 'like', "%$search%"));
        });
        $total = $queryCount->count();

        $perPage = 5;
        $lastPage = ceil($total / $perPage);


        if ($total > 0 && $page > $lastPage) {
            return redirect()->route('import.page')
                ->with('error', 'Vượt quá số trang tối đa.');
        }


        $importOrders = ImportOrder::when($search, function ($query, $search) {
            $query->where('id_import', 'like', "%$search%")
                ->orWhereHas('user', fn($q) => $q->where('name', 'like', "%$search%"));
        })
            ->with(['user', 'supplier'])
            ->paginate($perPage, ['*'], 'page', $page);

        return view('import.import', compact('importOrders'));
    }

    public function create()
    {
        $suppliers = Supplier::all();
        $users = User::all();
        $products = Product::select('id', 'name', 'price')->get();

        return view('import.addImport', compact('suppliers', 'users', 'products'));
    }

    function trimFullWidthSpaces($value)
    {
        return preg_replace('/^[\s\x{3000}]+|[\s\x{3000}]+$/u', '', $value);
    }

    public function store(Request $request)
    {

        $noteTrimmed = $this->trimFullWidthSpaces($request->input('note'));

        if ($noteTrimmed !== null && $noteTrimmed === '') {
            return redirect()->back()
                ->withInput()
                ->withErrors(['note' => 'Trường ghi chú không được để khoảng trắng hoặc trống.']);
        }


        $importPrices = $request->input('import_price', []);
        $quantities = $request->input('quantity', []);

        foreach ($importPrices as &$price) {
            $price = $this->convertFullWidthNumbersToHalfWidth($price);
        }
        foreach ($quantities as &$qty) {
            $qty = $this->convertFullWidthNumbersToHalfWidth($qty);
        }
        unset($price, $qty);


        $request->merge([
            'note' => $noteTrimmed,
            'import_price' => $importPrices,
            'quantity' => $quantities,
        ]);


        $request->validate([
            'supplier_id' => 'required|exists:suppliers,id_supplier',
            'user_id' => 'required|exists:users,id',
            'product_id' => 'required|array|min:1',
            'product_id.*' => 'required|exists:products,id',
            'import_price' => 'required|array|min:1',
            'import_price.*' => 'required|numeric|min:0',
            'quantity' => 'required|array|min:1',
            'quantity.*' => 'required|integer|min:1',
            'import_date' => 'required|date',
            'note' => 'nullable|string|max:255',
        ]);





        $total = 0;
        foreach ($request->product_id as $i => $pid) {
            $total += $request->import_price[$i] * $request->quantity[$i];
        }

        $exists = ImportOrder::where('supplier_id', $request->supplier_id)
            ->where('user_id', $request->user_id)
            ->where('import_date', $request->import_date)
            ->where('total_price', $total)


            ->exists();

        if ($exists) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['duplicate' => 'Phiếu nhập này đã được tạo gần đây. Vui lòng đợi một chút trước khi tạo lại.']);
        }

        $importOrder = ImportOrder::create([
            'supplier_id' => $request->supplier_id,
            'user_id' => $request->user_id,
            'total_price' => $total,
            'import_date' => $request->import_date,
            'note' => $request->note,
        ]);

        $productIds = $request->input('product_id');
        $prices = $request->input('import_price');
        $quantities = $request->input('quantity');

        foreach ($productIds as $index => $productId) {
            $price = $prices[$index];
            $quantity = $quantities[$index];

            ImportOrdersDetail::create([
                'id_import' => $importOrder->id_import,
                'id_product' => $productId,
                'price' => $price,
                'quantity' => $quantity,
            ]);

            $product = Product::find($productId);
            if ($product) {
                $product->quantity += $quantity;
                $product->save();
            }
        }

        return redirect()->route('import.page')->with('success', 'Thêm phiếu nhập thành công và cập nhật tồn kho sản phẩm.');
    }

    private function convertFullWidthNumbersToHalfWidth($string)
    {
        $fullWidthNumbers = ['０', '１', '２', '３', '４', '５', '６', '７', '８', '９'];
        $halfWidthNumbers = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];

        return str_replace($fullWidthNumbers, $halfWidthNumbers, $string);
    }

    public function show($id)
    {
        if (!is_numeric($id)) {
            return redirect()->route('import.page')->with('error', 'ID phiếu nhập không hợp lệ.');
        }

        $order = ImportOrder::with(['user', 'supplier', 'details.product'])->find($id);

        if (!$order) {
            return redirect()->route('import.page')->with('error', 'Không tìm thấy phiếu nhập.');
        }

        return view('import.inform', compact('order'));
    }

    public function destroy($id)
    {

        if (!Auth::user()->roles->contains('name', 'admin')) {
            return back()->with('error', 'Bạn không có quyền thực hiện hành động này.');
        }
        $order = ImportOrder::findOrFail($id);

        $order = ImportOrder::find($id);

        if (!$order) {
            return redirect()->route('import.page')->with('error', 'Phiếu nhập không tồn tại hoặc đã bị xóa.');
        }



        $order->details()->delete();
        $order->delete();

        return redirect()->route('import.page')->with('success', 'Đã xóa phiếu nhập thành công!');
    }
}
