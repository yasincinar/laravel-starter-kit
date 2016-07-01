<?php
/**
 * Created by PhpStorm.
 * User: salihkilic
 * Date: 01/07/16
 * Time: 09:58
 */

return [
    [
        'name' => 'Anasayfa',
        'icon' => 'fa fa-dashboard',
        'link' => '/admin/dashboard',
        'sub' => false
    ],
    [
        'name' => 'Kullanıcılar & Gruplar',
        'icon' => 'fa fa-group',
        'link' => false,
        'sub' => [
            [
                'name' => 'Kullanıcılar',
                'icon' => false,
                'link' => '/admin/users-groups/users',
            ],
            [
                'name' => 'Gruplar',
                'icon' => false,
                'link' => '/admin/users-groups/groups',
            ]
        ],

    ],
];
