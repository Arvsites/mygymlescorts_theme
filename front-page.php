<?php
/**
 * Шаблон главной страницы
 */
get_header();
?>

<!-- Блок 1: Вступление -->
<section class="mt-16 w-full bg-[#009640] relative overflow-hidden">
  <div class="max-w-[1440px] mx-auto flex flex-col lgm:flex-row items-stretch">
    
    <!-- Правая картинка -->
    <div class="w-full lgm:w-[60%] h-auto lgm:order-2 lgm:ml-auto bleed-right">
      <img src="<?= get_template_directory_uri(); ?>/assets/main/1-2.webp"
          alt="дети на занятии"
          class="hidden lgm:block w-full h-full object-cover" />
      <img src="<?= get_template_directory_uri(); ?>/assets/main/1-2m.webp"
          alt="дети на занятии"
          class="lgm:hidden w-full h-full object-cover" />
    </div>

    <!-- Левая текстовая часть -->
    <div class="w-full lgm:w-[60%] pl-10 lgm:pl-[115px] py-10 lgm:py-0 flex flex-col justify-center relative z-10">
      
      <!-- Кубики -->
      <img src="<?= get_template_directory_uri(); ?>/assets/main/1-1.webp"
           alt="кубики"
           class="w-[80px] lgm:w-[160px] h-auto mb-4 lgm:absolute lgm:top-[20%]  lgm:mb-0 z-0" />
      

      <!-- Текст -->
      <div class="relative z-10 lgm:mt-[160px]">
        <h2 class="text-white font-bold text-[36px] lgm:text-[45px] leading-tight mb-4">
          MyGym Les Corts
        </h2>
        <p class="w-[315px] text-white font-medium text-[20px] lgm:text-[22px] leading-relaxed">
          <?php the_field("блок_1"); ?>
        </p>
        
      </div>
    </div>
  </div>
</section>


<!-- Блок 2: О нас -->
<section class="w-full bg-white relative overflow-hidden">
  <div class="max-w-[1440px] mx-auto flex flex-col lgm:flex-row items-center lgm:items-stretch my-[0px] lgm:my-[90px] px-10 lgm:px-[70px]">

    <!-- Левая картинка -->
    <div class="w-full lgm:w-1/2 flex justify-center lgm:justify-start">
      <img src="<?= get_template_directory_uri(); ?>/assets/main/2-1.webp"
           alt="дети с кубиками"
           class="w-full max-w-[460px] h-auto object-contain rounded-[40px] lgm:rounded-[60px]" />
    </div>

    <!-- Правая текстовая часть -->
    <div class="w-full lgm:w-1/2 flex flex-col justify-center">
      <h2 class="text-[#154092] font-bold text-[28px] lgm:text-[36px] leading-snug mb-6">
        <?php the_field("блок_2_заголовок"); ?>
      </h2>
      <p class="text-[#424242] font-medium text-[14px] lgm:text-[18px] leading-relaxed max-w-[600px]">
        <?php the_field("блок_2_текст"); ?>
      </p>
    </div>

  </div>
</section>

<!-- Блок 3: Программы -->
<section class="w-full bg-[#FFF8BC] relative overflow-hidden">
  <div class="max-w-[1440px] mx-auto my-[0px] lgm:my-[90px] px-10 lgm:px-[70px]">

    <h2 class="text-center text-[#154092] font-bold text-[28px] lgm:text-[36px] leading-snug mb-8 lgm:mb-10">
      <?php the_field('блок_3_заголовок'); ?>
    </h2>

    <div class="grid grid-cols-1 lgm:grid-cols-2 gap-6 lgm:gap-8 items-stretch">
      <?php for ($i = 1; $i <= 6; $i++) : ?>
        <?php
        // === IMG (ACF Image: ID | Array | URL) ===
        $img_d = get_field("блок_3_картинка_{$i}_программы");
        $img_m = get_field("блок_3_картинка_{$i}_программы_mob"); // можно не заполнять

        // нормализуем к ID/URL
        $img_d_id = is_array($img_d) ? ($img_d['ID'] ?? 0) : (is_numeric($img_d) ? (int)$img_d : 0);
        $img_m_id = is_array($img_m) ? ($img_m['ID'] ?? 0) : (is_numeric($img_m) ? (int)$img_m : 0);

        $src_d = $img_d_id ? (wp_get_attachment_image_src($img_d_id, 'program-card')[0] ?? '') : (is_string($img_d) ? $img_d : '');
        $src_m = $img_m_id ? (wp_get_attachment_image_src($img_m_id, 'program-card')[0] ?? '') : (is_string($img_m) ? $img_m : '');
        if (!$src_m) { $src_m = $src_d; } // запасной вариант

        $alt = $img_d_id ? get_post_meta($img_d_id, '_wp_attachment_image_alt', true) : (is_array($img_d) ? ($img_d['alt'] ?? '') : '');

        // === BUTTON (ACF Link | Text URL) ===
        $btn_field = get_field("блок_3_ссылка_1_программы");
        $btn_url   = '';
        $btn_tgt   = '_self';
        if (is_array($btn_field)) {
          $btn_url = $btn_field['url'] ?? '';
          $btn_tgt = $btn_field['target'] ?? '_self';
          $btn_acf_title = $btn_field['title'] ?? '';
        } elseif (is_string($btn_field)) {
          $btn_url = $btn_field;
        }
        $btn_txt = get_field("блок_3_кнопка_{$i}_программы");
        if (!$btn_txt) { $btn_txt = isset($btn_acf_title) && $btn_acf_title ? $btn_acf_title : 'Подробнее'; }
        ?>

        <article class="bg-white rounded-[20px] shadow-[0_6px_20px_rgba(0,0,0,0.12)] overflow-hidden flex flex-col h-full">
          <div class="grid grid-cols-1 lgm:grid-cols-[260px_1fr] h-full">

            <?php if ($src_d): ?>
              <div class="relative h-[220px] lgm:h-auto">
                <picture>
                  <source media="(min-width: 1150px)" srcset="<?= esc_url($src_d); ?>">
                  <img src="<?= esc_url($src_m); ?>" alt="<?= esc_attr($alt); ?>" class="absolute inset-0 w-full h-full object-cover" />
                </picture>
              </div>
            <?php endif; ?>

            <div class="p-5 lgm:p-6 flex flex-col flex-grow">
              <h3 class="text-[#154092] font-bold text-[18px] lgm:text-[20px] leading-snug mb-3 min-h-[48px]">
                <?php the_field("блок_3_заголовок_{$i}_программы"); ?>
              </h3>

              <div class="text-[#424242] text-[14px] leading-relaxed flex-1">
                <?php the_field("блок_3_описание_{$i}_программы_1"); ?>
              </div>
              <div class="my-2 program-desc text-[#424242] text-[14px] leading-relaxed flex-1">
                <?php the_field("блок_3_список_{$i}_программы"); ?>
              </div>
              <div class="text-[#424242] text-[14px] leading-relaxed flex-1">
                <?php the_field("блок_3_описание_{$i}_программы_2"); ?>
              </div>

              <?php if ($btn_url): ?>
                <a href="<?= esc_url($btn_url); ?>" target="<?= esc_attr($btn_tgt); ?>"
                   class="mx-auto lgm:mx-0 mt-5 inline-block px-6 self-start py-2 bg-[#154092] text-white rounded-[20px] font-medium hover:text-[#153F93] hover:bg-[#FEED00] transition">
                  <?= esc_html($btn_txt); ?>
                </a>
              <?php endif; ?>
            </div>

          </div>
        </article>
      <?php endfor; ?>
    </div>
  </div>
</section>


<!-- Блок 4: Почему выбирают -->
<section class="w-full bg-[#DFFFED]">
  <div class="max-w-[1440px] mx-auto px-10 lgm:px-[70px] my-[0px] lgm:my-[90px]">

    <h2 class="text-center font-bold text-[28px] lgm:text-[36px] leading-snug text-[#E30713] mb-8 lgm:mb-12">
      <?php the_field('блок_4_заголовок'); ?>
    </h2>

    <?php
    // 5 картинок из assets/main
    $base = get_template_directory_uri() . '/assets/main';
    $imgs = [
      ['src' => "$base/4-1.webp", 'alt' => 'feature 1'],
      ['src' => "$base/4-2.webp", 'alt' => 'feature 2'],
      ['src' => "$base/4-3.webp", 'alt' => 'feature 3'],
      ['src' => "$base/4-4.webp", 'alt' => 'feature 4'],
      ['src' => "$base/4-5.webp", 'alt' => 'feature 5'],
    ];
    ?>

    <div class="grid grid-cols-1 sm:grid-cols-2 lgm:grid-cols-3 gap-10 lgm:gap-16 items-start">
      <?php for ($i = 1; $i <= 5; $i++): ?>
        <?php
          $img = $imgs[$i-1];
          $text = get_field("блок_4_причина_{$i}");
        ?>
        <div class="<?=
            // 2-й ряд: элементы 4 и 5 расставляем как на макете (слева и справа)
            ($i === 4 ? 'lgm:-mr-[120%] lgm:col-start-1' : '') .
            ($i === 5 ? 'lgm:-ml-[120%] lgm:col-start-3' : '')
          ?>">
          <div class="flex flex-col items-center text-center">
            <div class="relative w-[150px] h-[150px] lgm:w-[180px] lgm:h-[180px]">
              <!-- жёлтая подложка -->
              <span class="absolute -top-3 -left-3 lgm:-top-4 lgm:-left-4 w-[88px] h-[88px] lgm:w-[110px] lgm:h-[110px] bg-[#FFF6A1] rounded-[24px] rotate-[-12deg]"></span>
              <!-- круглое фото -->
              <img src="<?= esc_url($img['src']); ?>" alt="<?= esc_attr($img['alt']); ?>"
                   class="absolute inset-0 w-full h-full object-cover rounded-full shadow-[0_10px_30px_rgba(0,0,0,0.15)]" />
            </div>

            <p class="mt-4 max-w-[280px] font-bold text-[18px] lgm:text-[20px] text-[#004E21] leading-snug">
              <?= $text ? wp_kses_post($text) : ''; ?>
            </p>
          </div>
        </div>
      <?php endfor; ?>
    </div>

  </div>
</section>


<!-- Блок 5: Запись -->
<section class="w-full bg-[#FFF6A1] relative overflow-hidden">
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
          <?php the_field("блок_5_заголовок"); ?>
        </h2>
      </div>

      <!-- Кнопка -->
      <?php if ($btn_url): ?>
        <a href="<?= esc_url($btn_url); ?>" target="<?= esc_attr($btn_tgt); ?>"
           class="mx-auto lgm:mx-0 mt-5 inline-block px-6 self-start py-2 bg-[#009640] text-white rounded-[20px] font-medium hover:text-[#153F93] hover:bg-[#FEED00] transition">
          <?= esc_html($btn_txt); ?>
        </a>
      <?php endif; ?>

    </div>
  </div>
</section>


<!-- Блок 6: Контактные данные -->
<section class="w-full bg-[#DFFFED] relative overflow-hidden">
  <div class="max-w-[1440px] my-[0px] lgm:my-[90px] mx-auto flex flex-col lgm:flex-row items-stretch">
    
    <!-- Карта -->
    <div class="lgm:px-[70px] pb-0 lgm:pb-10  w-full lgm:w-[60%] h-[350px] lgm:min-h-[500px]">
      <iframe 
      src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2993.4294846960597!2d2.1384213757833255!3d41.38647839605191!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x12a4987953339abb%3A0xb9522e5b5f65af7f!2zQ2FycmVyIGRlIEJyZWRhLCAxMSwgTGVzIENvcnRzLCAwODAyOSBCYXJjZWxvbmEsINCY0YHQv9Cw0L3QuNGP!5e0!3m2!1sru!2sde!4v1755600448984!5m2!1sru!2sde" 
      width="100%"
      height="100%"
      style="border:0;"
      allowfullscreen=""
      loading="lazy"
      referrerpolicy="no-referrer-when-downgrade">
    </iframe>
    </div>
    
    <!-- Правая текстовая часть -->
    <div class="w-full xl:w-[70%] lg:w-[65%] lgm:w-[72%] px-10 lgm:pr-[70px] pt-6 lgm:pt-0 flex flex-col justify-start relative z-10">
        
      <!-- Текст -->
      <div class="relative z-10 mb-10">
        <h2 class="text-[#154092] font-bold text-[28px] lgm:text-[35px] leading-tight mb-4">
          <?php the_field("блок_6_заголовок"); ?>
        </h2>
    
        <div class="flex items-start mb-3">
          <svg class="w-5 h-5 mt-1 mr-3 text-[#009640]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
          </svg>
          <h2 class="text-[#010B1F] font-medium text-[14px] lgm:text-[20px] leading-tight">
            <?php the_field("блок_6_адрес"); ?>
          </h2>
        </div>
    
        <div class="flex items-start">
          <svg class="w-5 h-5 mt-1 mr-3 text-[#009640]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
          </svg>
          <h2 class="text-[#010B1F] font-medium text-[14px] lgm:text-[20px] leading-tight">
            <?php the_field("блок_6_время_работы"); ?>
          </h2>
        </div>
      </div>
      
    </div>    
    
  </div>
</section>

<a href="#" class="inline-flex items-center justify-center rounded-full bg-[#39CB67] px-6 py-3 text-black font-medium js-open-trial" data-open="trial-modal">
  Записаться
</a>


<?php get_footer(); ?>
