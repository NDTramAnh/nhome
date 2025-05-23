<?php

return [
    'unique' => ':attribute đã tồn tại.',
    'required' => ':attribute không được để trống.',
    'max' => [
        'string' => ':attribute không được vượt quá :max ký tự.',
    ],
    'numeric' => ':attribute phải là số.',
    'integer' => ':attribute phải là số nguyên.',
    // ... các thông báo khác bạn cần

    'attributes' => [
        'name' => 'Tên sản phẩm',
        'category' => 'Danh mục',
        'quantity' => 'Số lượng trong kho',
        'price' => 'Giá tiền',
        'status' => 'Tình trạng',
        // thêm nếu cần
    ],
];