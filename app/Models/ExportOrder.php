<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ExportOrder extends Model
{
    use HasFactory;

    
    protected $table = 'export_orders';

   
    protected $fillable = [
        'id_export',
        'customer',
        'creator',
        'created_at',
        'total_price',
    ];
     public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function details()
    {
        return $this->hasMany(ExportOrderDetail::class, 'id_export');
    }
}
