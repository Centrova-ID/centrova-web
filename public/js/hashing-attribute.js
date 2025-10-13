(() => {
  // 🔹 String random panjang bervariasi
  const randomString = (min = 8, max = 24) => {
    const len = Math.floor(Math.random() * (max - min + 1)) + min;
    return Array.from({ length: len }, () =>
      Math.random().toString(36).charAt(2)
    ).join('');
  };

  // 🔹 Generator nama class absurd
  const randomWeirdClass = () => {
    const prefix = [
      'quantum', 'hyper', 'glitch', 'potato', 'ghost', 'entropy', 'vibe',
      'cheese', 'meta', 'plasma', 'banana', 'parallel', 'neural', 'dream',
      'flux', 'dimension', 'overdrive', 'matrix', 'cyber', 'nano', 'aurora'
    ];
    const suffix = [
      'mode', 'entity', 'reactor', 'field', 'unit', 'sequence', 'beam',
      'layer', 'core', 'node', 'state', 'portal', 'tunnel', 'phase', 'pulse',
      'fabric', 'loop', 'zone', 'sector', 'driver'
    ];
    return `${prefix[Math.floor(Math.random() * prefix.length)]}-${suffix[Math.floor(Math.random() * suffix.length)]}-${randomString(10, 20)}`;
  };

  // 🔹 Generator atribut absurd
  const randomWeirdAttr = () => {
    const keys = [
      'quantum-seed', 'vibe-intensity', 'potato-frequency', 'ghost-layer',
      'entropy-flux', 'meta-signature', 'parallel-id', 'banana-energy',
      'flux-stability', 'neural-noise', 'dream-phase', 'cyber-pulse',
      'nano-tension', 'aurora-burst', 'spectral-warp'
    ];
    return keys[Math.floor(Math.random() * keys.length)];
  };

  // 🔹 Tag vital yang gak boleh diacak
  const skipTags = [
    'HTML', 'HEAD', 'BODY', 'META', 'TITLE', 'LINK', 'STYLE', 'SCRIPT', 'NOSCRIPT', 'BASE'
  ];

  // 🔹 Loop semua elemen
  document.querySelectorAll('*').forEach((el, index) => {
    if (skipTags.includes(el.tagName)) return;

    // 1️⃣ Tambah class aneh
    const existingClasses = (el.getAttribute('class') || '').trim().split(/\s+/).filter(Boolean);
    const weirdClasses = [];
    const classCount = 10 + Math.floor(Math.random() * 10); // 10–19 class random jumlah
    for (let i = 0; i < classCount; i++) weirdClasses.push(randomWeirdClass());
    const mid = Math.floor(Math.random() * (weirdClasses.length + 1));
    const mixedClasses = [
      ...weirdClasses.slice(0, mid),
      ...existingClasses,
      ...weirdClasses.slice(mid)
    ];
    el.setAttribute('class', mixedClasses.join(' ').trim());

    // 2️⃣ Tambah atribut aneh
    const attrCount = 3 + Math.floor(Math.random() * 7); // 3–9 atribut acak
    const usedKeys = new Set();
    for (let i = 0; i < attrCount; i++) {
      let key;
      do { key = randomWeirdAttr(); } while (usedKeys.has(key));
      usedKeys.add(key);
      el.setAttribute(
        key,
        `exp-${randomString(8, 20)}-${Date.now().toString(36)}-${Math.floor(Math.random() * 999999)}`
      );
    }
  });
})();