<?php
/* Template Name: trainers */
get_header();
?>

<?php the_title(); ?>

<!-- Блок 1: Вступление -->
<section class="mt-14 w-full bg-[#00963F] relative overflow-hidden">
  <div class="max-w-[1440px] mx-auto flex flex-col lgm:flex-row items-stretch">
    
    <!-- Правая картинка -->
    <div class="lgm:min-h-[300px] w-auto lgm:w-[60%] h-auto lgm:order-2 lgm:ml-auto bleed-right">
      <img src="<?= get_template_directory_uri(); ?>/assets/prices/1-2.webp"
          alt="дети на занятии"
          class="hidden lgm:block w-full h-full object-cover" />
      <img src="<?= get_template_directory_uri(); ?>/assets/prices/1-2m.webp"
          alt="дети на занятии"
          class="lgm:hidden w-full h-full object-cover" />
    </div>

    <!-- Левая текстовая часть -->
    <div class="w-full lgm:w-[60%] pl-10 lgm:pl-[115px] py-10 lgm:py-0 flex flex-col justify-center relative z-10">
      
      <!-- Кубики -->
      <img src="<?= get_template_directory_uri(); ?>/assets/prices/1-1.webp"
           alt="кубики"
           class="w-[180px] lgm:w-[190px] h-auto mb-4 lgm:absolute lgm:top-[20%]  lgm:mb-0 z-0" />
      

      <!-- Текст -->
      <div class="relative z-10 lgm:mt-[180px]">
        <h2 class="text-white font-bold text-[36px] lgm:text-[45px] leading-tight mb-4">
        <?php the_field("заголовок_1"); ?>
        </h2>        
      </div>

    </div>
  </div>
</section>


<!-- Блок 2: Наша команда -->
<section class="w-full bg-[#FFF8BC] relative overflow-hidden">
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
        <?php the_field("заголовок_2"); ?>
      </h2>
    </div>

  </div>
</section>


<!-- Блок 3: Почему мы -->
<section class="w-full bg-[#DFFFED]">
  <div class="max-w-[1440px] mx-auto px-10 lgm:px-[70px] my-[0px] lgm:my-[90px]">
    <div class="grid grid-cols-1 lgm:grid-cols-2 gap-x-10 lgm:gap-16 items-start">
        <?php for ($i = 1; $i <= 4; $i++): ?>
            <div class="my-6 flex flex-col items-center text-center">

                <!-- Кубик -->
                <div class="relative w-[150px] h-[150px] lgm:w-[180px] lgm:h-[180px]">
                    <img src="<?= get_template_directory_uri(); ?>/assets/prices/1-1.webp"
                        alt="кубик"
                        class="w-full h-full object-cover" />
                </div>

                <!-- Текст -->
                <p class="mt-2 max-w-[380px] font-bold text-[20px] lgm:text-[20px] text-[#004E21] leading-snug">
                    <?php the_field("подзаголовок_".$i); ?>
                </p>
                <p class="mt-4 max-w-[380px] font-middle text-[18px] lgm:text-[18px] text-[#424242] leading-snug">
                    <?php the_field("текст_".$i); ?>
                </p>

            </div>
        <?php endfor; ?>
    </div>

  </div>
</section>


<!-- Блок 4: Каждый тренер -->
<section class="w-full bg-[#FFF8BC] relative overflow-hidden">
  <div class="max-w-[1440px] mx-auto my-[0px] lgm:my-[90px] px-10 lgm:px-[70px]">
    <!-- Большие карточки -->
    <article class="mx-16 overflow-hidden flex flex-col h-full">
        <!-- Подзаголовок -->
        <div class="text-[#154092] text-[26px] text-center font-bold my-4">
            <?php the_field('заголовок_3'); ?>
        </div>
        <!-- Мини карточки -->
        <div class="grid grid-cols-1 md:grid-cols-2 lgm:grid-cols-2 gap-6 lgm:gap-8 items-stretch m-6">
            <?php for ($j = 5; $j <= 8; $j++) :
            $subtitle = get_field('подзаголовок_' . $j);
            if ($subtitle || $text) : 
            $bg_color = ($i == 2 || $i == 4) ? 'bg-[#00963F]' : 'bg-[#153F93]';
            ?>
            
            <article class="p-4 <?= $bg_color; ?> rounded-[20px] shadow-[0_6px_20px_rgba(0,0,0,0.12)] overflow-hidden flex flex-col h-full">
                <?php if ($subtitle): ?>
                <div class="text-[#ffffff] text-[16px] font-semibold leading-relaxed flex-1">
                    <?= esc_html($subtitle); ?>
                </div>
                <?php endif; ?>
            </article>

            <?php endif; ?>
            <?php endfor; ?>
        </div>
    </article>
  </div>
</section>


<!-- Блок 5-8: О нас -->
    <?php for ($j = 1; $j <= 3; $j++) :
        $subtitle = get_field('подзаголовок_' . $j);
        if ($subtitle) : 
        $bg_color = ($j == 2 ) ? 'bg-[#FFF8BC]' : 'bg-[#DFFFED]';
    ?>
        <section class="w-full <?= $bg_color; ?>  relative overflow-hidden">
            <!-- Текстовая часть -->
            <div class="w-full flex flex-col justify-center  my-[0px] mt-[50px]">
                <h2 class="text-[#154092] text-center font-bold text-[28px] lgm:text-[36px] leading-snug">
                    <?php the_field("заголовок_".$j+4); ?>
                </h2>
            </div>
            <div class="max-w-[1440px] mx-auto flex flex-col lgm:flex-row items-center lgm:items-stretch px-10 lgm:px-[70px] mb-14">    
                <!-- Левая картинка -->
                <div class="w-full lgm:w-1/2 flex justify-center lgm:justify-start">
                <img src="<?= get_template_directory_uri(); ?>/assets/main/2-1.webp"
                    alt="дети с кубиками"
                    class="mb-14 lgm:mb-0 w-full max-w-[460px] h-auto object-contain rounded-[40px] lgm:rounded-[60px]" />
                </div>
                <!-- Правая текстовая часть -->
                <div class="w-full lgm:w-1/2 flex flex-col justify-center">
                    <p class="text-[#424242] font-medium text-[14px] lgm:text-[18px] leading-relaxed max-w-[600px]">
                        <?php the_field("текст_".$j+4); ?>
                    </p>
                </div>
            </div>
        </section>

        <?php endif; ?>  
    <?php endfor; ?>


<!-- Блок 8: Запись -->
<section class="w-full bg-[#00963F] relative overflow-hidden">
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

      <!-- Заголовок 1 -->
      <div class="relative z-10 lgm:mt-[0px]">
        <h2 class="text-[#ffffff] font-bold text-[36px] lgm:text-[50px] leading-tight mb-4">
          <?php the_field("заголовок_7"); ?>
        </h2>
      </div>
      <!-- Текст -->
      <div class="relative z-10 lgm:mt-[10px]">
        <h2 class="text-[#ffffff] font-bold text-[15px] lgm:text-[20px] leading-tight mb-4">
          <?php the_field("текст_8"); ?>
        </h2>
      </div>
      <!-- Заголовок 2 -->
      <div class="relative z-10 lgm:mt-[10px]">
        <h2 class="text-[#ffffff] font-bold text-[36px] lgm:text-[50px] leading-tight mb-4">
          <?php the_field("заголовок_8"); ?>
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
           class="mx-auto lgm:mx-0 mt-5 inline-block px-6 self-start py-2 bg-[#FEED00] text-[#153F93] rounded-[20px] font-medium hover:text-[#ffffff] hover:bg-[#E30713] transition">
          <?= esc_html($btn_txt); ?>
        </a>
      <?php endif; ?>

    </div>
  </div>
</section>


<?php get_footer(); ?>