<?php
/* Template Name: gallery */
get_header();
?>

<?php the_title(); ?>

<!-- Блок 1: Вступление -->
<section class="mt-10 w-full bg-[#FEED00] relative overflow-hidden">
  <div class="max-w-[1440px] mx-auto flex flex-col lgm:flex-row items-stretch">
    
    <!-- Правая картинка -->
    <div class="lgm:min-h-[300px] w-auto lgm:w-[60%] h-auto lgm:order-2 lgm:ml-auto bleed-right">
      <img src="<?= get_template_directory_uri(); ?>/assets/services/1-2.webp"
          alt="дети на занятии"
          class="hidden lgm:block w-full h-full object-cover" />
      <img src="<?= get_template_directory_uri(); ?>/assets/services/1-2m.webp"
          alt="дети на занятии"
          class="lgm:hidden w-full h-full object-cover" />
    </div>

    <!-- Левая текстовая часть -->
    <div class="w-full lgm:w-[60%] pl-10 lgm:pl-[115px] py-10 lgm:py-0 flex flex-col justify-center relative z-10">
      
      <!-- Кубики -->
      <img src="<?= get_template_directory_uri(); ?>/assets/programs/1-1.webp"
           alt="кубики"
           class="w-[180px] lgm:w-[190px] h-auto mb-4 lgm:absolute lgm:top-[20%]  lgm:mb-0 z-0" />
      

      <!-- Текст -->
      <div class="relative z-10 lgm:mt-[180px]">
        <h2 class="text-[#153F93] font-bold text-[36px] lgm:text-[45px] leading-tight mb-4">
        <?php the_field("заголовок_1"); ?>
        </h2>        
      </div>

    </div>
  </div>
</section>


<!-- Блок 2: Фотогалерея. Все мини-контейнеры всегда видны, картинки обрезаются -->
<section class="w-full bg-[#FFF8BC]">
  <!-- Фотогалерея 1 -->
  <div class="max-w-[1440px] mx-auto px-10 lgm:px-[70px] py-6">
    <?php
      // 5 картинок из ACF: i_gal_img_1..5
      $imgs = [];
      for ($i = 1; $i <= 5; $i++) {
        $img = get_field("i_gal_img_$i");
        if (!empty($img['url'])) {
          $imgs[] = [
            'full'  => $img['url'],
            'alt'   => $img['alt'] ?: get_the_title(),
            'thumb' => $img['sizes']['large'] ?? $img['url'],
          ];
        }
      }
      $gallery_height = 600; // px
      $col1 = ['3fr', '4fr'];
      $col2 = ['4fr', '3fr'];
    ?>
    <?php if (count($imgs) >= 5): ?>
      <div class="max-w-[1200px] mx-auto">
        <h2 class="text-[#E30713] font-bold text-[28px] text-center mb-4">
          <?php the_field("группа_1"); ?>
        </h2>
        <!-- ОСНОВНОЙ GRID -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lgm:grid-cols-3 items-stretch min-h-0" style="gap:12px; height:<?= $gallery_height ?>px;">
          <!-- КОЛОНКА 1 -->
          <div class="grid h-full min-h-0" style="grid-template-rows:<?= implode(' ', $col1) ?>; gap:12px;">
            <button type="button" class="w-full h-full min-h-0 overflow-hidden rounded-2xl"
                    data-modal-open data-full="<?= esc_url($imgs[0]['full']); ?>">
              <img src="<?= esc_url($imgs[0]['thumb']); ?>" alt="<?= esc_attr($imgs[0]['alt']); ?>"
                   class="transition-transform duration-200 hover:scale-105 block w-full h-full min-h-0 object-cover" />
            </button>
            <button type="button" class="w-full h-full min-h-0 overflow-hidden rounded-2xl"
                    data-modal-open data-full="<?= esc_url($imgs[1]['full']); ?>">
              <img src="<?= esc_url($imgs[1]['thumb']); ?>" alt="<?= esc_attr($imgs[1]['alt']); ?>"
                   class="transition-transform duration-200 hover:scale-105 block w-full h-full min-h-0 object-cover" />
            </button>
          </div>
          <!-- КОЛОНКА 2 -->
          <div class="hidden lgm:grid h-full min-h-0" style="grid-template-rows:<?= implode(' ', $col2) ?>; gap:12px;">
            <button type="button" class="w-full h-full min-h-0 overflow-hidden rounded-2xl"
                    data-modal-open data-full="<?= esc_url($imgs[2]['full']); ?>">
              <img src="<?= esc_url($imgs[2]['thumb']); ?>" alt="<?= esc_attr($imgs[2]['alt']); ?>"
                   class="transition-transform duration-200 hover:scale-105 block w-full h-full min-h-0 object-cover" />
            </button>
            <button type="button" class="w-full h-full min-h-0 overflow-hidden rounded-2xl"
                    data-modal-open data-full="<?= esc_url($imgs[3]['full']); ?>">
              <img src="<?= esc_url($imgs[3]['thumb']); ?>" alt="<?= esc_attr($imgs[3]['alt']); ?>"
                   class="transition-transform duration-200 hover:scale-105 block w-full h-full min-h-0 object-cover" />
            </button>
          </div>
          <!-- КОЛОНКА 3 -->
          <button type="button" class="w-full h-full min-h-0 overflow-hidden rounded-2xl"
                  data-modal-open data-full="<?= esc_url($imgs[4]['full']); ?>"
                  style="height: 100%;">
            <img src="<?= esc_url($imgs[4]['thumb']); ?>" alt="<?= esc_attr($imgs[4]['alt']); ?>"
                 class="transition-transform duration-200 hover:scale-105 block w-full h-full min-h-0 object-cover" />
          </button>
        </div>
        <!-- Кнопка -->
        <?php
          $btn = [
            'url'    => get_field('кнопка_фото_ссылка_1'),
            'title'  => get_field('кнопка_фото'),
          ];
          $btn_url = isset($btn['url']) ? trim((string)$btn['url']) : '';
          $btn_txt = isset($btn['title']) ? trim((string)$btn['title']) : '';
        ?>
        <div class="mb-6 text-center">
          <?php if ($btn_url): ?>
            <a href="<?= esc_url($btn_url); ?>" target="<?= esc_attr($btn_tgt); ?>"
              class="mt-5 inline-block px-6 py-2 bg-[#FEED00] text-[#153F93] rounded-[20px] font-medium hover:text-[#FFFFFF] hover:bg-[#E30713] transition mx-auto">
              <?= esc_html($btn_txt); ?>
            </a>
          <?php endif; ?>
        </div>
      </div>
    <?php endif; ?>
  </div>
  <!-- Фотогалерея 2 -->
  <div class="max-w-[1440px] mx-auto px-10 lgm:px-[70px] py-6">
    <?php
      // 5 картинок из ACF: i_gal_img_1..5
      $imgs = [];
      for ($i = 1; $i <= 5; $i++) {
        $img = get_field("ii_gal_img_$i");
        if (!empty($img['url'])) {
          $imgs[] = [
            'full'  => $img['url'],
            'alt'   => $img['alt'] ?: get_the_title(),
            'thumb' => $img['sizes']['large'] ?? $img['url'],
          ];
        }
      }
      $gallery_height = 600; // px
      $col1 = ['5fr', '4fr'];
      $col2 = ['3fr', '5fr'];
    ?>
    <?php if (count($imgs) >= 5): ?>
      <div class="max-w-[1200px] mx-auto">
        <h2 class="text-[#153F93] font-bold text-[28px] text-center mb-4">
          <?php the_field("группа_2"); ?>
        </h2>
        <!-- ОСНОВНОЙ GRID -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lgm:grid-cols-3 items-stretch min-h-0" style="gap:12px; height:<?= $gallery_height ?>px;">
          <!-- КОЛОНКА 1 -->
          <div class="grid h-full min-h-0" style="grid-template-rows:<?= implode(' ', $col1) ?>; gap:12px;">
            <button type="button" class="w-full h-full min-h-0 overflow-hidden rounded-2xl"
                    data-modal-open data-full="<?= esc_url($imgs[0]['full']); ?>">
              <img src="<?= esc_url($imgs[0]['thumb']); ?>" alt="<?= esc_attr($imgs[0]['alt']); ?>"
                   class="transition-transform duration-200 hover:scale-105 block w-full h-full min-h-0 object-cover" />
            </button>
            <button type="button" class="w-full h-full min-h-0 overflow-hidden rounded-2xl"
                    data-modal-open data-full="<?= esc_url($imgs[1]['full']); ?>">
              <img src="<?= esc_url($imgs[1]['thumb']); ?>" alt="<?= esc_attr($imgs[1]['alt']); ?>"
                   class="transition-transform duration-200 hover:scale-105 block w-full h-full min-h-0 object-cover" />
            </button>
          </div>
          <!-- КОЛОНКА 2 -->
          <button type="button" class="w-full h-full min-h-0 overflow-hidden rounded-2xl"
                  data-modal-open data-full="<?= esc_url($imgs[2]['full']); ?>"
                  style="height: 100%;">
            <img src="<?= esc_url($imgs[2]['thumb']); ?>" alt="<?= esc_attr($imgs[4]['alt']); ?>"
                 class="transition-transform duration-200 hover:scale-105 block w-full h-full min-h-0 object-cover" />
          </button>
          <!-- КОЛОНКА 3 -->
          <div class="hidden lgm:grid h-full min-h-0" style="grid-template-rows:<?= implode(' ', $col2) ?>; gap:12px;">
            <button type="button" class="w-full h-full min-h-0 overflow-hidden rounded-2xl"
                    data-modal-open data-full="<?= esc_url($imgs[3]['full']); ?>">
              <img src="<?= esc_url($imgs[3]['thumb']); ?>" alt="<?= esc_attr($imgs[2]['alt']); ?>"
                   class="transition-transform duration-200 hover:scale-105 block w-full h-full min-h-0 object-cover" />
            </button>
            <button type="button" class="w-full h-full min-h-0 overflow-hidden rounded-2xl"
                    data-modal-open data-full="<?= esc_url($imgs[4]['full']); ?>">
              <img src="<?= esc_url($imgs[4]['thumb']); ?>" alt="<?= esc_attr($imgs[3]['alt']); ?>"
                   class="transition-transform duration-200 hover:scale-105 block w-full h-full min-h-0 object-cover" />
            </button>
          </div>
          
        </div>
        <!-- Кнопка -->
        <?php
          $btn = [
            'url'    => get_field('кнопка_фото_ссылка_2'),
            'title'  => get_field('кнопка_фото'),
          ];
          $btn_url = isset($btn['url']) ? trim((string)$btn['url']) : '';
          $btn_txt = isset($btn['title']) ? trim((string)$btn['title']) : '';
        ?>
        <div class="mb-6 text-center">
          <?php if ($btn_url): ?>
            <a href="<?= esc_url($btn_url); ?>" target="<?= esc_attr($btn_tgt); ?>"
              class="mt-5 inline-block px-6 py-2 bg-[#153F93] text-[#ffffff] rounded-[20px] font-medium hover:text-[#153F93] hover:bg-[#FEED00] transition mx-auto">
              <?= esc_html($btn_txt); ?>
            </a>
          <?php endif; ?>
        </div>
      </div>
    <?php endif; ?>
  </div>
  <!-- Фотогалерея 3 -->
  <div class="max-w-[1440px] mx-auto px-10 lgm:px-[70px] py-6">
    <?php
      // 5 картинок из ACF: i_gal_img_1..5
      $imgs = [];
      for ($i = 1; $i <= 5; $i++) {
        $img = get_field("iii_gal_img_$i");
        if (!empty($img['url'])) {
          $imgs[] = [
            'full'  => $img['url'],
            'alt'   => $img['alt'] ?: get_the_title(),
            'thumb' => $img['sizes']['large'] ?? $img['url'],
          ];
        }
      }
      $gallery_height = 600; // px
      $col1 = ['5fr', '4fr'];
      $col2 = ['3fr', '5fr'];
    ?>
    <?php if (count($imgs) >= 5): ?>
      <div class="max-w-[1200px] mx-auto">
        <h2 class="text-[#00963F] font-bold text-[28px] text-center mb-4">
          <?php the_field("группа_3"); ?>
        </h2>
        <!-- ОСНОВНОЙ GRID -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lgm:grid-cols-3 items-stretch min-h-0" style="gap:12px; height:<?= $gallery_height ?>px;">
          <!-- КОЛОНКА 1 -->
          <button type="button" class="w-full h-full min-h-0 overflow-hidden rounded-2xl"
                  data-modal-open data-full="<?= esc_url($imgs[0]['full']); ?>"
                  style="height: 100%;">
            <img src="<?= esc_url($imgs[0]['thumb']); ?>" alt="<?= esc_attr($imgs[4]['alt']); ?>"
                 class="transition-transform duration-200 hover:scale-105 block w-full h-full min-h-0 object-cover" />
          </button>
          <!-- КОЛОНКА 2 -->
          <div class="grid h-full min-h-0" style="grid-template-rows:<?= implode(' ', $col1) ?>; gap:12px;">
            <button type="button" class="w-full h-full min-h-0 overflow-hidden rounded-2xl"
                    data-modal-open data-full="<?= esc_url($imgs[1]['full']); ?>">
              <img src="<?= esc_url($imgs[1]['thumb']); ?>" alt="<?= esc_attr($imgs[0]['alt']); ?>"
                   class="transition-transform duration-200 hover:scale-105 block w-full h-full min-h-0 object-cover" />
            </button>
            <button type="button" class="w-full h-full min-h-0 overflow-hidden rounded-2xl"
                    data-modal-open data-full="<?= esc_url($imgs[2]['full']); ?>">
              <img src="<?= esc_url($imgs[2]['thumb']); ?>" alt="<?= esc_attr($imgs[1]['alt']); ?>"
                   class="transition-transform duration-200 hover:scale-105 block w-full h-full min-h-0 object-cover" />
            </button>
          </div>
          <!-- КОЛОНКА 3 -->
          <div class="hidden lgm:grid h-full min-h-0" style="grid-template-rows:<?= implode(' ', $col2) ?>; gap:12px;">
            <button type="button" class="w-full h-full min-h-0 overflow-hidden rounded-2xl"
                    data-modal-open data-full="<?= esc_url($imgs[3]['full']); ?>">
              <img src="<?= esc_url($imgs[3]['thumb']); ?>" alt="<?= esc_attr($imgs[2]['alt']); ?>"
                   class="transition-transform duration-200 hover:scale-105 block w-full h-full min-h-0 object-cover" />
            </button>
            <button type="button" class="w-full h-full min-h-0 overflow-hidden rounded-2xl"
                    data-modal-open data-full="<?= esc_url($imgs[4]['full']); ?>">
              <img src="<?= esc_url($imgs[4]['thumb']); ?>" alt="<?= esc_attr($imgs[3]['alt']); ?>"
                   class="transition-transform duration-200 hover:scale-105 block w-full h-full min-h-0 object-cover" />
            </button>
          </div>
          
        </div>
        <!-- Кнопка -->
        <?php
          $btn = [
            'url'    => get_field('кнопка_фото_ссылка_3'),
            'title'  => get_field('кнопка_фото'),
          ];
          $btn_url = isset($btn['url']) ? trim((string)$btn['url']) : '';
          $btn_txt = isset($btn['title']) ? trim((string)$btn['title']) : '';
        ?>
        <div class="mb-6 text-center">
          <?php if ($btn_url): ?>
            <a href="<?= esc_url($btn_url); ?>" target="<?= esc_attr($btn_tgt); ?>"
              class="mt-5 inline-block px-6 py-2 bg-[#00963F] text-[#ffffff] rounded-[20px] font-medium hover:text-[#153F93] hover:bg-[#FEED00] transition mx-auto">
              <?= esc_html($btn_txt); ?>
            </a>
          <?php endif; ?>
        </div>
      </div>
    <?php endif; ?>
  </div>
  <!-- Фотогалерея 4 -->
  <div class="max-w-[1440px] mx-auto px-10 lgm:px-[70px] py-6">
    <?php
      // 5 картинок из ACF: i_gal_img_1..5
      $imgs = [];
      for ($i = 1; $i <= 5; $i++) {
        $img = get_field("iv_gal_img_$i");
        if (!empty($img['url'])) {
          $imgs[] = [
            'full'  => $img['url'],
            'alt'   => $img['alt'] ?: get_the_title(),
            'thumb' => $img['sizes']['large'] ?? $img['url'],
          ];
        }
      }
      $gallery_height = 600; // px
      $col1 = ['5fr', '4fr'];
      $col2 = ['3fr', '5fr'];
    ?>
    <?php if (count($imgs) >= 5): ?>
      <div class="max-w-[1200px] mx-auto">
        <h2 class="text-[#E30713] font-bold text-[28px] text-center mb-4">
          <?php the_field("группа_4"); ?>
        </h2>
        <!-- ОСНОВНОЙ GRID -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lgm:grid-cols-3 items-stretch min-h-0" style="gap:12px; height:<?= $gallery_height ?>px;">
          <!-- КОЛОНКА 1 -->
          <div class="grid h-full min-h-0" style="grid-template-rows:<?= implode(' ', $col1) ?>; gap:12px;">
            <button type="button" class="w-full h-full min-h-0 overflow-hidden rounded-2xl"
                    data-modal-open data-full="<?= esc_url($imgs[0]['full']); ?>">
              <img src="<?= esc_url($imgs[0]['thumb']); ?>" alt="<?= esc_attr($imgs[0]['alt']); ?>"
                   class="transition-transform duration-200 hover:scale-105 block w-full h-full min-h-0 object-cover" />
            </button>
            <button type="button" class="w-full h-full min-h-0 overflow-hidden rounded-2xl"
                    data-modal-open data-full="<?= esc_url($imgs[1]['full']); ?>">
              <img src="<?= esc_url($imgs[1]['thumb']); ?>" alt="<?= esc_attr($imgs[1]['alt']); ?>"
                   class="transition-transform duration-200 hover:scale-105 block w-full h-full min-h-0 object-cover" />
            </button>
          </div>
          <!-- КОЛОНКА 2 -->
          <div class="hidden lgm:grid h-full min-h-0" style="grid-template-rows:<?= implode(' ', $col2) ?>; gap:12px;">
            <button type="button" class="w-full h-full min-h-0 overflow-hidden rounded-2xl"
                    data-modal-open data-full="<?= esc_url($imgs[2]['full']); ?>">
              <img src="<?= esc_url($imgs[2]['thumb']); ?>" alt="<?= esc_attr($imgs[2]['alt']); ?>"
                   class="transition-transform duration-200 hover:scale-105 block w-full h-full min-h-0 object-cover" />
            </button>
            <button type="button" class="w-full h-full min-h-0 overflow-hidden rounded-2xl"
                    data-modal-open data-full="<?= esc_url($imgs[3]['full']); ?>">
              <img src="<?= esc_url($imgs[3]['thumb']); ?>" alt="<?= esc_attr($imgs[3]['alt']); ?>"
                   class="transition-transform duration-200 hover:scale-105 block w-full h-full min-h-0 object-cover" />
            </button>
          </div>
          <!-- КОЛОНКА 3 -->
          <button type="button" class="w-full h-full min-h-0 overflow-hidden rounded-2xl"
                  data-modal-open data-full="<?= esc_url($imgs[4]['full']); ?>"
                  style="height: 100%;">
            <img src="<?= esc_url($imgs[4]['thumb']); ?>" alt="<?= esc_attr($imgs[4]['alt']); ?>"
                 class="transition-transform duration-200 hover:scale-105 block w-full h-full min-h-0 object-cover" />
          </button>

        </div>
        <!-- Кнопка -->
        <?php
          $btn = [
            'url'    => get_field('кнопка_фото_ссылка_4'),
            'title'  => get_field('кнопка_фото'),
          ];
          $btn_url = isset($btn['url']) ? trim((string)$btn['url']) : '';
          $btn_txt = isset($btn['title']) ? trim((string)$btn['title']) : '';
        ?>
        <div class="mb-6 text-center">
          <?php if ($btn_url): ?>
            <a href="<?= esc_url($btn_url); ?>" target="<?= esc_attr($btn_tgt); ?>"
              class="mt-5 inline-block px-6 py-2 bg-[#E30713] text-[#ffffff] rounded-[20px] font-medium hover:text-[#153F93] hover:bg-[#FEED00] transition mx-auto">
              <?= esc_html($btn_txt); ?>
            </a>
          <?php endif; ?>
        </div>
      </div>
    <?php endif; ?>
  </div>
  <!-- Фотогалерея 5 -->
  <div class="max-w-[1440px] mx-auto px-10 lgm:px-[70px] py-6">
    <?php
      // 5 картинок из ACF: i_gal_img_1..5
      $imgs = [];
      for ($i = 1; $i <= 5; $i++) {
        $img = get_field("v_gal_img_$i");
        if (!empty($img['url'])) {
          $imgs[] = [
            'full'  => $img['url'],
            'alt'   => $img['alt'] ?: get_the_title(),
            'thumb' => $img['sizes']['large'] ?? $img['url'],
          ];
        }
      }
      $gallery_height = 600; // px
      $col1 = ['5fr', '4fr'];
      $col2 = ['3fr', '5fr'];
    ?>
    <?php if (count($imgs) >= 5): ?>
      <div class="max-w-[1200px] mx-auto">
        <h2 class="text-[#153F93] font-bold text-[28px] text-center mb-4">
          <?php the_field("группа_5"); ?>
        </h2>
        <!-- ОСНОВНОЙ GRID -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lgm:grid-cols-3 items-stretch min-h-0" style="gap:12px; height:<?= $gallery_height ?>px;">
          <!-- КОЛОНКА 1 -->
          <div class="grid h-full min-h-0" style="grid-template-rows:<?= implode(' ', $col1) ?>; gap:12px;">
            <button type="button" class="w-full h-full min-h-0 overflow-hidden rounded-2xl"
                    data-modal-open data-full="<?= esc_url($imgs[0]['full']); ?>">
              <img src="<?= esc_url($imgs[0]['thumb']); ?>" alt="<?= esc_attr($imgs[0]['alt']); ?>"
                   class="transition-transform duration-200 hover:scale-105 block w-full h-full min-h-0 object-cover" />
            </button>
            <button type="button" class="w-full h-full min-h-0 overflow-hidden rounded-2xl"
                    data-modal-open data-full="<?= esc_url($imgs[1]['full']); ?>">
              <img src="<?= esc_url($imgs[1]['thumb']); ?>" alt="<?= esc_attr($imgs[1]['alt']); ?>"
                   class="transition-transform duration-200 hover:scale-105 block w-full h-full min-h-0 object-cover" />
            </button>
          </div>
          <!-- КОЛОНКА 2 -->
          <button type="button" class="w-full h-full min-h-0 overflow-hidden rounded-2xl"
                  data-modal-open data-full="<?= esc_url($imgs[2]['full']); ?>"
                  style="height: 100%;">
            <img src="<?= esc_url($imgs[2]['thumb']); ?>" alt="<?= esc_attr($imgs[4]['alt']); ?>"
                 class="transition-transform duration-200 hover:scale-105 block w-full h-full min-h-0 object-cover" />
          </button>
          <!-- КОЛОНКА 3 -->
          <div class="hidden lgm:grid h-full min-h-0" style="grid-template-rows:<?= implode(' ', $col2) ?>; gap:12px;">
            <button type="button" class="w-full h-full min-h-0 overflow-hidden rounded-2xl"
                    data-modal-open data-full="<?= esc_url($imgs[3]['full']); ?>">
              <img src="<?= esc_url($imgs[3]['thumb']); ?>" alt="<?= esc_attr($imgs[2]['alt']); ?>"
                   class="transition-transform duration-200 hover:scale-105 block w-full h-full min-h-0 object-cover" />
            </button>
            <button type="button" class="w-full h-full min-h-0 overflow-hidden rounded-2xl"
                    data-modal-open data-full="<?= esc_url($imgs[4]['full']); ?>">
              <img src="<?= esc_url($imgs[4]['thumb']); ?>" alt="<?= esc_attr($imgs[3]['alt']); ?>"
                   class="transition-transform duration-200 hover:scale-105 block w-full h-full min-h-0 object-cover" />
            </button>
          </div>
          
        </div>
        <!-- Кнопка -->
        <?php
          $btn = [
            'url'    => get_field('кнопка_фото_ссылка_5'),
            'title'  => get_field('кнопка_фото'),
          ];
          $btn_url = isset($btn['url']) ? trim((string)$btn['url']) : '';
          $btn_txt = isset($btn['title']) ? trim((string)$btn['title']) : '';
        ?>
        <div class="mb-6 text-center">
          <?php if ($btn_url): ?>
            <a href="<?= esc_url($btn_url); ?>" target="<?= esc_attr($btn_tgt); ?>"
              class="mt-5 inline-block px-6 py-2 bg-[#153F93] text-[#ffffff] rounded-[20px] font-medium hover:text-[#153F93] hover:bg-[#FEED00] transition mx-auto">
              <?= esc_html($btn_txt); ?>
            </a>
          <?php endif; ?>
        </div>
      </div>
    <?php endif; ?>
  </div>

  <!-- Модалка -->
  <div id="mg-modal" class="fixed inset-0 z-[100] hidden flex items-center justify-center" role="dialog" aria-modal="true">
    <div class="absolute inset-0 bg-[#00963F]/50" data-modal-close></div>
    <div class="relative z-10">
      <img id="mg-modal-img" src="" alt=""
          class="block max-h-[80vh] max-w-[90vw] object-contain rounded-2xl" />
      <button type="button"
              class="absolute top-2 right-2 w-9 h-9 rounded-full bg-white/90 hover:bg-white shadow
                    flex items-center justify-center text-xl"
              data-modal-close aria-label="Закрыть" style="right:-1.5rem; top:-1.5rem;">×</button>
    </div>
  </div>
  <script>
    (function(){
      const modal = document.getElementById('mg-modal');
      const modalImg = document.getElementById('mg-modal-img');
      function open(src, alt){
        modalImg.src = src;
        modalImg.alt = alt || '';
        modal.classList.remove('hidden');
        document.documentElement.style.overflow = 'hidden';
      }
      function close(){
        modal.classList.add('hidden');
        document.documentElement.style.overflow = '';
        modalImg.src = '';
      }
      document.addEventListener('click', (e) => {
        const openBtn = e.target.closest('[data-modal-open]');
        if (openBtn) {
          e.preventDefault();
          const img = openBtn.querySelector('img');
          open(openBtn.dataset.full, img ? img.alt : '');
          return;
        }
        if (e.target.closest('[data-modal-close]')) {
          e.preventDefault();
          close();
        }
      });
      document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && !modal.classList.contains('hidden')) close();
      });
    })();
  </script>
</section>


<!-- Блок 3: Запись -->
<section class="w-full bg-[#FEED00] relative overflow-hidden">
  <div class="max-w-[1440px] mx-auto flex flex-col lgm:flex-row items-stretch lgm:min-h-[600px]">
    
    <!-- Левая картинка -->
    <div class="w-full lgm:w-auto lgm:flex-1 lgm:min-w-0 h-auto lgm:h-[600px] lgm:absolute lgm:left-0 lgm:top-0 lgm:bottom-0 order-1 lgm:order-none">
      <img src="<?= get_template_directory_uri(); ?>/assets/main/5-1.webp"
           alt="занятие"
           class="hidden lgm:block w-auto h-full object-cover" />
      <img src="<?= get_template_directory_uri(); ?>/assets/main/5-1m.webp"
           alt="занятие"
           class="lgm:hidden w-full h-full object-cover" />
    </div>

    <!-- Правая текстовая часть -->
    <div class="w-full lgm:w-[58%] lgm:ml-auto pl-10 lgm:pl-[115px] py-10 lgm:py-0 flex flex-col justify-center relative z-10 lgm:min-h-[300px] order-2 lgm:order-none">
      
      <!-- Кубики -->
      <img src="<?= get_template_directory_uri(); ?>/assets/main/5-2.webp"
           alt="кубики"
           class="w-[80px] lgm:w-[160px] h-auto mb-4 lgm:absolute lgm:top-[20%] lgm:mb-0 z-0" />
      
      <!-- Заголовок -->
      <div class="relative z-10 lgm:mt-[160px]">
        <h2 class="text-[#E30713] font-bold text-[36px] lgm:text-[50px] leading-tight mb-4">
          <?php the_field("заголовок_2"); ?>
        </h2>
      </div>

      

      <!-- Кнопка -->
      <?php
      $btn = [
        'url'    => get_field('кнопка_ссылка'),
        'title'  => get_field('кнопка'),
      ];
      $btn_url = isset($btn['url']) ? trim((string)$btn['url']) : '';
      $btn_txt = isset($btn['title']) ? trim((string)$btn['title']) : '';
      ?>
      <?php if ($btn_url): ?>
        <a href="<?= esc_url($btn_url); ?>" target="<?= esc_attr($btn_tgt); ?>"
           class="mx-auto lgm:mx-0 mt-5 inline-block px-6 self-start py-2 bg-[#009640] text-[#ffffff] rounded-[20px] font-medium hover:text-[#ffffff] hover:bg-[#E30713] transition">
          <?= esc_html($btn_txt); ?>
        </a>
      <?php endif; ?>

    </div>
  </div>
</section>


<?php get_footer(); ?>