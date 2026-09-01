<header class="site-header navbar navbar-expand-lg sticky-top">
    <div class="container">

        <!-- Brand -->
        <a class="navbar-brand" href="<?= base_url('/') ?>">
            <span class="navbar-brand__logo" aria-hidden="true">S</span>
            <span class="navbar-brand__name">Shubh</span>
        </a>

        <!-- Mobile toggler -->
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMain"
            aria-controls="navbarMain" aria-expanded="false" aria-label="Toggle navigation">
            <span class="toggler-icon" aria-hidden="true"></span>
        </button>

        <!-- Collapsible nav -->
        <div class="collapse navbar-collapse" id="navbarMain">
            <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-1 mb-2 mb-lg-0">

                <li class="nav-item">
                    <a class="nav-link <?= (current_url() === base_url('/') || uri_string() === '') ? 'active' : '' ?>"
                        href="<?= base_url('/') ?>">
                        <i class="fa-solid fa-house nav-link__icon" aria-hidden="true"></i>
                        Home
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link <?= (str_contains(uri_string(), 'about')) ? 'active' : '' ?>"
                        href="<?= base_url('about') ?>">
                        <i class="fa-solid fa-circle-info nav-link__icon" aria-hidden="true"></i>
                        About
                    </a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        <i class="fa-solid fa-layer-group nav-link__icon" aria-hidden="true"></i>
                        Pages
                    </a>
                    <ul class="dropdown-menu dropdown-menu-lg-end">
                        <li>
                            <a class="dropdown-item" href="<?= base_url('about') ?>">
                                <i class="fa-solid fa-circle-info dropdown-item__icon" aria-hidden="true"></i>
                                About Us
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="<?= base_url('contact') ?>">
                                <i class="fa-solid fa-envelope dropdown-item__icon" aria-hidden="true"></i>
                                Contact
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <a class="dropdown-item" href="<?= base_url('privacy') ?>">
                                <i class="fa-solid fa-shield-halved dropdown-item__icon" aria-hidden="true"></i>
                                Privacy Policy
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="<?= base_url('terms') ?>">
                                <i class="fa-solid fa-file-lines dropdown-item__icon" aria-hidden="true"></i>
                                Terms of Service
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a class="nav-link <?= (str_contains(uri_string(), 'contact')) ? 'active' : '' ?>"
                        href="<?= base_url('contact') ?>">
                        <i class="fa-solid fa-envelope nav-link__icon" aria-hidden="true"></i>
                        Contact
                    </a>
                </li>

            </ul>

            <!-- CTA button -->
            <div class="nav-cta ms-lg-3">
                <a href="<?= base_url('contact') ?>" class="btn btn-nav-cta">
                    Get in Touch
                    <i class="fa-solid fa-arrow-right btn-nav-cta__arrow" aria-hidden="true"></i>
                </a>
            </div>
        </div>

    </div>
</header>