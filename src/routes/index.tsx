import { createFileRoute } from '@tanstack/react-router'
import { useEffect, useRef, useState } from 'react'

export const Route = createFileRoute('/')({
  component: FaizalMotor,
})

const WA_NUMBER = '6281220660964'
const WA_BASE = `https://wa.me/${WA_NUMBER}`

function waLink(text: string) {
  return `${WA_BASE}?text=${encodeURIComponent(text)}`
}

const DEFAULT_WA_MSG =
  'Halo Faizal, saya mau order *HEADLAMP CUSTOM* untuk motor saya. Mohon info lebih lanjut!'

// ─── Data ────────────────────────────────────────────────────────────────────

const categories = [
  {
    id: 'nmax',
    name: 'NMAX 155',
    type: 'Angel Eyes / Demon Eyes',
    price: 'Rp 450.000',
    color: '#00D4FF',
    icon: '💡',
    msg: 'Halo Faizal, saya mau order *HEADLAMP CUSTOM NMAX 155* (Angel Eyes / Demon Eyes) Rp 450rb. Bisa info stok & proses pemasangannya?',
    img: 'https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=400&q=80',
  },
  {
    id: 'xmax',
    name: 'XMAX 250',
    type: 'Projector DRL / Sequential',
    price: 'Rp 650.000',
    color: '#FFD700',
    icon: '🔆',
    msg: 'Halo Faizal, saya mau order *HEADLAMP CUSTOM XMAX 250* (Projector DRL / Sequential) Rp 650rb. Bisa info stok & proses pemasangannya?',
    img: 'https://images.unsplash.com/photo-1568772585407-9361f9bf3a87?w=400&q=80',
  },
  {
    id: 'aerox',
    name: 'Aerox 155',
    type: 'RGB Color Change / Matrix',
    price: 'Rp 500.000',
    color: '#00FF7F',
    icon: '🌈',
    msg: 'Halo Faizal, saya mau order *HEADLAMP CUSTOM AEROX 155* (RGB Color Change / Matrix) Rp 500rb. Bisa info stok & proses pemasangannya?',
    img: 'https://images.unsplash.com/photo-1449426468159-d96dbf08f19f?w=400&q=80',
  },
  {
    id: 'custom',
    name: 'Custom Lain',
    type: 'PCX, ADV, Lexi, dll',
    price: 'Nego WA',
    color: '#FF6B6B',
    icon: '⚙️',
    msg: 'Halo Faizal, saya mau order *HEADLAMP CUSTOM* untuk motor saya (PCX/ADV/Lexi/lainnya). Bisa konsultasi dulu?',
    img: 'https://images.unsplash.com/photo-1558980394-4c7c9299fe96?w=400&q=80',
  },
]

const products = [
  {
    id: 1,
    name: 'NMAX Demon Eyes LED',
    price: 'Rp 480.000',
    rawPrice: 480000,
    specs: ['6000LM Output', 'Sequential Turn', 'IP67 Waterproof'],
    img: 'https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=500&q=80',
    badge: 'BEST SELLER',
    badgeColor: '#FFD700',
  },
  {
    id: 2,
    name: 'XMAX Angel Eyes DRL',
    price: 'Rp 720.000',
    rawPrice: 720000,
    specs: ['Auto ON/OFF', 'Canbus Ready', 'COB Technology'],
    img: 'https://images.unsplash.com/photo-1568772585407-9361f9bf3a87?w=500&q=80',
    badge: 'TOP PICK',
    badgeColor: '#00D4FF',
  },
  {
    id: 3,
    name: 'Aerox RGB Matrix',
    price: 'Rp 550.000',
    rawPrice: 550000,
    specs: ['16 Juta Warna', 'App Control', 'Dynamic Flow'],
    img: 'https://images.unsplash.com/photo-1449426468159-d96dbf08f19f?w=500&q=80',
    badge: 'NEW',
    badgeColor: '#00FF7F',
  },
  {
    id: 4,
    name: 'NMAX Projector Bi-LED',
    price: 'Rp 420.000',
    rawPrice: 420000,
    specs: ['COB Chip', '3 Mode Beam', 'Plug & Play'],
    img: 'https://images.unsplash.com/photo-1558980394-4c7c9299fe96?w=500&q=80',
    badge: 'HEMAT',
    badgeColor: '#FF6B6B',
  },
  {
    id: 5,
    name: 'XMAX Sequential DRL',
    price: 'Rp 680.000',
    rawPrice: 680000,
    specs: ['Dynamic Flow', 'IP67 Rated', 'OEM Fit'],
    img: 'https://images.unsplash.com/photo-1568772585407-9361f9bf3a87?w=500&q=80',
    badge: 'HOT',
    badgeColor: '#FF4500',
  },
  {
    id: 6,
    name: 'PCX Angel Eyes LED',
    price: 'Rp 520.000',
    rawPrice: 520000,
    specs: ['8000LM', 'Canbus', '2 Year Warranty'],
    img: 'https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=500&q=80',
    badge: 'POPULAR',
    badgeColor: '#9B59B6',
  },
  {
    id: 7,
    name: 'ADV 150 Matrix DRL',
    price: 'Rp 590.000',
    rawPrice: 590000,
    specs: ['Matrix LED', 'Sequential', 'IP68 Waterproof'],
    img: 'https://images.unsplash.com/photo-1449426468159-d96dbf08f19f?w=500&q=80',
    badge: 'LIMITED',
    badgeColor: '#FFD700',
  },
  {
    id: 8,
    name: 'Lexi Projector LED',
    price: 'Rp 460.000',
    rawPrice: 460000,
    specs: ['Projector Lens', 'DRL Ring', 'Easy Install'],
    img: 'https://images.unsplash.com/photo-1558980394-4c7c9299fe96?w=500&q=80',
    badge: 'PROMO',
    badgeColor: '#00D4FF',
  },
]

const features = [
  { icon: '🔥', title: 'Terang Gila', desc: '5000–8000 Lumens', color: '#FF4500' },
  { icon: '⚡', title: 'Plug & Play', desc: 'No Modify Needed', color: '#FFD700' },
  { icon: '💎', title: 'Garansi 1 Tahun', desc: 'Kualitas Terjamin', color: '#00D4FF' },
  { icon: '🚚', title: 'COD Jabodetabek', desc: 'Bayar di Tempat', color: '#00FF7F' },
]

const testimonials = [
  {
    name: 'Budi S.',
    city: 'Jakarta',
    rating: 5,
    text: 'Lampunya bikin iri temen tongkrongan! Cahayanya beneran kaya siang hari. Install di rumah cuma 30 menit!',
    motor: 'NMAX 155',
    avatar: 'BS',
  },
  {
    name: 'Rizky A.',
    city: 'Bekasi',
    rating: 5,
    text: 'XMAX gue sekarang jadi pusat perhatian di jalan. DRL-nya keren banget, sequential-nya smooth abis!',
    motor: 'XMAX 250',
    avatar: 'RA',
  },
  {
    name: 'Dika F.',
    city: 'Depok',
    rating: 5,
    text: 'Aerox RGB-nya goyang sesuai musik! Respon WA cepet, pengiriman aman. Recommended banget!',
    motor: 'Aerox 155',
    avatar: 'DF',
  },
  {
    name: 'Hendra W.',
    city: 'Tangerang',
    rating: 5,
    text: 'PCX gue udah pake Angel Eyes dari sini. Garansi beneran dipake waktu ada masalah, langsung diganti!',
    motor: 'PCX 160',
    avatar: 'HW',
  },
]

const galleryItems = [
  {
    before: 'https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=400&q=80',
    after: 'https://images.unsplash.com/photo-1568772585407-9361f9bf3a87?w=400&q=80',
    motor: 'NMAX 155',
  },
  {
    before: 'https://images.unsplash.com/photo-1449426468159-d96dbf08f19f?w=400&q=80',
    after: 'https://images.unsplash.com/photo-1558980394-4c7c9299fe96?w=400&q=80',
    motor: 'XMAX 250',
  },
  {
    before: 'https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=400&q=80',
    after: 'https://images.unsplash.com/photo-1449426468159-d96dbf08f19f?w=400&q=80',
    motor: 'Aerox 155',
  },
]

const stats = [
  { label: 'Pelanggan Puas', target: 2847, suffix: '+' },
  { label: 'Produk Terjual', target: 5120, suffix: '+' },
  { label: 'Kota Terlayani', target: 38, suffix: '' },
  { label: 'Rating Bintang', target: 4.9, suffix: '⭐', isFloat: true },
]

// ─── Counter Hook ─────────────────────────────────────────────────────────────

function useCountUp(target: number, duration = 2000, isFloat = false) {
  const [count, setCount] = useState(0)
  const ref = useRef<HTMLDivElement>(null)
  const started = useRef(false)

  useEffect(() => {
    const observer = new IntersectionObserver(
      ([entry]) => {
        if (entry.isIntersecting && !started.current) {
          started.current = true
          const start = Date.now()
          const tick = () => {
            const elapsed = Date.now() - start
            const progress = Math.min(elapsed / duration, 1)
            const eased = 1 - Math.pow(1 - progress, 3)
            const current = isFloat
              ? parseFloat((eased * target).toFixed(1))
              : Math.floor(eased * target)
            setCount(current)
            if (progress < 1) requestAnimationFrame(tick)
          }
          requestAnimationFrame(tick)
        }
      },
      { threshold: 0.5 }
    )
    if (ref.current) observer.observe(ref.current)
    return () => observer.disconnect()
  }, [target, duration, isFloat])

  return { count, ref }
}

// ─── Particle Background ──────────────────────────────────────────────────────

function ParticleCanvas() {
  const canvasRef = useRef<HTMLCanvasElement>(null)

  useEffect(() => {
    const canvas = canvasRef.current
    if (!canvas) return
    const ctx = canvas.getContext('2d')
    if (!ctx) return

    let animId: number
    const particles: Array<{
      x: number; y: number; vx: number; vy: number; size: number; opacity: number; color: string
    }> = []

    const colors = ['#00D4FF', '#FFD700', '#00FF7F', '#00D4FF']

    const resize = () => {
      canvas.width = window.innerWidth
      canvas.height = window.innerHeight
    }
    resize()
    window.addEventListener('resize', resize)

    for (let i = 0; i < 80; i++) {
      particles.push({
        x: Math.random() * window.innerWidth,
        y: Math.random() * window.innerHeight,
        vx: (Math.random() - 0.5) * 0.5,
        vy: (Math.random() - 0.5) * 0.5,
        size: Math.random() * 2 + 0.5,
        opacity: Math.random() * 0.5 + 0.1,
        color: colors[Math.floor(Math.random() * colors.length)],
      })
    }

    const draw = () => {
      ctx.clearRect(0, 0, canvas.width, canvas.height)
      particles.forEach((p) => {
        p.x += p.vx
        p.y += p.vy
        if (p.x < 0) p.x = canvas.width
        if (p.x > canvas.width) p.x = 0
        if (p.y < 0) p.y = canvas.height
        if (p.y > canvas.height) p.y = 0

        ctx.beginPath()
        ctx.arc(p.x, p.y, p.size, 0, Math.PI * 2)
        ctx.fillStyle = p.color + Math.floor(p.opacity * 255).toString(16).padStart(2, '0')
        ctx.fill()
      })
      animId = requestAnimationFrame(draw)
    }
    draw()

    return () => {
      cancelAnimationFrame(animId)
      window.removeEventListener('resize', resize)
    }
  }, [])

  return (
    <canvas
      ref={canvasRef}
      id="particle-canvas"
      aria-hidden="true"
    />
  )
}

// ─── Popup Component ──────────────────────────────────────────────────────────

function PromoPopup({ onClose }: { onClose: () => void }) {
  return (
    <div
      className="fixed inset-0 z-50 flex items-center justify-center p-4"
      style={{ background: 'rgba(0,0,0,0.85)', backdropFilter: 'blur(4px)' }}
    >
      <div
        className="relative w-full max-w-md rounded-2xl p-8 text-center"
        style={{
          background: 'linear-gradient(135deg, #141414 0%, #1a1a1a 100%)',
          border: '1px solid #FFD700',
          boxShadow: '0 0 30px #FFD70040, 0 0 60px #FFD70020',
        }}
      >
        <button
          onClick={onClose}
          className="absolute top-4 right-4 text-gray-400 hover:text-white text-xl transition-colors"
          aria-label="Tutup"
        >
          ✕
        </button>

        <div className="text-5xl mb-4">🔥</div>
        <h2
          className="text-2xl font-black mb-2"
          style={{ fontFamily: 'Orbitron', color: '#FFD700', textShadow: '0 0 15px #FFD70080' }}
        >
          PROMO HARI INI!
        </h2>
        <p className="text-white text-lg mb-1">
          <strong>DISKON Rp 50.000</strong>
        </p>
        <p className="text-gray-300 text-sm mb-6">
          Untuk 5 pembeli pertama hari ini!
          <br />
          Stok terbatas – segera order sekarang!
        </p>

        <div
          className="text-3xl font-black mb-6"
          style={{ fontFamily: 'Orbitron', color: '#00D4FF' }}
        >
          ⏰ LIMITED TIME
        </div>

        <a
          href={waLink(
            'Halo Faizal! Saya mau klaim *DISKON Rp 50.000* untuk 5 pembeli pertama hari ini. Boleh info produk yang tersedia?'
          )}
          target="_blank"
          rel="noopener noreferrer"
          onClick={onClose}
          className="block w-full py-4 rounded-xl font-bold text-lg transition-all duration-300"
          style={{
            background: 'linear-gradient(135deg, #00FF7F, #00D4FF)',
            color: '#000',
            boxShadow: '0 0 20px #00FF7F60',
          }}
          onMouseEnter={(e) => {
            ;(e.target as HTMLAnchorElement).style.boxShadow = '0 0 30px #00FF7F80, 0 0 60px #00FF7F40'
            ;(e.target as HTMLAnchorElement).style.transform = 'scale(1.02)'
          }}
          onMouseLeave={(e) => {
            ;(e.target as HTMLAnchorElement).style.boxShadow = '0 0 20px #00FF7F60'
            ;(e.target as HTMLAnchorElement).style.transform = 'scale(1)'
          }}
        >
          🎉 Klaim Diskon Sekarang!
        </a>

        <button onClick={onClose} className="mt-4 text-sm text-gray-500 hover:text-gray-400">
          Tidak, terima kasih
        </button>
      </div>
    </div>
  )
}

// ─── Header ───────────────────────────────────────────────────────────────────

function Header() {
  const [menuOpen, setMenuOpen] = useState(false)
  const [scrolled, setScrolled] = useState(false)

  useEffect(() => {
    const handler = () => setScrolled(window.scrollY > 50)
    window.addEventListener('scroll', handler)
    return () => window.removeEventListener('scroll', handler)
  }, [])

  const navLinks = [
    { label: 'Home', href: '#home' },
    { label: 'Kategori', href: '#kategori' },
    { label: 'Promo', href: '#produk' },
    { label: 'Kontak', href: '#kontak' },
  ]

  return (
    <header
      className="fixed top-0 left-0 right-0 z-40 transition-all duration-300"
      style={{
        background: scrolled ? 'rgba(10,10,10,0.95)' : 'rgba(10,10,10,0.7)',
        backdropFilter: 'blur(12px)',
        borderBottom: '1px solid #00D4FF20',
        boxShadow: scrolled ? '0 2px 20px #00D4FF20' : 'none',
      }}
    >
      <div className="max-w-7xl mx-auto px-4 py-3 flex items-center justify-between">
        {/* Logo */}
        <a href="#home" className="flex items-center gap-3">
          <div className="relative w-10 h-10 flex items-center justify-center">
            <div
              className="text-2xl headlamp-glow"
              role="img"
              aria-label="LED headlamp icon"
            >
              💡
            </div>
          </div>
          <div>
            <span
              className="text-lg font-black"
              style={{
                fontFamily: 'Orbitron',
                color: '#00D4FF',
                textShadow: '0 0 10px #00D4FF60',
                letterSpacing: '1px',
              }}
            >
              FAIZAL MOTOR
            </span>
            <span
              className="block text-xs font-semibold"
              style={{ color: '#FFD700', textShadow: '0 0 8px #FFD70060', letterSpacing: '3px' }}
            >
              139
            </span>
          </div>
        </a>

        {/* Desktop Nav */}
        <nav className="hidden md:flex items-center gap-8">
          {navLinks.map((link) => (
            <a
              key={link.label}
              href={link.href}
              className="text-sm font-medium transition-all duration-200"
              style={{ color: '#ccc', letterSpacing: '0.5px' }}
              onMouseEnter={(e) => {
                ;(e.target as HTMLAnchorElement).style.color = '#00D4FF'
                ;(e.target as HTMLAnchorElement).style.textShadow = '0 0 8px #00D4FF80'
              }}
              onMouseLeave={(e) => {
                ;(e.target as HTMLAnchorElement).style.color = '#ccc'
                ;(e.target as HTMLAnchorElement).style.textShadow = 'none'
              }}
            >
              {link.label}
            </a>
          ))}
        </nav>

        {/* CTA Button */}
        <a
          href={waLink(DEFAULT_WA_MSG)}
          target="_blank"
          rel="noopener noreferrer"
          className="hidden md:flex items-center gap-2 px-5 py-2 rounded-full font-bold text-sm transition-all duration-300"
          style={{
            background: 'linear-gradient(135deg, #00FF7F, #00D4FF)',
            color: '#000',
            boxShadow: '0 0 15px #00FF7F60',
            fontFamily: 'Montserrat',
          }}
          onMouseEnter={(e) => {
            ;(e.currentTarget as HTMLAnchorElement).style.boxShadow =
              '0 0 25px #00FF7F80, 0 0 50px #00FF7F40'
            ;(e.currentTarget as HTMLAnchorElement).style.transform = 'scale(1.05)'
          }}
          onMouseLeave={(e) => {
            ;(e.currentTarget as HTMLAnchorElement).style.boxShadow = '0 0 15px #00FF7F60'
            ;(e.currentTarget as HTMLAnchorElement).style.transform = 'scale(1)'
          }}
        >
          <span>📱</span> Order WA
        </a>

        {/* Mobile menu button */}
        <button
          className="md:hidden text-white text-2xl"
          onClick={() => setMenuOpen(!menuOpen)}
          aria-label="Toggle menu"
        >
          {menuOpen ? '✕' : '☰'}
        </button>
      </div>

      {/* Mobile menu */}
      {menuOpen && (
        <div
          className="md:hidden px-4 pb-4"
          style={{ background: 'rgba(10,10,10,0.98)', borderTop: '1px solid #00D4FF20' }}
        >
          {navLinks.map((link) => (
            <a
              key={link.label}
              href={link.href}
              className="block py-3 text-sm font-medium border-b"
              style={{ color: '#ccc', borderColor: '#ffffff10' }}
              onClick={() => setMenuOpen(false)}
            >
              {link.label}
            </a>
          ))}
          <a
            href={waLink(DEFAULT_WA_MSG)}
            target="_blank"
            rel="noopener noreferrer"
            className="flex items-center justify-center gap-2 mt-4 py-3 rounded-xl font-bold text-sm"
            style={{
              background: 'linear-gradient(135deg, #00FF7F, #00D4FF)',
              color: '#000',
            }}
            onClick={() => setMenuOpen(false)}
          >
            📱 Order via WhatsApp
          </a>
        </div>
      )}
    </header>
  )
}

// ─── Hero Section ─────────────────────────────────────────────────────────────

function HeroSection() {
  return (
    <section
      id="home"
      className="relative min-h-screen flex items-center justify-center overflow-hidden"
      style={{
        background: 'linear-gradient(180deg, #000 0%, #0a0a0a 50%, #050510 100%)',
        paddingTop: '80px',
      }}
    >
      {/* Grid background */}
      <div
        className="absolute inset-0 opacity-10"
        style={{
          backgroundImage:
            'linear-gradient(#00D4FF22 1px, transparent 1px), linear-gradient(90deg, #00D4FF22 1px, transparent 1px)',
          backgroundSize: '50px 50px',
        }}
      />

      <div className="relative z-10 max-w-6xl mx-auto px-4 py-20 text-center">
        {/* Headlamp visual */}
        <div className="relative inline-block mb-10 float-animation">
          <div
            className="w-48 h-48 md:w-64 md:h-64 mx-auto rounded-full flex items-center justify-center"
            style={{
              background: 'radial-gradient(circle, #00D4FF20 0%, #00D4FF05 60%, transparent 80%)',
              boxShadow: '0 0 60px #00D4FF40, 0 0 120px #00D4FF20, 0 0 200px #00D4FF10',
            }}
          >
            <div className="text-8xl md:text-9xl headlamp-glow" role="img" aria-label="Headlamp">
              💡
            </div>
          </div>
          {/* Rays */}
          {[0, 45, 90, 135, 180, 225, 270, 315].map((deg) => (
            <div
              key={deg}
              className="absolute top-1/2 left-1/2 w-1 opacity-30"
              style={{
                height: '120px',
                background: 'linear-gradient(to top, transparent, #00D4FF)',
                transformOrigin: 'bottom center',
                transform: `translateX(-50%) translateY(-100%) rotate(${deg}deg)`,
              }}
            />
          ))}
        </div>

        {/* Badge */}
        <div className="inline-flex items-center gap-2 px-4 py-2 rounded-full mb-6 text-xs font-semibold"
          style={{
            border: '1px solid #FFD70060',
            background: '#FFD70010',
            color: '#FFD700',
            textShadow: '0 0 8px #FFD70080',
            letterSpacing: '2px',
          }}
        >
          ⚡ READY STOCK • CUSTOM ORDER • INSTALL GRATIS ⚡
        </div>

        <h1
          className="text-3xl md:text-5xl lg:text-6xl font-black mb-6 leading-tight"
          style={{ fontFamily: 'Orbitron', letterSpacing: '-1px' }}
        >
          <span style={{ color: '#fff' }}>HEADLAMP CUSTOM LED</span>
          <br />
          <span
            style={{
              color: '#00D4FF',
              textShadow: '0 0 20px #00D4FF, 0 0 40px #00D4FF60',
            }}
          >
            NMAX/XMAX/AEROX
          </span>
          <br />
          <span
            style={{
              color: '#FFD700',
              textShadow: '0 0 20px #FFD700, 0 0 40px #FFD70060',
            }}
          >
            Terang 10x Lipat!
          </span>
        </h1>

        <p className="text-lg md:text-xl text-gray-300 mb-10 max-w-2xl mx-auto">
          Upgrade tampilan motormu dengan headlamp LED custom premium. Garansi 1 tahun,
          COD Jabodetabek, install gratis!
        </p>

        <div className="flex flex-col sm:flex-row gap-4 justify-center items-center">
          <a
            href={waLink(
              'Halo Faizal, saya mau order headlamp custom untuk motor saya [NMAX/XMAX/Aerox]. Bisa bantu?'
            )}
            target="_blank"
            rel="noopener noreferrer"
            className="group flex items-center gap-3 px-8 py-4 rounded-2xl font-bold text-lg transition-all duration-300"
            style={{
              background: 'linear-gradient(135deg, #00FF7F, #00D4FF)',
              color: '#000',
              boxShadow: '0 0 25px #00FF7F60, 0 0 50px #00FF7F30',
              fontFamily: 'Montserrat',
            }}
            onMouseEnter={(e) => {
              e.currentTarget.style.boxShadow = '0 0 40px #00FF7F80, 0 0 80px #00FF7F40'
              e.currentTarget.style.transform = 'scale(1.05) translateY(-2px)'
            }}
            onMouseLeave={(e) => {
              e.currentTarget.style.boxShadow = '0 0 25px #00FF7F60, 0 0 50px #00FF7F30'
              e.currentTarget.style.transform = 'scale(1) translateY(0)'
            }}
          >
            <span className="text-xl">💬</span>
            Chat Order Sekarang!
          </a>

          <a
            href="#produk"
            className="flex items-center gap-2 px-8 py-4 rounded-2xl font-bold text-base transition-all duration-300"
            style={{
              border: '2px solid #00D4FF',
              color: '#00D4FF',
              background: 'transparent',
              boxShadow: '0 0 15px #00D4FF30',
            }}
            onMouseEnter={(e) => {
              e.currentTarget.style.background = '#00D4FF15'
              e.currentTarget.style.boxShadow = '0 0 25px #00D4FF60'
            }}
            onMouseLeave={(e) => {
              e.currentTarget.style.background = 'transparent'
              e.currentTarget.style.boxShadow = '0 0 15px #00D4FF30'
            }}
          >
            🔍 Lihat Produk
          </a>
        </div>

        {/* Quick stats */}
        <div className="flex flex-wrap justify-center gap-6 mt-16">
          {[
            { val: '2847+', label: 'Pelanggan' },
            { val: '5000+', label: 'Produk Terjual' },
            { val: '1 Tahun', label: 'Garansi' },
            { val: '4.9⭐', label: 'Rating' },
          ].map((s) => (
            <div
              key={s.label}
              className="text-center px-4"
              style={{ borderRight: '1px solid #ffffff15' }}
            >
              <div
                className="text-2xl font-black"
                style={{ fontFamily: 'Orbitron', color: '#00D4FF' }}
              >
                {s.val}
              </div>
              <div className="text-xs text-gray-400 mt-1">{s.label}</div>
            </div>
          ))}
        </div>
      </div>
    </section>
  )
}

// ─── Stats Counter Section ────────────────────────────────────────────────────

function StatCard({ stat }: { stat: typeof stats[0] }) {
  const { count, ref } = useCountUp(stat.target, 2000, stat.isFloat)
  return (
    <div
      ref={ref}
      className="text-center p-6 rounded-2xl neon-border-animate"
      style={{
        background: '#141414',
        border: '1px solid #00D4FF30',
      }}
    >
      <div
        className="text-4xl font-black mb-2"
        style={{ fontFamily: 'Orbitron', color: '#00D4FF', textShadow: '0 0 15px #00D4FF60' }}
      >
        {count}
        {stat.suffix}
      </div>
      <div className="text-gray-400 text-sm font-medium">{stat.label}</div>
    </div>
  )
}

// ─── Category Section ─────────────────────────────────────────────────────────

function CategorySection() {
  return (
    <section id="kategori" className="relative z-10 py-20 px-4">
      <div className="max-w-6xl mx-auto">
        <div className="text-center mb-14">
          <p className="text-xs font-semibold tracking-widest mb-3" style={{ color: '#00D4FF' }}>
            PILIH TIPE MOTORMU
          </p>
          <h2
            className="text-3xl md:text-4xl font-black"
            style={{ fontFamily: 'Orbitron', color: '#fff' }}
          >
            KATEGORI{' '}
            <span style={{ color: '#FFD700', textShadow: '0 0 15px #FFD70060' }}>PRODUK</span>
          </h2>
        </div>

        <div className="grid grid-cols-2 md:grid-cols-4 gap-4">
          {categories.map((cat) => (
            <a
              key={cat.id}
              href={waLink(cat.msg)}
              target="_blank"
              rel="noopener noreferrer"
              className="group relative overflow-hidden rounded-2xl p-5 text-center transition-all duration-300 flex flex-col items-center"
              style={{
                background: '#141414',
                border: `1px solid ${cat.color}30`,
              }}
              onMouseEnter={(e) => {
                e.currentTarget.style.border = `1px solid ${cat.color}`
                e.currentTarget.style.boxShadow = `0 0 20px ${cat.color}40`
                e.currentTarget.style.transform = 'translateY(-4px)'
              }}
              onMouseLeave={(e) => {
                e.currentTarget.style.border = `1px solid ${cat.color}30`
                e.currentTarget.style.boxShadow = 'none'
                e.currentTarget.style.transform = 'translateY(0)'
              }}
            >
              <div
                className="w-16 h-16 rounded-full flex items-center justify-center text-3xl mb-4"
                style={{ background: `${cat.color}15`, boxShadow: `0 0 15px ${cat.color}30` }}
              >
                {cat.icon}
              </div>
              <div
                className="text-sm font-black mb-1"
                style={{ fontFamily: 'Orbitron', color: cat.color }}
              >
                {cat.name}
              </div>
              <div className="text-xs text-gray-400 mb-3 min-h-[32px] flex items-center">{cat.type}</div>
              <div
                className="text-sm font-bold px-3 py-1 rounded-full"
                style={{
                  background: `${cat.color}15`,
                  color: cat.color,
                  border: `1px solid ${cat.color}40`,
                }}
              >
                {cat.price}
              </div>
              <div
                className="mt-3 text-xs font-semibold opacity-0 group-hover:opacity-100 transition-opacity"
                style={{ color: cat.color }}
              >
                Chat WA →
              </div>
            </a>
          ))}
        </div>
      </div>
    </section>
  )
}

// ─── Products Carousel ────────────────────────────────────────────────────────

function ProductsSection() {
  const scrollRef = useRef<HTMLDivElement>(null)

  const scroll = (dir: 'left' | 'right') => {
    if (scrollRef.current) {
      scrollRef.current.scrollBy({ left: dir === 'left' ? -300 : 300, behavior: 'smooth' })
    }
  }

  return (
    <section id="produk" className="relative z-10 py-20 px-4">
      <div className="max-w-7xl mx-auto">
        <div className="text-center mb-14">
          <p className="text-xs font-semibold tracking-widest mb-3" style={{ color: '#FFD700' }}>
            PRODUK UNGGULAN
          </p>
          <h2
            className="text-3xl md:text-4xl font-black"
            style={{ fontFamily: 'Orbitron', color: '#fff' }}
          >
            BEST{' '}
            <span style={{ color: '#00D4FF', textShadow: '0 0 15px #00D4FF60' }}>SELLERS</span>
          </h2>
        </div>

        <div className="relative">
          <button
            onClick={() => scroll('left')}
            className="absolute left-0 top-1/2 -translate-y-1/2 -translate-x-4 z-10 w-10 h-10 rounded-full flex items-center justify-center hidden md:flex"
            style={{
              background: '#141414',
              border: '1px solid #00D4FF60',
              color: '#00D4FF',
              boxShadow: '0 0 15px #00D4FF30',
            }}
          >
            ‹
          </button>

          <div
            ref={scrollRef}
            className="carousel-container flex gap-4 overflow-x-auto pb-4"
            style={{ scrollSnapType: 'x mandatory' }}
          >
            {products.map((p) => (
              <div
                key={p.id}
                className="product-card flex-shrink-0 rounded-2xl overflow-hidden"
                style={{
                  width: '260px',
                  background: '#141414',
                  border: '1px solid #ffffff10',
                  scrollSnapAlign: 'start',
                }}
                onMouseEnter={(e) => {
                  e.currentTarget.style.border = '1px solid #00D4FF40'
                  e.currentTarget.style.boxShadow = '0 0 20px #00D4FF20'
                }}
                onMouseLeave={(e) => {
                  e.currentTarget.style.border = '1px solid #ffffff10'
                  e.currentTarget.style.boxShadow = 'none'
                }}
              >
                <div className="relative overflow-hidden h-48">
                  <img
                    src={p.img}
                    alt={p.name}
                    className="product-img w-full h-full object-cover"
                    loading="lazy"
                  />
                  <div
                    className="absolute top-3 left-3 px-2 py-1 rounded text-xs font-black"
                    style={{
                      background: p.badgeColor,
                      color: '#000',
                      fontFamily: 'Orbitron',
                    }}
                  >
                    {p.badge}
                  </div>
                </div>

                <div className="p-4">
                  <h3 className="font-bold text-sm mb-2" style={{ fontFamily: 'Orbitron', color: '#fff' }}>
                    {p.name}
                  </h3>

                  <div className="flex flex-wrap gap-1 mb-3">
                    {p.specs.map((spec) => (
                      <span
                        key={spec}
                        className="text-xs px-2 py-0.5 rounded"
                        style={{
                          background: '#00D4FF10',
                          color: '#00D4FF',
                          border: '1px solid #00D4FF30',
                        }}
                      >
                        {spec}
                      </span>
                    ))}
                  </div>

                  <div className="flex items-center justify-between">
                    <div
                      className="text-lg font-black"
                      style={{
                        fontFamily: 'Orbitron',
                        color: '#FFD700',
                        textShadow: '0 0 10px #FFD70060',
                      }}
                    >
                      {p.price}
                    </div>
                  </div>

                  <a
                    href={waLink(
                      `Halo Faizal! Saya mau pesan *${p.name}* ${p.price}. Stok masih ada? Tolong info lebih lanjut!`
                    )}
                    target="_blank"
                    rel="noopener noreferrer"
                    className="mt-3 block text-center py-2.5 rounded-xl text-sm font-bold transition-all duration-300"
                    style={{
                      background: 'linear-gradient(135deg, #00D4FF, #0090aa)',
                      color: '#000',
                      boxShadow: '0 0 12px #00D4FF40',
                    }}
                    onMouseEnter={(e) => {
                      e.currentTarget.style.boxShadow = '0 0 20px #00D4FF70'
                      e.currentTarget.style.transform = 'scale(1.02)'
                    }}
                    onMouseLeave={(e) => {
                      e.currentTarget.style.boxShadow = '0 0 12px #00D4FF40'
                      e.currentTarget.style.transform = 'scale(1)'
                    }}
                  >
                    💬 Order Sekarang
                  </a>
                </div>
              </div>
            ))}
          </div>

          <button
            onClick={() => scroll('right')}
            className="absolute right-0 top-1/2 -translate-y-1/2 translate-x-4 z-10 w-10 h-10 rounded-full flex items-center justify-center hidden md:flex"
            style={{
              background: '#141414',
              border: '1px solid #00D4FF60',
              color: '#00D4FF',
              boxShadow: '0 0 15px #00D4FF30',
            }}
          >
            ›
          </button>
        </div>
      </div>
    </section>
  )
}

// ─── Features Section ─────────────────────────────────────────────────────────

function FeaturesSection() {
  return (
    <section className="relative z-10 py-20 px-4">
      <div
        className="absolute inset-0"
        style={{
          background: 'linear-gradient(180deg, transparent, #050510 20%, #050510 80%, transparent)',
        }}
      />
      <div className="relative max-w-6xl mx-auto">
        <div className="text-center mb-14">
          <p className="text-xs font-semibold tracking-widest mb-3" style={{ color: '#00FF7F' }}>
            MENGAPA PILIH KAMI
          </p>
          <h2
            className="text-3xl md:text-4xl font-black"
            style={{ fontFamily: 'Orbitron', color: '#fff' }}
          >
            KEUNGGULAN{' '}
            <span style={{ color: '#00FF7F', textShadow: '0 0 15px #00FF7F60' }}>KAMI</span>
          </h2>
        </div>

        <div className="grid grid-cols-2 md:grid-cols-4 gap-6">
          {features.map((f) => (
            <div
              key={f.title}
              className="p-6 rounded-2xl text-center transition-all duration-300"
              style={{
                background: '#141414',
                border: `1px solid ${f.color}20`,
              }}
              onMouseEnter={(e) => {
                e.currentTarget.style.border = `1px solid ${f.color}60`
                e.currentTarget.style.boxShadow = `0 0 20px ${f.color}20`
                e.currentTarget.style.transform = 'translateY(-4px)'
              }}
              onMouseLeave={(e) => {
                e.currentTarget.style.border = `1px solid ${f.color}20`
                e.currentTarget.style.boxShadow = 'none'
                e.currentTarget.style.transform = 'translateY(0)'
              }}
            >
              <div
                className="text-4xl mb-4"
                style={{ filter: `drop-shadow(0 0 8px ${f.color}80)` }}
              >
                {f.icon}
              </div>
              <div
                className="font-black text-sm mb-1"
                style={{ fontFamily: 'Orbitron', color: f.color }}
              >
                {f.title}
              </div>
              <div className="text-xs text-gray-400">{f.desc}</div>
            </div>
          ))}
        </div>
      </div>
    </section>
  )
}

// ─── Stats Section ────────────────────────────────────────────────────────────

function StatsSection() {
  return (
    <section className="relative z-10 py-16 px-4">
      <div className="max-w-4xl mx-auto grid grid-cols-2 md:grid-cols-4 gap-4">
        {stats.map((s) => (
          <StatCard key={s.label} stat={s} />
        ))}
      </div>
    </section>
  )
}

// ─── Gallery Section ──────────────────────────────────────────────────────────

function GallerySection() {
  return (
    <section id="gallery" className="relative z-10 py-20 px-4">
      <div className="max-w-6xl mx-auto">
        <div className="text-center mb-14">
          <p className="text-xs font-semibold tracking-widest mb-3" style={{ color: '#FFD700' }}>
            HASIL PASANG
          </p>
          <h2
            className="text-3xl md:text-4xl font-black"
            style={{ fontFamily: 'Orbitron', color: '#fff' }}
          >
            BEFORE &{' '}
            <span style={{ color: '#FFD700', textShadow: '0 0 15px #FFD70060' }}>AFTER</span>
          </h2>
        </div>

        <div className="grid grid-cols-1 md:grid-cols-3 gap-6">
          {galleryItems.map((item, i) => (
            <div
              key={i}
              className="rounded-2xl overflow-hidden"
              style={{ background: '#141414', border: '1px solid #ffffff10' }}
            >
              <div className="relative">
                <div className="grid grid-cols-2">
                  <div className="relative">
                    <img
                      src={item.before}
                      alt={`Before - ${item.motor}`}
                      className="w-full h-40 object-cover"
                      loading="lazy"
                    />
                    <div
                      className="absolute top-2 left-2 text-xs font-bold px-2 py-1 rounded"
                      style={{ background: '#ff4444', color: '#fff' }}
                    >
                      BEFORE
                    </div>
                  </div>
                  <div className="relative">
                    <img
                      src={item.after}
                      alt={`After - ${item.motor}`}
                      className="w-full h-40 object-cover"
                      loading="lazy"
                    />
                    <div
                      className="absolute top-2 left-2 text-xs font-bold px-2 py-1 rounded"
                      style={{ background: '#00FF7F', color: '#000' }}
                    >
                      AFTER
                    </div>
                  </div>
                </div>
              </div>
              <div className="p-4 flex items-center justify-between">
                <span
                  className="text-sm font-bold"
                  style={{ fontFamily: 'Orbitron', color: '#00D4FF' }}
                >
                  {item.motor}
                </span>
                <a
                  href={waLink(
                    `Halo Faizal, saya tertarik pasang headlamp custom untuk ${item.motor} seperti di foto. Bisa info harga?`
                  )}
                  target="_blank"
                  rel="noopener noreferrer"
                  className="text-xs px-3 py-1.5 rounded-full font-bold transition-all duration-200"
                  style={{
                    background: '#00D4FF15',
                    color: '#00D4FF',
                    border: '1px solid #00D4FF40',
                  }}
                >
                  Mau seperti ini!
                </a>
              </div>
            </div>
          ))}
        </div>
      </div>
    </section>
  )
}

// ─── Testimonials Section ─────────────────────────────────────────────────────

function TestimonialsSection() {
  return (
    <section className="relative z-10 py-20 px-4">
      <div
        className="absolute inset-0"
        style={{
          background: 'linear-gradient(180deg, transparent, #050510 15%, #050510 85%, transparent)',
        }}
      />
      <div className="relative max-w-6xl mx-auto">
        <div className="text-center mb-14">
          <p className="text-xs font-semibold tracking-widest mb-3" style={{ color: '#00D4FF' }}>
            APA KATA MEREKA
          </p>
          <h2
            className="text-3xl md:text-4xl font-black"
            style={{ fontFamily: 'Orbitron', color: '#fff' }}
          >
            TESTIMONI{' '}
            <span style={{ color: '#00D4FF', textShadow: '0 0 15px #00D4FF60' }}>PELANGGAN</span>
          </h2>
        </div>

        <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
          {testimonials.map((t, i) => (
            <div
              key={i}
              className="p-6 rounded-2xl transition-all duration-300"
              style={{
                background: '#141414',
                border: '1px solid #00D4FF20',
              }}
              onMouseEnter={(e) => {
                e.currentTarget.style.border = '1px solid #00D4FF60'
                e.currentTarget.style.boxShadow = '0 0 20px #00D4FF15'
              }}
              onMouseLeave={(e) => {
                e.currentTarget.style.border = '1px solid #00D4FF20'
                e.currentTarget.style.boxShadow = 'none'
              }}
            >
              <div className="flex gap-1 mb-3">
                {Array.from({ length: t.rating }).map((_, j) => (
                  <span key={j} style={{ color: '#FFD700', textShadow: '0 0 5px #FFD70080' }}>
                    ⭐
                  </span>
                ))}
              </div>
              <p className="text-gray-300 text-sm leading-relaxed mb-4 italic">"{t.text}"</p>
              <div className="flex items-center gap-3">
                <div
                  className="w-10 h-10 rounded-full flex items-center justify-center text-sm font-bold"
                  style={{
                    background: 'linear-gradient(135deg, #00D4FF, #0070aa)',
                    color: '#fff',
                    flexShrink: 0,
                  }}
                >
                  {t.avatar}
                </div>
                <div>
                  <div className="font-semibold text-sm text-white">{t.name}</div>
                  <div className="text-xs text-gray-500">
                    {t.city} • {t.motor}
                  </div>
                </div>
              </div>
            </div>
          ))}
        </div>
      </div>
    </section>
  )
}

// ─── Consultation Form ────────────────────────────────────────────────────────

function ConsultationForm() {
  const [form, setForm] = useState({ name: '', motor: '', kota: '', catatan: '' })

  const handleSubmit = (e: React.FormEvent) => {
    e.preventDefault()
    const msg = `Halo Faizal! Saya *${form.name}* dari *${form.kota}* mau konsultasi headlamp custom untuk motor *${form.motor}*.\n\nCatatan: ${form.catatan || '-'}\n\nMohon bantuannya ya!`
    window.open(waLink(msg), '_blank')
  }

  return (
    <section id="kontak" className="relative z-10 py-20 px-4">
      <div className="max-w-2xl mx-auto">
        <div className="text-center mb-12">
          <p className="text-xs font-semibold tracking-widest mb-3" style={{ color: '#00FF7F' }}>
            KONSULTASI GRATIS
          </p>
          <h2
            className="text-3xl md:text-4xl font-black"
            style={{ fontFamily: 'Orbitron', color: '#fff' }}
          >
            KONSULTASI{' '}
            <span style={{ color: '#00FF7F', textShadow: '0 0 15px #00FF7F60' }}>CUSTOM</span>
          </h2>
          <p className="text-gray-400 mt-3 text-sm">
            Tidak tahu harus pilih yang mana? Konsultasikan dulu dengan kami!
          </p>
        </div>

        <form
          onSubmit={handleSubmit}
          className="rounded-2xl p-8"
          style={{
            background: '#141414',
            border: '1px solid #00D4FF30',
            boxShadow: '0 0 30px #00D4FF10',
          }}
        >
          <div className="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
            <div>
              <label className="text-xs text-gray-400 mb-1.5 block font-medium">Nama Kamu *</label>
              <input
                required
                type="text"
                placeholder="Nama lengkap"
                value={form.name}
                onChange={(e) => setForm({ ...form, name: e.target.value })}
                className="w-full px-4 py-3 rounded-xl text-sm text-white placeholder-gray-600 outline-none transition-all duration-200"
                style={{
                  background: '#0a0a0a',
                  border: '1px solid #ffffff15',
                }}
                onFocus={(e) => (e.target.style.border = '1px solid #00D4FF60')}
                onBlur={(e) => (e.target.style.border = '1px solid #ffffff15')}
              />
            </div>
            <div>
              <label className="text-xs text-gray-400 mb-1.5 block font-medium">Tipe Motor *</label>
              <select
                required
                value={form.motor}
                onChange={(e) => setForm({ ...form, motor: e.target.value })}
                className="w-full px-4 py-3 rounded-xl text-sm text-white outline-none transition-all duration-200"
                style={{
                  background: '#0a0a0a',
                  border: '1px solid #ffffff15',
                }}
                onFocus={(e) => (e.target.style.border = '1px solid #00D4FF60')}
                onBlur={(e) => (e.target.style.border = '1px solid #ffffff15')}
              >
                <option value="">Pilih motor kamu</option>
                <option>NMAX 155</option>
                <option>XMAX 250</option>
                <option>Aerox 155</option>
                <option>PCX 160</option>
                <option>ADV 150</option>
                <option>Lexi 125</option>
                <option>Lainnya</option>
              </select>
            </div>
          </div>

          <div className="mb-4">
            <label className="text-xs text-gray-400 mb-1.5 block font-medium">Kota / Domisili *</label>
            <input
              required
              type="text"
              placeholder="contoh: Jakarta Selatan"
              value={form.kota}
              onChange={(e) => setForm({ ...form, kota: e.target.value })}
              className="w-full px-4 py-3 rounded-xl text-sm text-white placeholder-gray-600 outline-none transition-all duration-200"
              style={{
                background: '#0a0a0a',
                border: '1px solid #ffffff15',
              }}
              onFocus={(e) => (e.target.style.border = '1px solid #00D4FF60')}
              onBlur={(e) => (e.target.style.border = '1px solid #ffffff15')}
            />
          </div>

          <div className="mb-6">
            <label className="text-xs text-gray-400 mb-1.5 block font-medium">
              Preferensi / Catatan
            </label>
            <textarea
              rows={3}
              placeholder="contoh: Mau yang warna biru, budget 500rb, dll"
              value={form.catatan}
              onChange={(e) => setForm({ ...form, catatan: e.target.value })}
              className="w-full px-4 py-3 rounded-xl text-sm text-white placeholder-gray-600 outline-none transition-all duration-200 resize-none"
              style={{
                background: '#0a0a0a',
                border: '1px solid #ffffff15',
              }}
              onFocus={(e) => (e.target.style.border = '1px solid #00D4FF60')}
              onBlur={(e) => (e.target.style.border = '1px solid #ffffff15')}
            />
          </div>

          <button
            type="submit"
            className="w-full py-4 rounded-xl font-bold text-base transition-all duration-300"
            style={{
              background: 'linear-gradient(135deg, #00FF7F, #00D4FF)',
              color: '#000',
              boxShadow: '0 0 20px #00FF7F50',
              fontFamily: 'Montserrat',
            }}
            onMouseEnter={(e) => {
              e.currentTarget.style.boxShadow = '0 0 35px #00FF7F80'
              e.currentTarget.style.transform = 'scale(1.02)'
            }}
            onMouseLeave={(e) => {
              e.currentTarget.style.boxShadow = '0 0 20px #00FF7F50'
              e.currentTarget.style.transform = 'scale(1)'
            }}
          >
            💬 Kirim ke WhatsApp Sekarang!
          </button>
        </form>
      </div>
    </section>
  )
}

// ─── CTA Section ──────────────────────────────────────────────────────────────

function CTASection() {
  return (
    <section className="relative z-10 py-24 px-4 text-center overflow-hidden">
      <div
        className="absolute inset-0"
        style={{
          background:
            'radial-gradient(ellipse at center, #00D4FF15 0%, #FFD70008 40%, transparent 70%)',
        }}
      />
      <div className="relative max-w-3xl mx-auto">
        <div className="text-5xl mb-6">🔥</div>
        <h2
          className="text-3xl md:text-5xl font-black mb-6"
          style={{
            fontFamily: 'Orbitron',
            background: 'linear-gradient(135deg, #FFD700, #00D4FF)',
            WebkitBackgroundClip: 'text',
            WebkitTextFillColor: 'transparent',
            backgroundClip: 'text',
          }}
        >
          Pesan Headlamp Custommu Sekarang!
        </h2>
        <p className="text-gray-300 text-lg mb-10">
          Jangan tunggu besok — stok terbatas, harga bisa naik kapan saja!
          <br />
          <strong className="text-white">
            Chat sekarang dan dapatkan konsultasi GRATIS!
          </strong>
        </p>

        <a
          href={waLink(
            'Halo Faizal! Saya mau order *HEADLAMP CUSTOM* untuk motor saya. Bisa bantu info produk, harga, dan proses pemasangan?'
          )}
          target="_blank"
          rel="noopener noreferrer"
          className="inline-flex items-center gap-3 px-10 py-5 rounded-2xl font-black text-xl transition-all duration-300"
          style={{
            background: 'linear-gradient(135deg, #00FF7F, #00D4FF)',
            color: '#000',
            boxShadow: '0 0 40px #00FF7F60, 0 0 80px #00FF7F30',
            fontFamily: 'Orbitron',
          }}
          onMouseEnter={(e) => {
            e.currentTarget.style.boxShadow = '0 0 60px #00FF7F80, 0 0 120px #00FF7F40'
            e.currentTarget.style.transform = 'scale(1.05) translateY(-3px)'
          }}
          onMouseLeave={(e) => {
            e.currentTarget.style.boxShadow = '0 0 40px #00FF7F60, 0 0 80px #00FF7F30'
            e.currentTarget.style.transform = 'scale(1) translateY(0)'
          }}
        >
          <span className="text-2xl">💬</span>
          ORDER VIA WHATSAPP
          <span className="text-2xl">🔥</span>
        </a>

        <p className="text-gray-500 text-sm mt-6">
          Respon cepat • Harga transparan • Garansi 1 tahun
        </p>
      </div>
    </section>
  )
}

// ─── Footer ───────────────────────────────────────────────────────────────────

function Footer() {
  return (
    <footer
      className="relative z-10 py-12 px-4"
      style={{ borderTop: '1px solid #00D4FF15', background: '#0a0a0a' }}
    >
      <div className="max-w-6xl mx-auto">
        <div className="grid grid-cols-1 md:grid-cols-3 gap-8 mb-8">
          {/* Brand */}
          <div>
            <div
              className="text-xl font-black mb-2"
              style={{ fontFamily: 'Orbitron', color: '#00D4FF', textShadow: '0 0 10px #00D4FF60' }}
            >
              💡 FAIZAL MOTOR 139
            </div>
            <p className="text-gray-500 text-sm leading-relaxed">
              Spesialis headlamp custom LED untuk motor Yamaha premium. Kualitas terbaik,
              harga terjangkau.
            </p>
          </div>

          {/* Contact */}
          <div>
            <h3 className="font-bold text-white mb-3 text-sm">Hubungi Kami</h3>
            <a
              href={`https://wa.me/${WA_NUMBER}`}
              target="_blank"
              rel="noopener noreferrer"
              className="flex items-center gap-2 text-sm mb-2 transition-colors"
              style={{ color: '#00FF7F' }}
              onMouseEnter={(e) =>
                ((e.currentTarget as HTMLAnchorElement).style.color = '#00FF7F')
              }
            >
              📱 WA: +62 812-2066-0964
            </a>
            <p className="text-gray-500 text-sm">
              📍 Jabodetabek & Online (Seluruh Indonesia)
            </p>
          </div>

          {/* Shipping */}
          <div>
            <h3 className="font-bold text-white mb-3 text-sm">Pengiriman</h3>
            <div className="flex flex-wrap gap-2">
              {['JNE', 'J&T Express', 'SiCepat', 'COD (Jabodetabek)'].map((s) => (
                <span
                  key={s}
                  className="text-xs px-3 py-1.5 rounded-full"
                  style={{
                    background: '#141414',
                    color: '#ccc',
                    border: '1px solid #ffffff15',
                  }}
                >
                  {s}
                </span>
              ))}
            </div>
          </div>
        </div>

        <div
          className="pt-6 text-center text-xs text-gray-600"
          style={{ borderTop: '1px solid #ffffff08' }}
        >
          Copyright © 2024 Faizal Motor 139. All rights reserved. | Headlamp Custom LED Terbaik
        </div>
      </div>
    </footer>
  )
}

// ─── Floating WA Button ───────────────────────────────────────────────────────

function FloatingWAButton() {
  const [pulse, setPulse] = useState(false)

  useEffect(() => {
    const interval = setInterval(() => {
      setPulse(true)
      setTimeout(() => setPulse(false), 600)
    }, 3000)
    return () => clearInterval(interval)
  }, [])

  return (
    <a
      href={waLink(DEFAULT_WA_MSG)}
      target="_blank"
      rel="noopener noreferrer"
      className="fixed bottom-6 right-6 z-50 flex items-center gap-2 px-4 py-3 rounded-full font-bold text-sm transition-all duration-300"
      style={{
        background: 'linear-gradient(135deg, #00FF7F, #00c96a)',
        color: '#000',
        boxShadow: pulse
          ? '0 0 40px #00FF7F80, 0 0 80px #00FF7F40'
          : '0 0 20px #00FF7F60',
        transform: pulse ? 'scale(1.05)' : 'scale(1)',
      }}
    >
      <span className="text-xl">💬</span>
      <span className="hidden sm:inline">Chat WA</span>
    </a>
  )
}

// ─── Main Page ────────────────────────────────────────────────────────────────

function FaizalMotor() {
  const [showPopup, setShowPopup] = useState(false)

  useEffect(() => {
    const timer = setTimeout(() => setShowPopup(true), 2000)
    return () => clearTimeout(timer)
  }, [])

  return (
    <div
      style={{
        minHeight: '100vh',
        background: '#0a0a0a',
        color: '#fff',
        fontFamily: 'Montserrat, sans-serif',
      }}
    >
      <ParticleCanvas />

      {showPopup && <PromoPopup onClose={() => setShowPopup(false)} />}

      <Header />
      <main>
        <HeroSection />

        {/* Divider */}
        <div
          className="relative z-10 h-px mx-8"
          style={{
            background:
              'linear-gradient(90deg, transparent, #00D4FF40, #FFD70040, transparent)',
          }}
        />

        <CategorySection />
        <StatsSection />
        <ProductsSection />
        <FeaturesSection />
        <GallerySection />
        <TestimonialsSection />
        <ConsultationForm />
        <CTASection />
      </main>

      <Footer />
      <FloatingWAButton />
    </div>
  )
}
