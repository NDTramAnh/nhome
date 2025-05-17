<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
<<<<<<< HEAD
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
=======
    protected $table = 'products';
    protected $primaryKey = 'id_product';
    public $timestamps = false;

    protected $fillable = [
        'name_product',
        'category',
        'price',
        'stock_quantity',
        'create_at',
        'update_at',
        'status',
    ];
>>>>>>> e2a497866853346a56073bd70bcec8cb42b9f88d
}
