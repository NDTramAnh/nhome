<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ImportOrder extends Model
{
    protected $primaryKey = 'id_import';
    public $timestamps = false;

    protected $fillable = [
        'supplier_id',
        'user_id',
        'total_price',
        'import_date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id', 'id_supplier');
    }

    public function details()
    {
        return $this->hasMany(ImportOrderDetail::class, 'id_import', 'id_import');
        
    }


}

