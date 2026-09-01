<?php
/**
 * Sidebar navigation. $menu holds the key of the active section, set by each
 * admin controller: protected string $menu = 'users';
 *
 * @var string $menu
 * @var string $panelName
 */
$nav = [
    'dashboard' => ['label' => 'Dashboard', 'icon' => 'fa-gauge-high', 'uri' => 'admin'],
    'users'     => ['label' => 'Users',     'icon' => 'fa-users',      'uri' => 'admin/users'],
];
?>
<aside class="d-none d-lg-flex flex-column bg-dark text-white vh-100 position-sticky top-0" style="width: 250px;">

    <a href="<?= base_url('admin') ?>" class="d-flex align-items-center gap-2 p-3 text-white text-decoration-none border-bottom border-secondary">
        <i class="fa-solid fa-cube fs-5"></i>
        <span class="fs-5 fw-semibold"><?= esc($panelName ?? 'Admin') ?></span>
    </a>

    <ul class="nav nav-pills flex-column p-2 gap-1">
        <?php foreach ($nav as $key => $item): ?>
            <li class="nav-item">
                <a href="<?= base_url($item['uri']) ?>"
                   class="nav-link d-flex align-items-center gap-2 <?= ($menu ?? '') === $key ? 'active' : 'text-white-50' ?>">
                    <i class="fa-solid <?= $item['icon'] ?> fa-fw"></i>
                    <?= esc($item['label']) ?>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>

    <div class="mt-auto p-3 small text-white-50 border-top border-secondary">
        <?= esc($panelName ?? 'Admin') ?>
    </div>
</aside>
