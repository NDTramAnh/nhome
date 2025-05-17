<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExportOrderDetail extends Model
{
    protected $table = 'export_order_details'; // tên bảng

    protected $fillable = [
        'id',
        'id_export',      // khóa ngoại liên kết với export_orders.id_export
        'id_product',   // mã sản phẩm         
        'quantity', 
          'price',      // số lượng
        'subtotal', 
        'id-customer',      // thành tiền
        'created_at',
        'id_user',     // ngày nhập (nếu là created_at)
    ];

    public $timestamps = true;
}
