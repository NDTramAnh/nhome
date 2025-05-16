<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
     protected $primaryKey = 'id_supplier';
    public $timestamps = false;

    public function importOrders()
    {
        return $this->hasMany(ImportOrder::class, 'supplier_id');
    }
}
