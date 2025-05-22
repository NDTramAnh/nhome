<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
<<<<<<< HEAD
<<<<<<< HEAD
    public $timestamps = true; // Nếu bạn dùng $table->timestamps()

=======
>>>>>>> 0d085d8bdd65f96c38ff0433fefd13c8a0c11af3
    protected $primaryKey = 'id_product';

    protected $fillable = [
        'name_product',
        'category',
        'stock_quantity',
        'price',
        'status',
        'user_id',
        'create_at',
        'update_at',
    ];

   protected $casts = [
    'create_at' => 'datetime',
    'update_at' => 'datetime',
];

    public $timestamps = false; // Vì bạn dùng create_at & update_at custom, không phải created_at, updated_at

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
<<<<<<< HEAD
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
=======
    
}
>>>>>>> 0d085d8bdd65f96c38ff0433fefd13c8a0c11af3
