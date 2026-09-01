<?php

namespace App\Modules\Admin\Controllers;

use App\Modules\User\Models\UserModel;

class Dashboard extends AdminController
{
    protected string $menu = 'dashboard';

    public function index(): string
    {
        $users = new UserModel();

        return $this->render('App\Modules\Admin\Views\dashboard', [
            'title' => 'Dashboard',
            'stats' => [
                'users'    => $users->countAllResults(),
                'active'   => $users->where('is_active', 1)->countAllResults(),
                'admins'   => $users->where('role', 'admin')->countAllResults(),
            ],
            'recent' => $users->orderBy('id', 'DESC')->findAll(5),
        ]);
    }
}
