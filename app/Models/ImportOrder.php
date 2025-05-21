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

    // Mối quan hệ: một đơn nhập có nhiều chi tiết nhập
    public function details()
    {
        return $this->hasMany(ImportOrdersDetail::class, 'id_import', 'id_import');
    }

    // Mối quan hệ: một đơn nhập thuộc về một người dùng
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    // Mối quan hệ: một đơn nhập thuộc về một nhà cung cấp
    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id', 'id_supplier');
    }
}
