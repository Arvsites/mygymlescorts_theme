document.addEventListener('DOMContentLoaded', () => {
  const burger = document.getElementById('burger');
  const menuWrap = document.getElementById('menu-wrap');

  // Тоггл бургер-меню
  burger.addEventListener('click', () => {
    const isOpen = menuWrap.classList.contains('flex');

    if (isOpen) {
      menuWrap.classList.remove('flex', 'menu-open');
      menuWrap.classList.add('hidden');
      document.body.classList.remove('overflow-hidden');
      burger.classList.remove('burger-active');
    } else {
      menuWrap.classList.remove('hidden');
      menuWrap.classList.add('flex', 'menu-open');
      document.body.classList.add('overflow-hidden');
      burger.classList.add('burger-active');
    }
  });

  // Следим за ресайзом окна
  window.addEventListener('resize', () => {
    const isDesktop = window.innerWidth >= 768;

    if (isDesktop) {
      // Закрываем бургер-меню при переходе в десктоп
      if (menuWrap.classList.contains('flex')) {
        menuWrap.classList.remove('flex', 'menu-open');
        menuWrap.classList.add('hidden');
        document.body.classList.remove('overflow-hidden');
        burger.classList.remove('burger-active');
      }
    }
  });
});

// header shrink on scroll
(function () {
  const header = document.getElementById('site-header');
  if (!header) return;
  const onScroll = () => {
    const shrink = window.scrollY > 40; // порог
    header.classList.toggle('is-shrink', shrink);
  };
  window.addEventListener('scroll', onScroll, { passive: true });
  window.addEventListener('resize', onScroll);
  onScroll();
})();
