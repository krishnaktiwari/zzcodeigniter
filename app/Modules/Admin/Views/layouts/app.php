<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex, nofollow">
    <title><?= esc($title ?? '') !== '' ? esc($title) . ' &middot; ' : '' ?><?= esc($panelName ?? 'Admin') ?></title>

    <!-- Quicksand -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600;700&display=swap">

    <!-- Bootstrap 5 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">

    <!-- Font Awesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <!-- Theme -->
    <link rel="stylesheet" href="<?= base_url('assets/themes/app/css/style.css') ?>">

    <?= $this->renderSection('styles') ?>
</head>

<body class="bg-body-tertiary">

    <div class="d-flex">

        <?= $this->include('App\Modules\Admin\Views\partials\sidebar') ?>

        <div class="flex-grow-1 min-vh-100 d-flex flex-column">

            <?= $this->include('App\Modules\Admin\Views\partials\header') ?>

            <main class="flex-grow-1 p-3 p-lg-4">
                <?= $this->include('App\Modules\Admin\Views\partials\alerts') ?>
                <?= $this->renderSection('content') ?>
            </main>

            <?= $this->include('App\Modules\Admin\Views\partials\footer') ?>
        </div>
    </div>

    <!-- Bootstrap 5 JS Bundle (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Theme -->
    <script src="<?= base_url('assets/themes/app/js/script.js') ?>"></script>

    <?= $this->renderSection('scripts') ?>
</body>

</html>
