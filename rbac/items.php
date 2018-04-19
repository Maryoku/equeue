<?php
return [
    'admin' => [
        'type' => 1,
        'children' => [
            /*'operator',*/
            'viewAdminPage',
        ],
    ],
    'operator' => [
        'type' => 1,
        'children' => [
            'viewOperator',
        ],
    ],
    'viewAdminPage' => [
        'type' => 2,
        'description' => 'Просмотр админки',
    ],
    'viewOperator' => [
        'type' => 2,
        'description' => 'Cтраница оператора',
    ],
];
