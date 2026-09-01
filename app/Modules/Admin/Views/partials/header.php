<?php
/**
 * Admin topbar: mobile nav toggle, page title, breadcrumbs and account menu.
 *
 * @var string                $title
 * @var array<string, string> $breadcrumbs
 */
?>
<header class="bg-body border-bottom">
    <div class="d-flex align-items-center gap-3 px-3 px-lg-4 py-3">

        <button class="btn btn-outline-secondary d-lg-none" type="button"
                data-bs-toggle="offcanvas" data-bs-target="#adminNav" aria-controls="adminNav">
            <i class="fa-solid fa-bars"></i>
        </button>

        <div class="me-auto">
            <h1 class="h5 mb-0"><?= esc($title ?? '') ?></h1>

            <?php if (! empty($breadcrumbs)): ?>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 small">
                        <li class="breadcrumb-item"><a href="<?= base_url('admin') ?>">Home</a></li>
                        <?php foreach ($breadcrumbs as $label => $uri): ?>
                            <?php if ($uri === ''): ?>
                                <li class="breadcrumb-item active" aria-current="page"><?= esc($label) ?></li>
                            <?php else: ?>
                                <li class="breadcrumb-item"><a href="<?= base_url($uri) ?>"><?= esc($label) ?></a></li>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </ol>
                </nav>
            <?php endif; ?>
        </div>

        <div class="dropdown">
            <a href="#" class="d-flex align-items-center gap-2 text-body text-decoration-none dropdown-toggle"
               role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fa-solid fa-circle-user fs-4"></i>
                <span class="d-none d-sm-inline">Account</span>
            </a>
            <ul class="dropdown-menu dropdown-menu-end">
                <?php // TODO: wire these up once authentication exists. ?>
                <li><a class="dropdown-item" href="#">Profile</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="#">Sign out</a></li>
            </ul>
        </div>
    </div>
</header>

<!-- Mobile mirror of the sidebar -->
<div class="offcanvas offcanvas-start bg-dark text-white" tabindex="-1" id="adminNav">
    <div class="offcanvas-header border-bottom border-secondary">
        <span class="offcanvas-title fs-5 fw-semibold"><?= esc($panelName ?? 'Admin') ?></span>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body p-0">
        <?= $this->include('App\Modules\Admin\Views\partials\sidebar') ?>
    </div>
</div>
