<?php

return [
    'required' => ':attribute không được để trống.',
    'unique' => ':attribute đã tồn tại.',
    'max' => [
        'string' => ':attribute không được vượt quá :max ký tự.',
    ],
    'numeric' => ':attribute phải là số.',
    'integer' => ':attribute phải là số nguyên.',
    // các rule khác ...

    'attributes' => [
        'name_product' => 'Tên sản phẩm',
        'category' => 'Danh mục',
        'stock_quantity' => 'Số lượng trong kho',
        'price' => 'Giá tiền',
        'status' => 'Tình trạng',
        // thêm các trường khác nếu cần
    ],
];