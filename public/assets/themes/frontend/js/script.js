/*
 * Frontend theme scripts.
 */
(function () {
  "use strict";

  var header = document.querySelector(".site-header");

  if (!header) {
    return;
  }

  /* ------------------------------------------------------------------
   * Compact / shadowed header once the page is scrolled.
   * ------------------------------------------------------------------ */
  var ticking = false;

  function syncScrollState() {
    header.classList.toggle("is-scrolled", window.scrollY > 8);
    ticking = false;
  }

  window.addEventListener(
    "scroll",
    function () {
      if (!ticking) {
        ticking = true;
        window.requestAnimationFrame(syncScrollState);
      }
    },
    { passive: true },
  );

  syncScrollState(); // run once on load

  /* ------------------------------------------------------------------
   * Keyboard support for the toggler.
   * <button> handles Enter/Space natively, but older versions used a
   * <span role="button"> — wire it up just in case.
   * ------------------------------------------------------------------ */
  var toggler = header.querySelector('.navbar-toggler[role="button"]');

  if (toggler) {
    toggler.addEventListener("keydown", function (event) {
      if (
        event.key === "Enter" ||
        event.key === " " ||
        event.key === "Spacebar"
      ) {
        event.preventDefault();
        toggler.click();
      }
    });
  }

  /* ------------------------------------------------------------------
   * Close mobile menu when a nav link is clicked (single-page behaviour).
   * ------------------------------------------------------------------ */
  var navbarCollapse = header.querySelector(".navbar-collapse");

  if (navbarCollapse) {
    navbarCollapse.addEventListener("click", function (event) {
      var link = event.target.closest(
        ".nav-link:not(.dropdown-toggle), .dropdown-item",
      );
      if (!link) {
        return;
      }

      // Only collapse on mobile (when collapse is actually open)
      if (
        window.innerWidth < 992 &&
        navbarCollapse.classList.contains("show")
      ) {
        var bsCollapse = bootstrap.Collapse.getInstance(navbarCollapse);
        if (bsCollapse) {
          bsCollapse.hide();
        }
      }
    });
  }
})();
