<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExportOrder extends Model
{
     protected $primaryKey = 'id_export';
    public $timestamps = false;

    public function details()
    {
        return $this->hasMany(ExportOrdersDetail::class, 'id_export');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function customer()
    {
        return $this->belongsTo(User::class, 'id_customer');
    }
}
