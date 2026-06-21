window.addEventListener('load', function () {
  const loader = document.getElementById('siteLoader');
  if (loader) {
    setTimeout(function () {
      loader.classList.add('is-hidden');
    }, 260);
  }
});

const topbar = document.getElementById('topbar');
window.addEventListener('scroll', function () {
  if (!topbar) return;
  topbar.classList.toggle('is-scrolled', window.scrollY > 12);
});

const reveals = document.querySelectorAll('.reveal');
if (reveals.length > 0) {
  const observer = new IntersectionObserver(function (entries) {
    entries.forEach(function (entry) {
      if (entry.isIntersecting) {
        entry.target.classList.add('is-visible');
        observer.unobserve(entry.target);
      }
    });
  }, { threshold: 0.18 });

  reveals.forEach(function (item) {
    observer.observe(item);
  });
}

const navToggle = document.querySelector('[data-nav-toggle]');
const navMenu = document.querySelector('[data-nav-menu]');
if (navToggle && navMenu) {
  navToggle.addEventListener('click', function () {
    const isOpen = navMenu.classList.toggle('is-open');
    navToggle.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
  });

  navMenu.querySelectorAll('a').forEach(function (link) {
    link.addEventListener('click', function () {
      navMenu.classList.remove('is-open');
      navToggle.setAttribute('aria-expanded', 'false');
    });
  });
}
