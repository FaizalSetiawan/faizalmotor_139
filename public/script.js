let prevScroll = window.pageYOffset;
window.onscroll = function() {
  let currentScroll = window.pageYOffset;

  if (prevScroll > currentScroll) {
    document.querySelector(".navbar").style.top = "0";
  } else {
    document.querySelector(".navbar").style.top = "-80px";
  }

  prevScroll = currentScroll;

  // Parallax effect untuk hero
  const heroContent = document.querySelector('.hero-content');
  const scrolled = window.pageYOffset;
  const rate = scrolled * -0.5;
  heroContent.style.transform = `translateY(${rate}px)`;
}

// ANIMASI SCROLL
const elements = document.querySelectorAll('.animate');

const observer = new IntersectionObserver((entries) => {
  entries.forEach(entry => {
    if (entry.isIntersecting) {
      entry.target.classList.add('show');
    }
  });
});

elements.forEach(el => observer.observe(el));

// Interaksi pada kategori card
const kategoriCards = document.querySelectorAll('.kategori-card');
kategoriCards.forEach(card => {
  card.addEventListener('click', () => {
    // Scroll ke section produk
    document.querySelector('.produk').scrollIntoView({ behavior: 'smooth' });
    // Tambahkan efek flash atau sesuatu
    card.style.animation = 'flash 0.5s';
    setTimeout(() => card.style.animation = '', 500);
  });
});

// Tambahkan animasi flash
const style = document.createElement('style');
style.textContent = `
  @keyframes flash {
    0% { background: white; }
    50% { background: #38bdf8; }
    100% { background: white; }
  }
`;
document.head.appendChild(style);