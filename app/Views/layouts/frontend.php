<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $this->renderSection('title') ?: 'Home' ?></title>

    <!-- Quicksand -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600;700&display=swap">

    <!-- Bootstrap 5 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">

    <!-- Font Awesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <!-- Theme -->
    <link rel="stylesheet" href="<?= base_url('assets/themes/frontend/css/style.css') ?>">

    <?= $this->renderSection('styles') ?>

    <!-- Google structured data (JSON-LD) -->
    <?= $this->include('partials/frontend/schema') ?>
</head>

<body class="d-flex flex-column min-vh-100">

    <?= $this->include('partials/frontend/header') ?>

    <main class="flex-grow-1">
        <?= $this->renderSection('content') ?>
    </main>

    <?= $this->include('partials/frontend/footer') ?>

    <!-- Bootstrap 5 JS Bundle (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Theme -->
    <script src="<?= base_url('assets/themes/frontend/js/script.js') ?>"></script>

    <?= $this->renderSection('scripts') ?>
</body>

</html>
