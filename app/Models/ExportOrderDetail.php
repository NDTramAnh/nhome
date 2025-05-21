<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExportOrderDetail extends Model
{
    protected $table = 'export_order_details'; // tên bảng

    protected $fillable = [
        'id_export',
        'product_id',
        'quantity',
        'price',
        'subtotal',
        'id_customer',
        'id_user',
    ];

    public $timestamps = true;

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    public function exportOrder()
    {
        return $this->belongsTo(ExportOrder::class, 'id_export', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }
}
