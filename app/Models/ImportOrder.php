<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ImportOrder extends Model
{
    protected $primaryKey = 'id_import';
    public $timestamps = false;

    public function details()
    {
        return $this->hasMany(ImportOrdersDetail::class, 'id_import');
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
