<?php
/* Template Name: services */
get_header();
?>

<!-- Блок 1: Вступление -->
<section class="mt-16 w-full bg-[#00963F] relative overflow-hidden">
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
      <img src="<?= get_template_directory_uri(); ?>/assets/services/1-1.webp"
           alt="кубики"
           class="w-[180px] lgm:w-[190px] h-auto mb-4 lgm:absolute lgm:top-[20%]  lgm:mb-0 z-0" />
      

      <!-- Текст -->
      <div class="relative z-10 lgm:mt-[180px]">
        <h2 class="text-white font-bold text-[36px] lgm:text-[45px] leading-tight mb-4">
        <?php the_field("1_заголовок"); ?>
        </h2>        
      </div>

    </div>
  </div>
</section>


<!-- Блок 2: Программы -->
<section class="w-full bg-[#FFF8BC] relative overflow-hidden">
  <div class="max-w-[1440px] mx-auto my-[0px] lgm:my-[90px] px-10 lgm:px-[70px]">

    <div class="grid grid-cols-1 gap-6 lgm:gap-8 items-stretch">
      <?php for ($i = 1; $i <= 4; $i++) : ?>
        <?php
        // === IMG - берем из папки assets/services ===
        $template_uri = get_template_directory_uri();
        $src_d = "{$template_uri}/assets/services/2-{$i}.webp";
        $src_m = "{$template_uri}/assets/services/2-{$i}m.webp";
        // Проверяем существование файлов
        $desktop_file = get_template_directory() . "/assets/services/2-{$i}.webp";
        $mobile_file = get_template_directory() . "/assets/services/2-{$i}m.webp";
        // Если мобильной версии нет, используем десктопную
        if (!file_exists($mobile_file)) {
            $src_m = $src_d;
        }
        ?>
        <!-- Большие карточки -->
        <article class="bg-white rounded-[20px] shadow-[0_6px_20px_rgba(0,0,0,0.12)] overflow-hidden flex flex-col h-full">
          <!-- Шапка карточки -->
          <div class="grid grid-cols-1 lgm:grid-cols-[260px_1fr] h-full">

            <!-- Картинка из папки assets/services -->
            <?php if (file_exists($desktop_file)): ?>
              <div class="relative h-[220px] lgm:h-auto">
                <picture>
                  <source media="(min-width: 1150px)" srcset="<?= esc_url($src_d); ?>">
                  <img src="<?= esc_url($src_m); ?>" alt="<?= esc_attr($alt); ?>" class="absolute inset-0 w-full h-full object-cover" />
                </picture>
              </div>
            <?php endif; ?>
            <!-- Текст -->
            <div class="p-5 lgm:p-6 flex flex-col flex-grow">
              
              <h3 class="text-[#154092] font-bold text-[18px] lgm:text-[20px] leading-snug mb-3 min-h-[48px]">
                <?php the_field(($i) . '_б_заголовок'); ?>
              </h3>

              <div class="text-[#424242] text-[14px] leading-relaxed flex-1">
                <?php the_field(($i) . '_б_текст'); ?>
              </div>
            </div>

          </div>
          
          <div class="">
            <!-- Подзаголовок -->
            <div class="text-[#154092] text-[16px] text-center font-bold my-4">
              <?php the_field(($i) . '_б_подзаголовок'); ?>
            </div>
            <!-- Мини карточки -->
            <?php
              // например, римские числа
              $map = [1 => 'I', 2 => 'II', 3 => 'III', 4 => 'IV'];
              $n = $map[$i] ?? $i; // если не нашли в карте, используем число
            ?>
            <div class="grid grid-cols-1 md:grid-cols-2 lgm:grid-cols-3 gap-6 lgm:gap-8 items-stretch m-6">
              <?php for ($j = 1; $j <= 9; $j++) :
                $subtitle = get_field('подподзаголовок_' . $n . '_' . $j);
                $text     = get_field('текст_подподзаголовка_' . $n . '_' . $j);
                if ($subtitle || $text) : 
                $bg_color = ($i == 2 || $i == 4) ? 'bg-[#00963F]' : 'bg-[#153F93]';
              ?>
                
                <article class="p-4 <?= $bg_color; ?> rounded-[20px] shadow-[0_6px_20px_rgba(0,0,0,0.12)] overflow-hidden flex flex-col h-full">
                  <?php if ($subtitle): ?>
                    <div class="text-[#ffffff] text-[16px] font-semibold leading-relaxed flex-1">
                      <?= esc_html($subtitle); ?>
                    </div>
                  <?php endif; ?>

                  <?php if ($text): ?>
                    <div class="text-[#ffffff] text-[12px] leading-relaxed flex-1">
                      <?= esc_html($text); ?>
                    </div>
                  <?php endif; ?>
                </article>

                <?php endif; ?>
              <?php endfor; ?>
            </div>

            <!-- Кнопка -->
            <?php
              $btn = [
                'url'    => get_field('кнопка_карточки_ссылка_'.($i)),
                'title'  => get_field('кнопка_карточки'),
              ];
              $btn_url = isset($btn['url']) ? trim((string)$btn['url']) : '';
              $btn_txt = isset($btn['title']) ? trim((string)$btn['title']) : '';
            ?>
            <div class="mb-6 text-center">
              <?php if ($btn_url): ?>
                <a href="<?= esc_url($btn_url); ?>" target="<?= esc_attr($btn_tgt); ?>"
                  class="mt-5 inline-block px-6 py-2 bg-[#00963F] text-white rounded-[20px] font-medium hover:text-[#153F93] hover:bg-[#FEED00] transition mx-auto">
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
<section class="w-full bg-[#E30713] relative overflow-hidden">
  <div class="max-w-[1440px] mx-auto flex flex-col lgm:flex-row items-stretch lgm:min-h-[500px]">
    
    <!-- Левая картинка -->
    <div class="w-full lgm:w-auto lgm:flex-1 lgm:min-w-0 h-auto lgm:h-[500px] lgm:absolute lgm:left-0 lgm:top-0 lgm:bottom-0 order-1 lgm:order-none">
      <img src="<?= get_template_directory_uri(); ?>/assets/services/5-1.webp"
           alt="занятие"
           class="hidden lgm:block w-auto h-full object-cover" />
      <img src="<?= get_template_directory_uri(); ?>/assets/services/5-1m.webp"
           alt="занятие"
           class="lgm:hidden w-full h-full object-cover" />
    </div>

    <!-- Правая текстовая часть -->
    <div class="w-full lgm:w-[58%] lgm:ml-auto pl-10 lgm:pl-[115px] py-10 lgm:py-0 flex flex-col justify-center relative z-10 lgm:min-h-[300px] order-2 lgm:order-none">
      
      <!-- Кубики -->
      <img src="<?= get_template_directory_uri(); ?>/assets/services/5-2.webp"
           alt="кубики"
           class="w-[80px] lgm:w-[160px] h-auto mb-4 lgm:absolute lgm:top-[20%] lgm:mb-0 z-0" />
                 
      <!-- Заголовок -->
      <div class="relative z-30 lgm:mt-[160px]">
        <h2 class="text-white font-bold text-[36px] lgm:text-[50px] leading-tight mb-4">
          <?php the_field("5_заголовок"); ?>
        </h2>
      </div>

  

      <!-- Кнопка -->
      <?php
      $btn = [
        'url'    => get_field('5_кнопка_ссылка'),
        'title'  => get_field('5_кнопка'),
      ];
      $btn_url = isset($btn['url']) ? trim((string)$btn['url']) : '';
      $btn_txt = isset($btn['title']) ? trim((string)$btn['title']) : '';
      ?>

      <?php if (!empty($btn_url) && !empty($btn_txt)): ?>
        <a href="<?= esc_url($btn_url); ?>"
          class="mx-auto lgm:mx-0 mt-5 inline-block px-6 self-start py-2 bg-[#FEED00] text-[#153F93] hover:text-white rounded-[20px] font-medium hover:bg-[#00963F] transition">
          <?= esc_html($btn_txt); ?>
        </a>
      <?php endif; ?>

    </div>
  </div>
</section>

<?php get_footer(); ?>
