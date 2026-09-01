<?= $this->extend('App\Modules\Admin\Views\layouts\app') ?>

<?= $this->section('content') ?>

<?php
/**
 * @var array<string, int>            $stats
 * @var list<array<string, mixed>>    $recent
 */
$cards = [
    ['label' => 'Total Users',  'value' => $stats['users'],  'icon' => 'fa-users',        'tone' => 'primary'],
    ['label' => 'Active',       'value' => $stats['active'], 'icon' => 'fa-user-check',   'tone' => 'success'],
    ['label' => 'Admins',       'value' => $stats['admins'], 'icon' => 'fa-user-shield',  'tone' => 'warning'],
];
?>

<div class="row g-3 mb-4">
    <?php foreach ($cards as $card): ?>
        <div class="col-12 col-sm-6 col-xl-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body d-flex align-items-center gap-3">
                    <span class="d-inline-flex align-items-center justify-content-center rounded-3 bg-<?= $card['tone'] ?>-subtle text-<?= $card['tone'] ?>-emphasis" style="width:48px;height:48px;">
                        <i class="fa-solid <?= $card['icon'] ?> fs-5"></i>
                    </span>
                    <div>
                        <div class="text-body-secondary small"><?= esc($card['label']) ?></div>
                        <div class="fs-4 fw-semibold"><?= esc((string) $card['value']) ?></div>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-header bg-body d-flex justify-content-between align-items-center">
        <span class="fw-semibold">Newest Users</span>
        <a href="<?= base_url('admin/users') ?>" class="btn btn-sm btn-outline-primary">View all</a>
    </div>

    <?php if ($recent === []): ?>
        <div class="card-body text-center text-body-secondary py-5">
            <i class="fa-regular fa-folder-open fs-3 d-block mb-2"></i>
            No users yet.
        </div>
    <?php else: ?>
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Role</th>
                        <th scope="col">Joined</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($recent as $user): ?>
                        <tr>
                            <td><?= esc($user['name']) ?></td>
                            <td><?= esc($user['email']) ?></td>
                            <td><span class="badge text-bg-secondary"><?= esc($user['role']) ?></span></td>
                            <td class="text-body-secondary small"><?= esc((string) $user['created_at']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</div>

<?= $this->endSection() ?>
