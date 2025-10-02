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
</body>
</html>
