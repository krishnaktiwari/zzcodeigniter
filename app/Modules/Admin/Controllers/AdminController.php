<?php

namespace App\Modules\Admin\Controllers;

use App\Controllers\ShubhController;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

/**
 * Base controller for the admin area. Mirrors FrontendController, but renders
 * through the "app" theme (layouts/app) instead of the public frontend one.
 */
class AdminController extends ShubhController
{
    /**
     * Shown in the sidebar brand and appended to every page title.
     */
    protected string $panelName = APP_TITLE;

    /**
     * Sidebar key of the current section, so the active link can be highlighted.
     * Override it in each child controller: protected string $menu = 'users';
     */
    protected string $menu = '';

    /**
     * @return void
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        parent::initController($request, $response, $logger);

        // TODO: auth guard. Once login exists, redirect guests away from here —
        // either in this method or with a route filter on the admin group.

        $this->data['title']     = '';
        $this->data['panelName'] = $this->panelName;
        $this->data['menu']      = $this->menu;
        // Breadcrumb trail: ['Users' => 'admin/users', 'Edit' => ''].
        $this->data['breadcrumbs'] = [];
    }

    /**
     * Render an admin page, merging per-page data over the shared defaults.
     *
     * @param array<string, mixed> $data
     */
    protected function render(string $view, array $data = []): string
    {
        return view($view, array_merge($this->data, $data));
    }
}
