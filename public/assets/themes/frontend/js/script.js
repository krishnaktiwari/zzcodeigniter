/*
 * Frontend theme scripts.
 */
(function () {
    'use strict';

    var header = document.querySelector('.site-header');

    if (!header) {
        return;
    }

    /* Compact / shadowed header once the page is scrolled. */
    var ticking = false;

    function syncScrollState() {
        header.classList.toggle('is-scrolled', window.scrollY > 8);
        ticking = false;
    }

    window.addEventListener('scroll', function () {
        if (!ticking) {
            ticking = true;
            window.requestAnimationFrame(syncScrollState);
        }
    }, { passive: true });

    syncScrollState();

    /* The toggler is a <span>, so Enter / Space have to be wired up by hand. */
    var toggler = header.querySelector('.navbar-toggler[role="button"]');

    if (toggler) {
        toggler.addEventListener('keydown', function (event) {
            if (event.key === 'Enter' || event.key === ' ' || event.key === 'Spacebar') {
                event.preventDefault();
                toggler.click();
            }
        });
    }
}());
