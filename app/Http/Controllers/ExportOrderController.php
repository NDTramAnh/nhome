<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ExportOrder;
use App\Models\Product;
use App\Models\ExportOrderDetail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ExportOrderController extends Controller
{
    // Trang danh sách phiếu xuất
    public function index(Request $request)
    {
        $sortOrder = $request->input('sort', 'desc'); // Mặc định giảm dần (mới nhất trước)

        // Chỉ cho phép 'asc' hoặc 'desc', tránh nhập sai
        if (!in_array($sortOrder, ['asc', 'desc'])) {
            $sortOrder = 'desc';
        }

        $query = ExportOrder::query();


        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('id', 'like', "%$search%")
                    ->orWhere('id_customer', 'like', "%$search%")
                    ->orWhere('id_user', 'like', "%$search%");
            });
        }


      $exportOrders = $query->orderBy('created_at', $sortOrder)->paginate(5);


        return view('exportorder.exportorder', compact('exportOrders','sortOrder'));
    }


    // tạo mới phiếu xuất
    public function create()
    {

        $latest = \App\Models\ExportOrder::latest('id')->first();
        $nextId = $latest ? $latest->id + 1 : 1;

        $products = Product::all();
        return view('exportorder.create', compact('products', 'nextId'));
    }

    // Lưu phiếu xuất mới
    public function store(Request $request)
    {
        try {
            if (!isset($request->products) || count($request->products) === 0) {
                return redirect()->back()
                    ->withInput()
                    ->with('error', 'Bạn phải thêm ít nhất một sản phẩm vào phiếu xuất.');
            }

            // Kiểm tra số lượng từng sản phẩm trước khi tạo phiếu xuất
            foreach ($request->products as $productInput) {
                $product = Product::find($productInput['code']);

                if (!$product) {
                    return redirect()->back()
                        ->withInput()
                        ->with('error', "Sản phẩm với mã {$productInput['code']} không tồn tại.");
                }

                if ($productInput['quantity'] > $product->quantity) {
                    return redirect()->back()
                        ->withInput()
                        ->with('error', "Sản phẩm {$product->name} chỉ còn {$product->quantity} trong kho, không thể xuất số lượng yêu cầu.");
                }
            }

            // Tạo phiếu xuất
            $exportOrder = ExportOrder::create([
                'id_customer' => $request->khach_hang,
                'id_user' => Auth::id(),
                'total_price' => $request->tri_gia,
            ]);

            // Tạo chi tiết phiếu xuất và cập nhật số lượng trong kho
            foreach ($request->products as $productInput) {
                ExportOrderDetail::create([
                    'id_export' => $exportOrder->id,
                    'product_id' => $productInput['code'],
                    'quantity' => $productInput['quantity'],
                    'price' => $productInput['price'],
                    'subtotal' => $productInput['price'] * $productInput['quantity'],
                    'id_customer' => $request->khach_hang,
                    'id_user' => Auth::id(),
                ]);

                // Trừ số lượng tồn kho
                $product = Product::find($productInput['code']);
                $product->quantity -= $productInput['quantity'];
                $product->save();
            }

            return redirect()->route('exportorder.index')->with('success', 'Tạo phiếu xuất thành công!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Lỗi khi tạo phiếu xuất: ' . $e->getMessage());
        }
    }


    // xoá 
    public function destroy($id)
    {
        try {

            $exportOrder = ExportOrder::findOrFail($id);
            $exportOrder->details()->delete();
            $exportOrder->delete();

            return redirect()->route('exportorder.index')->with('success', 'Xoá phiếu xuất thành công!');
        } catch (\Exception $e) {
            return redirect()->route('exportorder.index')->with('error', 'Lỗi khi xoá phiếu xuất: ' . $e->getMessage());
        }
    }



    // hiển thị thông tin phiếu xuất
    public function show($id)
    {
        $order = ExportOrder::with('orderDetails.product')->findOrFail($id);
        return view('exportorder.show', compact('order'));
    }
    //in phiếu xuất
    public function print($id)
    {
        $order = ExportOrder::with(['details.product'])->findOrFail($id);

        return view('exportorder.print', compact('order'));
    }
}
