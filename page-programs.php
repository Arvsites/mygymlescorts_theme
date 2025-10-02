<?php
/* Template Name: programas */
get_header();
?>

<!-- Блок 1: Вступление -->
<section class="mt-16 w-full bg-[#FEED00] relative overflow-hidden">
  <div class="max-w-[1440px] mx-auto flex flex-col lgm:flex-row items-stretch">
    
    <!-- Правая картинка -->
    <div class="lgm:min-h-[300px] w-auto lgm:w-[60%] h-auto lgm:order-2 lgm:ml-auto bleed-right">
      <img src="<?= get_template_directory_uri(); ?>/assets/programs/1-2.webp"
          alt="дети на занятии"
          class="hidden lgm:block w-full h-full object-cover" />
      <img src="<?= get_template_directory_uri(); ?>/assets/programs/1-2m.webp"
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
      <div class="relative z-10 lgm:mt-[160px]">
        <h2 class="text-[#154092] font-bold text-[36px] lgm:text-[45px] leading-tight mb-4">
        <?php the_field("1_заголовок"); ?>
        </h2>        
      </div>

    </div>
  </div>
</section>

<!-- Блок 2: Программы -->
<section class="w-full bg-[#DFFFED] relative overflow-hidden">
  <div class="max-w-[1440px] mx-auto my-[0px] lgm:my-[90px] px-10 lgm:px-[70px]">

    <div class="grid grid-cols-1 gap-6 lgm:gap-8 items-stretch">
      <?php for ($i = 1; $i <= 6; $i++) : ?>
        <?php
        $template_uri = get_template_directory_uri();
        $src_d = "{$template_uri}/assets/programs/3-{$i}.webp";
        $src_m = "{$template_uri}/assets/programs/3-{$i}m.webp";

        $desktop_file = get_template_directory() . "/assets/programs/3-{$i}.webp";
        $mobile_file  = get_template_directory() . "/assets/programs/3-{$i}m.webp";
        if (!file_exists($mobile_file)) $src_m = $src_d;

        $alt = get_field(($i + 1) . '_заголовок') ?: "Программа " . ($i + 1);

        $btn_field = get_field("кнопка_ссылка");
        $btn_url = ''; $btn_tgt = '_self'; $btn_acf_title = '';
        if (is_array($btn_field)) {
          $btn_url = $btn_field['url'] ?? '';
          $btn_tgt = $btn_field['target'] ?? '_self';
          $btn_acf_title = $btn_field['title'] ?? '';
        } elseif (is_string($btn_field)) {
          $btn_url = $btn_field;
        }
        $btn_txt = get_field("кнопка") ?: (!empty($btn_acf_title) ? $btn_acf_title : 'Подробнее');

        // Перестановка для 2,4,6
        $reverse = in_array($i, [2,4,6], true);
        $img_order  = $reverse ? 'lgm:order-2' : 'lgm:order-1';
        $text_order = $reverse ? 'lgm:order-1' : 'lgm:order-2';

        // Прижатие изображения к нужному краю
        $obj_align = $reverse ? 'object-right' : 'object-left';          // позиционирование "содержимого" внутри img
        $justify   = $reverse ? 'justify-end'  : 'justify-start';        // прижать сам элемент img к краю колонки
        ?>

        <article class="lgm:h-[450px] lgm:bg-white rounded-[20px] lgm:shadow-[0_6px_20px_rgba(0,0,0,0.12)] overflow-hidden flex flex-col">
          <!-- Ровно 50/50 на lgm и шире -->
          <div class="grid grid-cols-1 lgm:grid-cols-2 h-full min-h-0">

            <!-- Картинка: на всю высоту, целиком видна, прижата к нужному краю -->
            <?php if (file_exists($desktop_file)): ?>
              <div class="<?= $img_order; ?> h-full min-h-0 flex items-stretch <?= $justify; ?>">
                <picture class="block h-full">
                  <source media="(min-width: 1150px)" srcset="<?= esc_url($src_d); ?>">
                  <img
                    src="<?= esc_url($src_m); ?>"
                    alt="<?= esc_attr($alt); ?>"
                    class="block w-auto h-full object-contain <?= $obj_align; ?>" />
                </picture>
              </div>
            <?php endif; ?>

            <!-- Контент: текст прокручивается при переполнении, чтобы не сжимать картинку -->
            <div class="p-5 lgm:p-6 flex flex-col <?= $text_order; ?> min-h-0">
              <div class="flex-1 min-h-0 overflow-y-auto">
                <h3 class="text-[#154092] font-bold text-[18px] lgm:text-[20px] leading-snug mb-3 min-h-[48px]">
                  <?php the_field(($i + 1) . '_заголовок'); ?>
                </h3>

                <div class="text-[#424242] text-[14px] leading-relaxed">
                  <?php the_field(($i + 1) . '_текст'); ?>
                </div>

                <div class="my-2 program-desc text-[#424242] text-[14px] leading-relaxed">
                  <?php the_field(($i + 1) . '_список'); ?>
                </div>

                <div class="text-[#424242] text-[14px] leading-relaxed">
                  <?php the_field(($i + 1) . '_текст2'); ?>
                </div>
              </div>

              <?php if ($btn_url): ?>
                <a href="<?= esc_url($btn_url); ?>" target="<?= esc_attr($btn_tgt); ?>"
                   class="mx-auto lgm:mx-0 mt-5 inline-block px-6 self-start py-2 bg-[#00963F] text-white rounded-[20px] font-medium hover:text-[#153F93] hover:bg-[#FEED00] transition">
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


<!-- Блок 3: Запись -->
<section class="w-full bg-[#153F93] relative overflow-hidden">
  <div class="max-w-[1440px] mx-auto flex flex-col lgm:flex-row items-stretch lgm:min-h-[500px]">
    
    <!-- Левая картинка -->
    <div class="w-full lgm:w-auto lgm:flex-1 lgm:min-w-0 h-auto lgm:h-[500px] lgm:absolute lgm:left-0 lgm:top-0 lgm:bottom-0 order-1 lgm:order-none">
      <img src="<?= get_template_directory_uri(); ?>/assets/programs/8-1.webp"
           alt="занятие"
           class="hidden lgm:block w-auto h-full object-cover" />
      <img src="<?= get_template_directory_uri(); ?>/assets/programs/8-1m.webp"
           alt="занятие"
           class="lgm:hidden w-full h-full object-cover" />
    </div>

    <!-- Правая текстовая часть -->
    <div class="w-full lgm:w-[58%] lgm:ml-auto pl-10 lgm:pl-[115px] py-10 lgm:py-0 flex flex-col justify-center relative z-10 lgm:min-h-[300px] order-2 lgm:order-none">
      
      <!-- Кубики -->
      <img src="<?= get_template_directory_uri(); ?>/assets/programs/8-2.webp"
           alt="кубики"
           class="w-[80px] lgm:w-[160px] h-auto mb-4 lgm:absolute lgm:top-[20%] lgm:mb-0 z-0" />
                 
      <!-- Заголовок -->
      <div class="relative z-30 lgm:mt-[160px]">
        <h2 class="text-white font-bold text-[36px] lgm:text-[50px] leading-tight mb-4">
          <?php the_field("8_заголовок"); ?>
        </h2>
      </div>

  

      <!-- Кнопка -->
      <?php
      $btn = [
        'url'    => get_field('8_кнопка_ссылка'),
        'title'  => get_field('8_кнопка'),
      ];
      $btn_url = isset($btn['url']) ? trim((string)$btn['url']) : '';
      $btn_txt = isset($btn['title']) ? trim((string)$btn['title']) : '';
      ?>

      <?php if (!empty($btn_url) && !empty($btn_txt)): ?>
        <a href="<?= esc_url($btn_url); ?>"
          class="mx-auto lgm:mx-0 mt-5 inline-block px-6 self-start py-2 bg-[#E30713] text-white rounded-[20px] font-medium hover:bg-[#00963F] transition">
          <?= esc_html($btn_txt); ?>
        </a>
      <?php endif; ?>

    </div>
  </div>
</section>

<?php get_footer(); ?>
