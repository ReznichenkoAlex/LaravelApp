<?php
return [
    'redirect' => [
        'admin' => [
            'category' => [
                'created' => 'Категория успешно добавлена',
                'updated' => 'Категория успешно обновлена',
                'deleted' => 'Категория успешно удалена'
            ],
            'order' => [
                'created' => 'Заказ успешно добавлен',
                'updated' => 'Заказ успешно обновлен',
                'deleted' => 'Заказ успешно удален'
            ],
            'product' => [
                'created' => 'Товар успешно добавлен',
                'updated' => 'Товар успешно обновлен',
                'deleted' => 'Товар успешно удален'
            ]

        ]
    ],
    'db_retrieve_count' => [
        'paginate' => [
            'index' => '6',
            'category' => '4',
            'admin' => [
                'product' => '7',
                'category' => '3',
                'order' => '5'
            ]
        ],
        'limit' => [
            'about' => '3'
        ]
    ],
    'imageSize' => [
        'product' => [
            'width' => '616',
            'height' => '353'
        ],
    ],
    'document_root' => $_SERVER['DOCUMENT_ROOT'],
];
