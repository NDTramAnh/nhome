<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $primaryKey = 'id_supplier';
    public $timestamps = false;

    protected $fillable = [
        'name_supplier',
        'phone_supplier',
        'email',
        'address',
        'create_at',
    ];

    public function importOrders()
    {
        return $this->hasMany(ImportOrder::class, 'supplier_id', 'id_supplier');
    }
}
