<?php
/**
 * Подвал темы
 * npx tailwindcss -i ./src/input.css -o ./dist/output.css --watch
 */
?>

<footer class="bg-gradient-to-r from-[#489669] to-[#2E4E3C] text-white py-4 mt-auto">
  <div class="my-[35px] w-full mx-auto px-6 lg:pl-[115px] lg:pr-[135px]">
  

    <div class="flex flex-row justify-between items-start gap-6 lg:gap-10">

      <!-- ЛОГОТИП -->
      <div class="flex-shrink-0 flex items-start">
        <a href="<?= esc_url(home_url()); ?>">
          <img src="<?= get_template_directory_uri(); ?>/assets/footer/logo-footer.svg" alt="Logo" class="h-15 lg:h-[70px] object-contain">
        </a>
      </div>

      <!-- МЕНЮ (только для десктопа) -->
      <div class="font-medium px-[30px] hidden lg:block">
        <div class="lg:grid grid-cols-2 md:grid-cols-4 gap-y-3 gap-x-12 text-sm flex-1">
          <?php
          if (function_exists('pll_current_language')) {
            $lang = strtoupper(pll_current_language());
            $locations = get_nav_menu_locations();
            $menu = wp_get_nav_menu_object($locations['primary']);
            $items = wp_get_nav_menu_items($menu->term_id);

            $chunks = array_chunk($items, ceil(count($items) / 4));
            foreach ($chunks as $chunk) {
              echo '<ul class="flex flex-col gap-2">';
              foreach ($chunk as $item) {
                echo '<li><a href="' . esc_url($item->url) . '" class="hover:underline">' . esc_html($item->title) . '</a></li>';
              }
              echo '</ul>';
            }
          }
          ?>
        </div>
        
        <!-- Политики -->
        <div class="flex gap-6 mt-6 text-sm">
          <a href="/privacy-policy" class="underline hover:text-gray-300">Политика конфиденциальности</a>
          <a href="/terms" class="underline hover:text-gray-300">Условия использования</a>
          <a href="/cookies" class="underline hover:text-gray-300">Политика cookies</a>
        </div>
      </div>


      <!-- СОЦСЕТИ -->
      <?php
        if (has_nav_menu('social_menu')) :
          $icons = [
            'facebook'  => 'facebook.svg',
            'youtube'   => 'youtube.svg',
            'instagram' => 'instagram.svg',
            'whatsapp'  => 'whatsapp.svg',
          ];
          $menu_items = wp_get_nav_menu_items(get_nav_menu_locations()['social_menu']);
      ?>
        <div class="flex gap-5 items-start">
          <?php foreach ($menu_items as $item):
            $slug = strtolower($item->title);
            if (isset($icons[$slug])): ?>
              <a href="<?= esc_url($item->url); ?>" target="_blank" rel="noopener noreferrer">
                <img src="<?= get_template_directory_uri(); ?>/assets/footer/<?= $icons[$slug]; ?>" alt="<?= esc_attr($slug); ?>" class="h-11 w-11">
              </a>
          <?php endif; endforeach; ?>
        </div>
      <?php endif; ?>

    </div>

  </div>
</footer>

<?php wp_footer(); ?>

<!-- Модальное окно с формой -->
<?php $trial_nonce = wp_create_nonce('mygym_trial_nonce'); ?>
<div id="trial-modal" class="fixed inset-0 z-[999] hidden flex items-center justify-center" aria-hidden="true">
  <!-- Затемнение фона -->
  <div class="absolute inset-0 bg-black/60 js-close-trial" data-close="trial-modal"></div>
  <!-- Модальное окно -->
  <div role="dialog" aria-modal="true" aria-labelledby="trial-title" class="relative mx-auto max-w-md w-[92%] bg-white rounded-2xl shadow-xl flex flex-col">
    <button type="button" class="absolute right-3 top-3 text-gray-500 hover:text-black js-close-trial" data-close="trial-modal" aria-label="Закрыть">×</button>
    <h3 id="trial-title" class="px-6 pt-6 pb-3 text-lg font-bold">
      <?= function_exists('pll__') ? pll__('Записаться на пробное занятие') : 'Записаться на пробное занятие'; ?>
    </h3>
    <form id="trial-form" class="px-6 pb-6 space-y-3">
      <input type="hidden" name="action" value="mygym_send_trial">
      <input type="hidden" name="nonce"  value="<?= esc_attr($trial_nonce); ?>">
      <!-- honeypot антиспам -->
      <input type="text" name="website" class="hidden" tabindex="-1" autocomplete="off"/>
      <input class="w-full rounded-full border border-[#C9D4F3] px-4 py-2" type="text" name="name" placeholder="<?= esc_attr(function_exists('pll__')? pll__('Имя и фамилия*') : 'Имя и фамилия*'); ?>" required>
      <input class="w-full rounded-full border border-[#C9D4F3] px-4 py-2" type="tel" name="phone" placeholder="<?= esc_attr(function_exists('pll__')? pll__('Телефон*') : 'Телефон*'); ?>" required>
      <input class="w-full rounded-full border border-[#C9D4F3] px-4 py-2" type="email" name="email" placeholder="Email*" required>
      <textarea class="w-full rounded-2xl border border-[#C9D4F3] px-4 py-2" name="message" rows="3" placeholder="<?= esc_attr(function_exists('pll__')? pll__('Сообщение') : 'Сообщение'); ?>"></textarea>
      <p class="text-xs text-gray-500">*<?= function_exists('pll__') ? pll__('Поля обязательные для заполнения') : 'Поля обязательные для заполнения'; ?></p>
      <button type="submit" class="w-full mt-1 rounded-full bg-[#39CB67] text-white font-medium py-2">
        <?= function_exists('pll__') ? pll__('Отправить') : 'Отправить'; ?>
      </button>
      <div id="trial-result" class="text-sm mt-3 hidden"></div>
    </form>
  </div>
</div>

</body>
</html>
