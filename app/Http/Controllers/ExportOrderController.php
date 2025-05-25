<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ExportOrder;
use App\Models\Product;
use App\Models\ExportOrderDetail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ExportOrderController extends Controller
{
    // Trang danh sách phiếu xuất
    public function index(Request $request)
    {
        $sortOrder = $request->input('sort', 'desc');
        if (!in_array($sortOrder, ['asc', 'desc'])) {
            $sortOrder = 'desc';
        }

        $query = ExportOrder::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('id', 'like', "%$search%")
                    ->orWhere('id_customer', 'like', "%$search%")
                    ->orWhere('id_user', 'like', "%$search%");
            });
        }

        $perPage = 5;
        $total = $query->count();
        $maxPage = max(1, ceil($total / $perPage));

        $pageInput = $request->input('page', '1');

        // Kiểm tra page hợp lệ
        if ($request->has('page')) {
            // ctype_digit() để check chỉ có số (ko âm, ko dấu)
            if (!ctype_digit($pageInput) || (int)$pageInput < 1 || (int)$pageInput > $maxPage) {
                // Trả về trang lỗi tùy chỉnh (status 200 để trình duyệt hiển thị)
                return response()->view('errors.invalid-page', [], 200);
            }
        }

        $currentPage = (int)$pageInput;

        // Truyền page hợp lệ cho paginate, không dùng mặc định lấy page từ request
        $exportOrders = $query->orderBy('created_at', $sortOrder)
            ->paginate($perPage, ['*'], 'page', $currentPage);

        return view('exportorder.exportorder', compact('exportOrders', 'sortOrder'));
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
        // Validate các trường 
        $request->validate([
            'khach_hang' => 'required|string|max:30',
            'tri_gia' => 'required|numeric|min:0',
            'products' => 'required|array|min:1',
            'products.*.code' => 'required|integer|exists:products,id',
            'products.*.quantity' => 'required|integer|min:1',
            'products.*.price' => 'required|numeric|min:0',
        ], [
            // khach_hang
            'khach_hang.required' => 'Bạn phải nhập tên khách hàng.',
            'khach_hang.string' => 'Tên khách hàng phải là chuỗi ký tự.',
            'khach_hang.max' => 'Tên khách hàng không được vượt quá 30 ký tự.',
            'khach_hang.regex' => 'Tên khách hàng không được để trống hoặc chỉ chứa khoảng trắng.',
            'products.required' => 'Bạn phải thêm ít nhất một sản phẩm.',
        ]);

        try {
            // Các phần kiểm tra tồn kho và xử lý phiếu xuất 
            foreach ($request->products as $productInput) {
                $product = Product::find($productInput['code']);

                if ($productInput['quantity'] > $product->quantity) {
                    return redirect()->back()
                        ->withInput()
                        ->with('error', "Sản phẩm {$product->name} chỉ còn {$product->quantity} trong kho, không thể xuất số lượng yêu cầu.");
                }
            }
            $exists = ExportOrder::where('id_customer', $request->khach_hang)
                ->where('id_user', Auth::id())
                ->where('total_price', $request->tri_gia)
                ->where('created_at', '>=', now()->subSeconds(5))
                ->exists();

            if ($exists) {
                return redirect()->back()
                    ->withInput()
                    ->with('error', 'Phiếu xuất này đã được tạo gần đây. Vui lòng đợi một chút trước khi tạo lại.');
            }


            $exportOrder = ExportOrder::create([
                'id_customer' => $request->khach_hang,
                'id_user' => Auth::id(),
                'total_price' => $request->tri_gia,
            ]);

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
    public function destroy($id, $key)
    {
        $expectedKey = md5('delete-secret-' . $id);

        if ($key !== $expectedKey) {
            return redirect()->route('exportorder.index')->with('error', 'Yêu cầu không hợp lệ!');
        }

        try {
            $exportOrder = ExportOrder::findOrFail($id);
            $exportOrder->details()->delete();
            $exportOrder->delete();

            return redirect()->route('exportorder.index')->with('success', 'Xoá phiếu xuất thành công!');
        } catch (ModelNotFoundException $e) {
            return redirect()->route('exportorder.index')->with('error', 'Phiếu xuất không tồn tại hoặc đã bị xoá trước đó.');
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
