<?= $this->extend('App\Modules\Admin\Views\layouts\app') ?>

<?= $this->section('content') ?>

<?php
/**
 * @var list<array<string, mixed>> $users
 * @var string                     $search
 */
?>

<div class="card border-0 shadow-sm">
    <div class="card-header bg-body d-flex flex-wrap gap-2 justify-content-between align-items-center">

        <form method="get" action="<?= base_url('admin/users') ?>" class="d-flex gap-2" role="search">
            <input type="search" name="q" value="<?= esc($search) ?>" class="form-control form-control-sm"
                   placeholder="Search name or email" aria-label="Search users">
            <button class="btn btn-sm btn-outline-secondary" type="submit">
                <i class="fa-solid fa-magnifying-glass"></i>
            </button>
            <?php if ($search !== ''): ?>
                <a href="<?= base_url('admin/users') ?>" class="btn btn-sm btn-link">Clear</a>
            <?php endif; ?>
        </form>

        <a href="<?= base_url('admin/users/new') ?>" class="btn btn-sm btn-primary">
            <i class="fa-solid fa-plus me-1"></i> Add User
        </a>
    </div>

    <?php if ($users === []): ?>
        <div class="card-body text-center text-body-secondary py-5">
            <i class="fa-regular fa-folder-open fs-3 d-block mb-2"></i>
            <?= $search !== '' ? 'No users match that search.' : 'No users yet.' ?>
        </div>
    <?php else: ?>
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Role</th>
                        <th scope="col">Status</th>
                        <th scope="col" class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user): ?>
                        <tr>
                            <td class="text-body-secondary"><?= esc((string) $user['id']) ?></td>
                            <td class="fw-medium"><?= esc($user['name']) ?></td>
                            <td><?= esc($user['email']) ?></td>
                            <td><span class="badge text-bg-secondary"><?= esc($user['role']) ?></span></td>
                            <td>
                                <?php if ((int) $user['is_active'] === 1): ?>
                                    <span class="badge text-bg-success">Active</span>
                                <?php else: ?>
                                    <span class="badge text-bg-secondary">Inactive</span>
                                <?php endif; ?>
                            </td>
                            <td class="text-end text-nowrap">
                                <a href="<?= base_url('admin/users/' . $user['id'] . '/edit') ?>"
                                   class="btn btn-sm btn-outline-secondary" aria-label="Edit <?= esc($user['name']) ?>">
                                    <i class="fa-solid fa-pen"></i>
                                </a>

                                <form method="post" action="<?= base_url('admin/users/' . $user['id'] . '/delete') ?>"
                                      class="d-inline"
                                      onsubmit="return confirm('Delete <?= esc($user['name'], 'js') ?>?');">
                                    <?= csrf_field() ?>
                                    <button type="submit" class="btn btn-sm btn-outline-danger"
                                            aria-label="Delete <?= esc($user['name']) ?>">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <?php if ($pager !== null && $pager->getPageCount() > 1): ?>
            <div class="card-footer bg-body">
                <?= $pager->links() ?>
            </div>
        <?php endif; ?>
    <?php endif; ?>
</div>

<?= $this->endSection() ?>
