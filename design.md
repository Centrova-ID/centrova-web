# Meta.com — Design System (Tailwind CSS Reference)

> A comprehensive, implementation-ready design specification distilled from Meta.com's public marketing site visual language. Built for direct translation into Tailwind CSS utility classes and `tailwind.config.js` tokens.

---

## 1. Design Philosophy

Meta.com follows a **"quiet confidence"** design language:

- **Minimal chrome, maximum content** — generous whitespace, few borders, content does the talking.
- **Large, confident typography** — oversized headlines (48–96px) paired with restrained body copy.
- **Soft gradients over flat color** — subtle blue → purple → indigo gradients used sparingly as accents (hero backgrounds, CTA highlights, icon glows), never as full-page backgrounds.
- **Dark-first, light-secondary** — primary marketing pages lean dark/near-black (`#050505`, `#0a0a0a`) with white text; some sub-pages use pure white (`#ffffff`) with near-black text (`#050505`).
- **Rounded, soft geometry** — large border radii (16–32px) on cards, buttons, and media containers. Nothing sharp.
- **Motion as a feature** — scroll-triggered fades/slides, hover scale, parallax on hero media. Subtle, never bouncy.
- **Product-first imagery** — large device mockups, 3D renders, and abstract gradient "blobs" as decorative backdrops behind UI screenshots.

---

## 2. Color System

### 2.1 Core Palette

| Token | Hex | Usage |
|---|---|---|
| `meta-black` | `#050505` | Primary dark background |
| `meta-black-soft` | `#0a0a0a` | Secondary dark background (cards, sections) |
| `meta-black-elevated` | `#141414` | Elevated surfaces on dark (modals, dropdowns) |
| `meta-white` | `#ffffff` | Primary light background / primary text on dark |
| `meta-off-white` | `#f5f5f7` | Light section background |
| `meta-gray-100` | `#e4e6eb` | Light borders, dividers on white |
| `meta-gray-400` | `#8a8d91` | Secondary/muted text |
| `meta-gray-600` | `#65676b` | Body text on light backgrounds |
| `meta-gray-800` | `#1c1e21` | Headings on light backgrounds |
| `meta-blue` | `#0866ff` | Primary brand blue (CTAs, links) |
| `meta-blue-light` | `#4f9eff` | Hover / accent blue |
| `meta-purple` | `#7b5cff` | Gradient accent |
| `meta-indigo` | `#4361ee` | Gradient accent |
| `meta-pink` | `#ff6bcb` | Rare gradient accent (Reality Labs / VR sections) |

### 2.2 Signature Gradients

```css
/* Hero gradient — cool blue to violet */
background: linear-gradient(135deg, #0866ff 0%, #4361ee 45%, #7b5cff 100%);

/* Soft ambient glow (used behind product renders) */
background: radial-gradient(circle at 50% 50%, rgba(123,92,255,0.35) 0%, rgba(5,5,5,0) 70%);

/* CTA button gradient (hover state) */
background: linear-gradient(90deg, #0866ff 0%, #4f9eff 100%);
```

### 2.3 Tailwind Config Extension

```js
// tailwind.config.js
module.exports = {
  theme: {
    extend: {
      colors: {
        'meta-black': '#050505',
        'meta-black-soft': '#0a0a0a',
        'meta-black-elevated': '#141414',
        'meta-off-white': '#f5f5f7',
        'meta-gray': {
          100: '#e4e6eb',
          400: '#8a8d91',
          600: '#65676b',
          800: '#1c1e21',
        },
        'meta-blue': {
          DEFAULT: '#0866ff',
          light: '#4f9eff',
        },
        'meta-purple': '#7b5cff',
        'meta-indigo': '#4361ee',
        'meta-pink': '#ff6bcb',
      },
      backgroundImage: {
        'meta-hero-gradient': 'linear-gradient(135deg, #0866ff 0%, #4361ee 45%, #7b5cff 100%)',
        'meta-glow': 'radial-gradient(circle at 50% 50%, rgba(123,92,255,0.35) 0%, rgba(5,5,5,0) 70%)',
        'meta-cta-hover': 'linear-gradient(90deg, #0866ff 0%, #4f9eff 100%)',
      },
      borderRadius: {
        'meta-sm': '12px',
        'meta-md': '20px',
        'meta-lg': '28px',
        'meta-xl': '40px',
        'meta-full': '999px',
      },
      fontFamily: {
        sans: ['Optimistic Text', 'Inter', 'Helvetica Neue', 'Arial', 'sans-serif'],
        display: ['Optimistic Display', 'Inter', 'Helvetica Neue', 'sans-serif'],
      },
      fontSize: {
        'meta-hero': ['clamp(2.75rem, 6vw, 6rem)', { lineHeight: '1.02', letterSpacing: '-0.03em', fontWeight: '600' }],
        'meta-h1': ['3.5rem', { lineHeight: '1.05', letterSpacing: '-0.02em', fontWeight: '600' }],
        'meta-h2': ['2.5rem', { lineHeight: '1.1', letterSpacing: '-0.02em', fontWeight: '600' }],
        'meta-h3': ['1.75rem', { lineHeight: '1.2', letterSpacing: '-0.01em', fontWeight: '600' }],
        'meta-body-lg': ['1.25rem', { lineHeight: '1.5', fontWeight: '400' }],
        'meta-body': ['1rem', { lineHeight: '1.6', fontWeight: '400' }],
        'meta-caption': ['0.875rem', { lineHeight: '1.4', fontWeight: '400' }],
      },
      boxShadow: {
        'meta-card': '0 8px 30px rgba(0,0,0,0.12)',
        'meta-card-dark': '0 8px 40px rgba(0,0,0,0.5)',
        'meta-glow-sm': '0 0 40px rgba(123,92,255,0.25)',
      },
      maxWidth: {
        'meta-container': '1200px',
      },
      transitionTimingFunction: {
        'meta-ease': 'cubic-bezier(0.22, 1, 0.36, 1)',
      },
    },
  },
};
```

---

## 3. Typography

Meta uses its proprietary typeface **"Optimistic"** (Display + Text weights). Fallback stack: `Inter, "Helvetica Neue", Arial, sans-serif`.

### 3.1 Type Scale

| Role | Size (desktop) | Size (mobile) | Weight | Tracking | Tailwind class |
|---|---|---|---|---|---|
| Hero headline | 96px | 44px | 600 (semibold) | -3% | `text-meta-hero font-display` |
| H1 | 56px | 36px | 600 | -2% | `text-meta-h1 font-display` |
| H2 | 40px | 28px | 600 | -2% | `text-meta-h2 font-display` |
| H3 | 28px | 22px | 600 | -1% | `text-meta-h3 font-display` |
| Body Large | 20px | 18px | 400 | 0 | `text-meta-body-lg` |
| Body | 16px | 15px | 400 | 0 | `text-meta-body` |
| Caption / Label | 14px | 13px | 400–500 | 0 | `text-meta-caption` |
| Button label | 16px | 16px | 600 | 0 | `text-base font-semibold` |

### 3.2 Typography Rules

- Headlines are always **tight line-height** (1.0–1.1) with **negative letter-spacing**.
- Body copy uses **1.5–1.6 line-height** for readability, max width constrained to `~65ch`.
- Never use pure black (`#000`) — always `#050505` or `#1c1e21` for softer contrast.
- Gradient text is used sparingly for hero words (e.g., "Metaverse", "AI"):

```html
<span class="bg-clip-text text-transparent bg-meta-hero-gradient">AI</span>
```

---

## 4. Spacing & Layout System

### 4.1 Base Grid

- **8px base unit** — all spacing is a multiple of 8 (Tailwind default scale maps well: `2, 4, 6, 8, 10, 12, 16, 20, 24, 32...`).
- **Container max-width:** `1200px` (`max-w-meta-container mx-auto px-6 md:px-10`).
- **Section vertical padding:** `py-24 md:py-32 lg:py-40` (very generous — Meta sections breathe a lot).
- **Grid gutters:** `gap-6 md:gap-8 lg:gap-10`.

### 4.2 Responsive Breakpoints (Tailwind defaults work directly)

| Breakpoint | Width | Notes |
|---|---|---|
| `sm` | 640px | Mobile landscape |
| `md` | 768px | Tablet |
| `lg` | 1024px | Small desktop — nav switches to full horizontal |
| `xl` | 1280px | Standard desktop |
| `2xl` | 1536px | Wide desktop — content stays capped at 1200px |

### 4.3 Common Section Anatomy

```html
<section class="bg-meta-black py-24 md:py-32">
  <div class="max-w-meta-container mx-auto px-6 md:px-10">
    <!-- eyebrow label -->
    <p class="text-meta-caption uppercase tracking-widest text-meta-blue-light mb-4">Product</p>
    <!-- headline -->
    <h2 class="text-meta-h1 font-display text-white max-w-3xl">
      Building the future of connection.
    </h2>
    <!-- body -->
    <p class="text-meta-body-lg text-meta-gray-400 max-w-2xl mt-6">
      Supporting copy goes here, constrained in width for readability.
    </p>
  </div>
</section>
```

---

## 5. Navigation Bar

**Structure:** Fixed/sticky, transparent-over-hero → solid on scroll, height ~72px.

```html
<header class="fixed top-0 inset-x-0 z-50 backdrop-blur-md bg-meta-black/70 border-b border-white/10">
  <nav class="max-w-meta-container mx-auto px-6 md:px-10 h-[72px] flex items-center justify-between">
    <!-- Logo -->
    <a href="/" class="flex items-center gap-2">
      <span class="text-white font-display text-xl font-semibold">Meta</span>
    </a>

    <!-- Center links -->
    <ul class="hidden lg:flex items-center gap-8 text-sm text-white/80">
      <li><a href="#" class="hover:text-white transition-colors duration-200">Technologies</a></li>
      <li><a href="#" class="hover:text-white transition-colors duration-200">Products</a></li>
      <li><a href="#" class="hover:text-white transition-colors duration-200">About</a></li>
      <li><a href="#" class="hover:text-white transition-colors duration-200">News</a></li>
    </ul>

    <!-- CTA -->
    <div class="flex items-center gap-3">
      <button class="hidden md:inline-flex px-5 py-2.5 rounded-meta-full text-sm font-semibold text-white border border-white/20 hover:bg-white/10 transition-colors duration-200">
        Sign In
      </button>
      <button class="px-5 py-2.5 rounded-meta-full text-sm font-semibold text-meta-black bg-white hover:bg-meta-gray-100 transition-colors duration-200">
        Get Started
      </button>
    </div>
  </nav>
</header>
```

**Notes:**
- Nav background: `bg-meta-black/70` + `backdrop-blur-md` — glassmorphism-lite.
- Bottom hairline border: `border-b border-white/10`.
- Link hover: color shift only, no underline, `duration-200`.
- Mobile: hamburger → full-screen overlay menu, `bg-meta-black`, links stacked, large 32px text.

---

## 6. Hero Section

```html
<section class="relative min-h-screen flex items-center overflow-hidden bg-meta-black pt-[72px]">
  <!-- Ambient gradient glow backdrop -->
  <div class="absolute inset-0 bg-meta-glow opacity-80 pointer-events-none"></div>
  <div class="absolute -top-40 -right-40 w-[600px] h-[600px] bg-meta-hero-gradient rounded-full blur-[120px] opacity-30"></div>

  <div class="relative max-w-meta-container mx-auto px-6 md:px-10 grid lg:grid-cols-2 gap-12 items-center">
    <!-- Text column -->
    <div>
      <h1 class="text-meta-hero font-display text-white">
        Connect,
        <span class="bg-clip-text text-transparent bg-meta-hero-gradient">create</span>,
        and build together.
      </h1>
      <p class="text-meta-body-lg text-meta-gray-400 mt-6 max-w-lg">
        Discover the technologies shaping how people connect, communicate, and build community.
      </p>
      <div class="flex flex-wrap gap-4 mt-10">
        <button class="px-7 py-3.5 rounded-meta-full bg-white text-meta-black font-semibold text-base hover:scale-[1.03] transition-transform duration-300 ease-meta-ease">
          Explore Now
        </button>
        <button class="px-7 py-3.5 rounded-meta-full border border-white/25 text-white font-semibold text-base hover:bg-white/10 transition-colors duration-300">
          Watch Video
        </button>
      </div>
    </div>

    <!-- Media column -->
    <div class="relative">
      <div class="rounded-meta-xl overflow-hidden shadow-meta-card-dark">
        <img src="/hero-render.jpg" alt="" class="w-full h-full object-cover" />
      </div>
    </div>
  </div>
</section>
```

**Hero rules:**
- Full viewport height (`min-h-screen`) on landing pages, ~70vh on sub-pages.
- Background: near-black with soft radial gradient glow (purple/blue), blurred blob shapes positioned off-canvas edges.
- Headline uses mixed styling: plain white text + one gradient-text keyword.
- Primary CTA = solid white pill button; secondary CTA = outlined ghost pill button.
- Hero media: large rounded-corner image/video/3D render, subtle drop shadow, sometimes floating with parallax on scroll.

---

## 7. Buttons

### 7.1 Variants

| Variant | Classes |
|---|---|
| Primary (light bg context) | `px-6 py-3 rounded-meta-full bg-meta-black text-white font-semibold hover:bg-meta-gray-800 transition-colors duration-200` |
| Primary (dark bg context) | `px-6 py-3 rounded-meta-full bg-white text-meta-black font-semibold hover:bg-meta-gray-100 transition-colors duration-200` |
| Secondary / Outline | `px-6 py-3 rounded-meta-full border border-current/25 font-semibold hover:bg-white/10 transition-colors duration-200` |
| Gradient CTA | `px-6 py-3 rounded-meta-full text-white font-semibold bg-meta-hero-gradient hover:brightness-110 transition-all duration-300` |
| Text Link | `text-meta-blue font-semibold hover:underline underline-offset-4` |

### 7.2 Sizing

- **Large:** `px-8 py-4 text-lg`
- **Default:** `px-6 py-3 text-base`
- **Small:** `px-4 py-2 text-sm`

### 7.3 Interaction

- Hover: subtle scale (`hover:scale-[1.02]`) OR background lighten — never both aggressively.
- Transition: always `duration-200` to `duration-300`, `ease-meta-ease` for premium feel.
- Focus state: `focus-visible:ring-2 focus-visible:ring-meta-blue-light focus-visible:ring-offset-2 focus-visible:ring-offset-meta-black`.

---

## 8. Cards

### 8.1 Product/Feature Card (Dark)

```html
<div class="group rounded-meta-lg bg-meta-black-soft border border-white/10 p-8 hover:border-white/20 transition-colors duration-300">
  <div class="w-12 h-12 rounded-meta-sm bg-meta-hero-gradient flex items-center justify-center mb-6">
    <!-- icon -->
  </div>
  <h3 class="text-meta-h3 font-display text-white mb-3">Feature title</h3>
  <p class="text-meta-body text-meta-gray-400">
    Feature description text goes here, kept concise and scannable.
  </p>
</div>
```

### 8.2 Media Card (Image + Overlay Text) — used for product showcases

```html
<div class="relative rounded-meta-lg overflow-hidden group cursor-pointer">
  <img src="/card.jpg" class="w-full h-[420px] object-cover group-hover:scale-105 transition-transform duration-700 ease-meta-ease" />
  <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/10 to-transparent"></div>
  <div class="absolute bottom-0 left-0 p-8">
    <p class="text-meta-caption uppercase tracking-wide text-white/70 mb-2">Category</p>
    <h3 class="text-meta-h3 font-display text-white">Card headline</h3>
  </div>
</div>
```

### 8.3 Light-mode Card

```html
<div class="rounded-meta-lg bg-white shadow-meta-card border border-meta-gray-100 p-8 hover:shadow-lg transition-shadow duration-300">
  <h3 class="text-meta-h3 font-display text-meta-gray-800 mb-3">Title</h3>
  <p class="text-meta-body text-meta-gray-600">Description</p>
</div>
```

---

## 9. Grid Layouts

- **2-column feature grid:** `grid grid-cols-1 md:grid-cols-2 gap-8`
- **3-column card grid:** `grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8`
- **Asymmetric hero grid:** `grid grid-cols-1 lg:grid-cols-[1.1fr_0.9fr] gap-12 items-center`
- **Logo/partner strip:** `grid grid-cols-2 sm:grid-cols-3 md:grid-cols-6 gap-8 items-center opacity-60`

---

## 10. Iconography & Imagery

- **Icons:** Thin-to-medium stroke weight (1.5–2px), rounded line caps, monochrome (white on dark, `meta-gray-800` on light). Size typically `24px`–`48px`.
- **Icon containers:** Rounded square (`rounded-meta-sm`), gradient or solid fill background, icon centered, ~48×48px.
- **Photography style:** Diverse people, natural lighting, candid moments using devices; product renders on gradient/dark backdrops with soft studio lighting and subtle reflections.
- **3D renders:** Glass/metallic materials, soft ambient occlusion, floating on transparent or gradient backgrounds — no hard drop shadows, use glow instead (`shadow-meta-glow-sm`).
- **Illustration/blobs:** Organic blurred gradient shapes (`blur-[100px]` to `blur-[160px]`) used as ambient background decoration, `opacity-20` to `opacity-40`, absolutely positioned, `pointer-events-none`.

---

## 11. Motion & Animation

| Interaction | Behavior | Tailwind/CSS approach |
|---|---|---|
| Section entrance | Fade up 20–30px on scroll into view | `opacity-0 translate-y-6` → `opacity-100 translate-y-0`, `transition-all duration-700 ease-meta-ease` (via IntersectionObserver) |
| Card hover | Slight lift + border glow | `hover:-translate-y-1 hover:shadow-meta-glow-sm transition-all duration-300` |
| Image hover (media cards) | Zoom in | `group-hover:scale-105 transition-transform duration-700` |
| Button hover | Scale + brightness | `hover:scale-[1.02] hover:brightness-110 transition-all duration-200` |
| Nav on scroll | Background opacity increases | JS toggled class `bg-meta-black/70` → `bg-meta-black/95` |
| Hero parallax | Media moves slower than scroll | `translateY` bound to scroll position via JS, subtle (10–30px range) |
| Marquee/logo strip | Infinite horizontal scroll | CSS `@keyframes marquee` translating `-50%`, `animation: marquee 30s linear infinite` |

**Global easing:** `cubic-bezier(0.22, 1, 0.36, 1)` — a soft "ease-out-expo" feel used almost everywhere.

---

## 12. Forms & Inputs

```html
<div class="space-y-2">
  <label class="text-meta-caption font-medium text-white/80">Email address</label>
  <input
    type="email"
    class="w-full px-4 py-3.5 rounded-meta-sm bg-white/5 border border-white/15 text-white placeholder-white/40 focus:outline-none focus:border-meta-blue-light focus:ring-1 focus:ring-meta-blue-light transition-colors duration-200"
    placeholder="you@example.com"
  />
</div>
```

- Inputs: subtle translucent background on dark (`bg-white/5`), thin border, generous padding (`py-3.5`), rounded corners matching button scale.
- Focus state: border + ring in `meta-blue-light`, no harsh outline.
- Error state: `border-red-500 ring-red-500/40`.

---

## 13. Footer

```html
<footer class="bg-meta-black border-t border-white/10 pt-20 pb-10">
  <div class="max-w-meta-container mx-auto px-6 md:px-10">
    <div class="grid grid-cols-2 md:grid-cols-5 gap-8 mb-16">
      <div>
        <h4 class="text-meta-caption font-semibold text-white mb-4">Products</h4>
        <ul class="space-y-3 text-meta-caption text-meta-gray-400">
          <li><a href="#" class="hover:text-white transition-colors duration-200">Facebook</a></li>
          <li><a href="#" class="hover:text-white transition-colors duration-200">Instagram</a></li>
        </ul>
      </div>
      <!-- repeat columns: Technologies, About, Resources, Legal -->
    </div>
    <div class="flex flex-col md:flex-row items-center justify-between gap-4 pt-8 border-t border-white/10">
      <p class="text-meta-caption text-meta-gray-400">© 2026 Meta. All rights reserved.</p>
      <div class="flex gap-6 text-meta-caption text-meta-gray-400">
        <a href="#" class="hover:text-white">Privacy</a>
        <a href="#" class="hover:text-white">Terms</a>
        <a href="#" class="hover:text-white">Cookies</a>
      </div>
    </div>
  </div>
</footer>
```

---

## 14. Section Background Patterns

Meta.com alternates between three background modes down a page:

1. **Deep black** (`bg-meta-black`) — hero, primary statements.
2. **Soft black** (`bg-meta-black-soft`) — secondary content, feature grids.
3. **Off-white** (`bg-meta-off-white`) — occasionally used for contrast breaks or light-themed product sections (text flips to `meta-gray-800`).

Transitions between dark/light sections are usually **hard cuts** (no gradient blending) — confidence over subtlety at the macro level, subtlety reserved for micro-details (glows, shadows).

---

## 15. Accessibility Notes

- Minimum text contrast: white text on `#050505` = ~19:1 (AAA). Gray-400 (`#8a8d91`) on black ≈ 5.2:1 (AA for body text ≥16px).
- All interactive elements need visible `focus-visible` states (ring, not just color change).
- Gradient text must have a solid-color fallback for `prefers-contrast: more`.
- Respect `prefers-reduced-motion`: disable scroll-fade and parallax, keep only opacity crossfades.

```css
@media (prefers-reduced-motion: reduce) {
  * { animation-duration: 0.01ms !important; transition-duration: 0.01ms !important; }
}
```

---

## 16. Component Checklist (Quick Reference)

- [x] Sticky glassmorphic navbar with pill buttons
- [x] Full-viewport hero with gradient glow + gradient-text keyword
- [x] Rounded-full pill buttons (primary solid / secondary outline)
- [x] Dark feature cards with gradient icon chips
- [x] Media cards with image-zoom hover + bottom text overlay
- [x] Alternating dark/light/soft-dark section backgrounds
- [x] Large rounded corners everywhere (`meta-sm` to `meta-xl`)
- [x] Ambient blurred gradient blobs as decoration
- [x] Scroll-fade-up entrance animations
- [x] Footer with multi-column link grid + hairline divider

---

## 17. Example Page Skeleton

```html
<body class="bg-meta-black font-sans antialiased">
  <!-- Navbar (Section 5) -->
  <!-- Hero (Section 6) -->

  <section class="bg-meta-black-soft py-24 md:py-32">
    <div class="max-w-meta-container mx-auto px-6 md:px-10">
      <h2 class="text-meta-h2 font-display text-white max-w-2xl mb-16">
        Explore what's possible.
      </h2>
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        <!-- Feature cards x3 (Section 8.1) -->
      </div>
    </div>
  </section>

  <section class="bg-meta-off-white py-24 md:py-32">
    <div class="max-w-meta-container mx-auto px-6 md:px-10 text-center">
      <h2 class="text-meta-h1 font-display text-meta-gray-800 max-w-3xl mx-auto">
        Ready to get started?
      </h2>
      <button class="mt-10 px-8 py-4 rounded-meta-full bg-meta-black text-white font-semibold hover:bg-meta-gray-800 transition-colors duration-200">
        Sign Up Free
      </button>
    </div>
  </section>

  <!-- Footer (Section 13) -->
</body>
```

---

*This document is a design reference derived from publicly observable visual patterns on meta.com. Exact hex values, spacing, and font names are best-effort approximations for clone/reference purposes — always sample actual assets (DevTools) if pixel-perfect fidelity is required.*
