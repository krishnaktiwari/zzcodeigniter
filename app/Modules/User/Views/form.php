<?= $this->extend('App\Modules\Admin\Views\layouts\app') ?>

<?= $this->section('content') ?>

<?php
/**
 * Shared by "Add User" and "Edit User" — $user is null when creating.
 *
 * @var array<string, mixed>|null $user
 */
$isEdit = $user !== null;
$action = $isEdit ? base_url('admin/users/' . $user['id']) : base_url('admin/users');

// Only fall back to old() when this form is being redisplayed after a failed
// submit — otherwise leftover flashdata from another form leaks in here.
$repopulate = session()->has('errors');

$value = static fn (string $field, string $default = ''): string
    => $repopulate ? (string) old($field, $default) : $default;
?>

<div class="row">
    <div class="col-12 col-lg-8 col-xl-6">
        <div class="card border-0 shadow-sm">
            <form method="post" action="<?= $action ?>">
                <?= csrf_field() ?>

                <div class="card-body vstack gap-3">

                    <div>
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" required
                               value="<?= esc($value('name', $isEdit ? (string) $user['name'] : '')) ?>">
                    </div>

                    <div>
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required
                               value="<?= esc($value('email', $isEdit ? (string) $user['email'] : '')) ?>">
                    </div>

                    <div>
                        <label for="password" class="form-label">
                            Password
                            <?php if ($isEdit): ?>
                                <span class="text-body-secondary fw-normal">&mdash; leave blank to keep the current one</span>
                            <?php endif; ?>
                        </label>
                        <input type="password" class="form-control" id="password" name="password"
                               autocomplete="new-password" <?= $isEdit ? '' : 'required' ?>>
                        <div class="form-text">Minimum 8 characters.</div>
                    </div>

                    <div>
                        <label for="role" class="form-label">Role</label>
                        <?php $currentRole = $value('role', $isEdit ? (string) $user['role'] : 'user'); ?>
                        <select class="form-select" id="role" name="role" required>
                            <?php foreach (\App\Modules\User\Models\UserModel::ROLES as $role): ?>
                                <option value="<?= esc($role) ?>" <?= $currentRole === $role ? 'selected' : '' ?>>
                                    <?= esc(ucfirst($role)) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-check form-switch">
                        <?php
                        // On a failed submit an unchecked box posts nothing, so trust
                        // old() only when the form is actually being repopulated.
                        $isActive = $repopulate
                            ? old('is_active') !== null
                            : (! $isEdit || (int) $user['is_active'] === 1);
                        ?>
                        <input class="form-check-input" type="checkbox" role="switch" id="is_active"
                               name="is_active" value="1" <?= $isActive ? 'checked' : '' ?>>
                        <label class="form-check-label" for="is_active">Active</label>
                    </div>
                </div>

                <div class="card-footer bg-body d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="fa-solid fa-floppy-disk me-1"></i>
                        <?= $isEdit ? 'Save Changes' : 'Create User' ?>
                    </button>
                    <a href="<?= base_url('admin/users') ?>" class="btn btn-outline-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
