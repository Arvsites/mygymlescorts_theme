// JavaScript для модалки и AJAX-отправки
(function () {
    const modal   = document.getElementById('trial-modal');
    const bodyEl  = document.documentElement;
    const openers = document.querySelectorAll('[data-open="trial-modal"], .js-open-trial');
    function openModal(e) {
      if (e) e.preventDefault();
      if (!modal) return;
      modal.classList.remove('hidden');
      bodyEl.classList.add('overflow-hidden');
      const first = modal.querySelector('input[name="name"]');
      if (first) setTimeout(() => first.focus(), 50);
    }
    function closeModal(e) {
      if (e) e.preventDefault();
      if (!modal) return;
      modal.classList.add('hidden');
      bodyEl.classList.remove('overflow-hidden');
    }
    openers.forEach(b => b.addEventListener('click', openModal));
    if (modal) {
      modal.querySelectorAll('[data-close="trial-modal"], .js-close-trial').forEach(b => b.addEventListener('click', closeModal));
      // клик по фону
      modal.addEventListener('click', e => { if (e.target === modal) closeModal(); });
    }
    document.addEventListener('keydown', e => { if (e.key === 'Escape') closeModal(); });
  
    // Отправка формы
    const form   = document.getElementById('trial-form');
    const result = document.getElementById('trial-result');
    if (form) {
      form.addEventListener('submit', async (e) => {
        e.preventDefault();
        result.classList.remove('hidden', 'text-red-600', 'text-green-600');
        result.textContent = 'Отправка...';
        const fd = new FormData(form);
        if (!fd.get('action')) fd.set('action', 'mygym_send_trial');
        if (!fd.get('nonce') && typeof MyGymTrial !== 'undefined') fd.set('nonce', MyGymTrial.nonce);
        try {
          const res  = await fetch((typeof MyGymTrial !== 'undefined' ? MyGymTrial.ajax_url : '/wp-admin/admin-ajax.php'), {
            method: 'POST', credentials: 'same-origin', body: fd
          });
          const json = await res.json();
          if (json.success) {
            result.textContent = (typeof MyGymTrial !== 'undefined' ? MyGymTrial.okText : 'Спасибо! Мы свяжемся с вами в ближайшее время.');
            result.classList.add('text-green-600');
            form.reset();
          } else {
            result.textContent = (typeof MyGymTrial !== 'undefined' ? MyGymTrial.errText : 'Ошибка отправки. Попробуйте позже.');
            result.classList.add('text-red-600');
          }
        } catch (err) {
          result.textContent = 'Сеть недоступна. Попробуйте позже.';
          result.classList.add('text-red-600');
        }
      });
    }
  })();