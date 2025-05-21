<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
<<<<<<< HEAD

class ExportOrder extends Model
{
     protected $primaryKey = 'id_export';
    public $timestamps = false;

    public function details()
    {
        return $this->hasMany(ExportOrdersDetail::class, 'id_export');
    }

    public function user()
=======
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ExportOrder extends Model
{
    use HasFactory;

    
    protected $table = 'export_orders';

   
    protected $fillable = [
        'id_customer',
        'id_user',
        'created_at',
        'total_price',
    ];
     public function user()
>>>>>>> export-order
    {
        return $this->belongsTo(User::class, 'id_user');
    }

<<<<<<< HEAD
    public function customer()
    {
        return $this->belongsTo(User::class, 'id_customer');
=======
    public function details()
    {
        return $this->hasMany(ExportOrderDetail::class, 'id_export');
    }
     public function orderDetails()
    {
        return $this->hasMany(ExportOrderDetail::class, 'id_export', 'id');
>>>>>>> export-order
    }
}
