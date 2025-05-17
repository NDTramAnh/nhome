<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public $timestamps = true; // Nếu bạn dùng $table->timestamps()

    protected $primaryKey = 'id_product';

    protected $fillable = [
        'code',
        'name_product',
        'category',
        'description',
        'stock_quantity',
        'price',
        'status',
        'user_id', // ✅ Đảm bảo có dòng này
    ];
    public function getRouteKeyName()
    {
        return 'id_product';
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
