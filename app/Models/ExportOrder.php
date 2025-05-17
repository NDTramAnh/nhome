<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ExportOrder extends Model
{
    use HasFactory;

    // Nếu tên bảng KHÔNG phải là export_orders, thì khai báo thủ công:
    protected $table = 'export_orders';

    // Nếu khóa chính không phải 'id' thì ghi rõ:
    // protected $primaryKey = 'ma_phieu';

    // Nếu không dùng timestamps (created_at, updated_at) thì disable:
    // public $timestamps = false;

    // Nếu bạn muốn cho phép insert/update các trường này:
    protected $fillable = [
        'id_export',
        'customer',
        'creator',
        'created_at',
        'total_price',
    ];
}
