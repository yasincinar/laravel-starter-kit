<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    function __construct()
    {
        $menuItems = [
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

        $sharedData = [
            'menuItems' => $menuItems
        ];

        view()->share($sharedData);
    }
}
