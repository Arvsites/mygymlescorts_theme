<?php
/* Template Name: prices */
get_header();
?>

<?php the_title(); ?>

<!-- Блок 1: Вступление -->
<section class="mt-14 w-full bg-[#153F93] relative overflow-hidden">
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

<!-- Блок 2: Стоимость -->
<section class="w-full bg-[#FFF8BC] relative overflow-hidden">
  <div class="max-w-[1440px] mx-auto my-[0px] lgm:my-[90px] px-10 lgm:px-[70px]">

    <!-- Подзаголовок 1 -->
    <div class="text-[#154092] text-[16px] text-center font-bold my-4">
      <?php the_field('заголовок_2'); ?>
    </div>
    <!-- Карточка 1 -->
    <div class="grid grid-cols-1 md:grid-cols-2 lgm:grid-cols-3 gap-6 lgm:gap-8 items-stretch m-6">
      <!-- блок 1 -->
        <?php for ($j = 1; $j <= 3; $j++) :
          $subtitle = get_field('подзаголовок_' . $j);
          $text     = get_field('стоимость_'. $j);
          $small_text = get_field( 'текст_'.$j );
          if ($subtitle || $text) : 
          $bg_color = ($j == 1) ? 'bg-[#E30713]' : 'bg-[#00963F]';
          $text_color = ($j == 1) ? 'text-[#E30713]' : 'text-[#153F93]';
        ?>
          <article class="bg-white rounded-[20px] shadow-[0_6px_20px_rgba(0,0,0,0.12)] overflow-hidden flex flex-col h-full">
            <?php if ($subtitle): ?>
              <div class="<?= $bg_color; ?> py-3 text-[#ffffff] text-[22px] text-center font-semibold leading-relaxed">
                <?= esc_html($subtitle); ?>
              </div>
            <?php endif; ?>
            
            <div class="h-[220px] flex flex-col items-center justify-center gap-1">
              <?php if ($text): ?>
                <div class="font-bold <?= $text_color ?> text-[20px] text-center leading-relaxed">
                  <?= esc_html($text); ?>
                </div>
                <div class="font-bold <?= $text_color ?> text-[16px] text-center leading-relaxed">
                  <?= esc_html($small_text); ?>
                </div>
              <?php endif; ?>

              <?php if ($j==3): ?>
                <!-- Линия -->
                <div class="px-12 w-auto h-[1px]" style="background: linear-gradient(to right,#538EFF 8%,#004CDD 19%,#004CDD 34%,#0058FF 50%);"></div>
                <div class="font-bold <?= $text_color ?> text-[20px] text-center leading-relaxed">
                  <?php the_field("стоимость_4"); ?>
                </div>
                <div class="font-bold <?= $text_color ?> text-[16px] text-center leading-relaxed">
                <?php the_field("текст_4"); ?>
                </div>
              <?php endif; ?>

            </div>

          </article>
          <?php endif; ?>
        <?php endfor; ?>   
      
    </div>      
    
    <!-- Подзаголовок 2 -->
    <div class="text-[#154092] text-[24px] text-center font-bold my-4">
      <?php the_field('заголовок_3'); ?>
    </div>
    <!-- Карточка 2 -->
    <div class="grid grid-cols-1 md:grid-cols-2 lgm:grid-cols-4 gap-6 lgm:gap-8 items-stretch m-6">
      <!-- блок 1 -->
        <?php for ($j = 4; $j <= 7; $j++) :
          $subtitle = get_field('подзаголовок_' . $j);
          $subsubtitle = get_field('под_подзаголовок_' . $j-3);
          $text     = get_field('стоимость_'. $j+1);
          $small_text = get_field( 'текст_'.$j+1);
          if ($subtitle || $text) : 
          $bg_color = ($j == 1) ? 'bg-[#E30713]' : 'bg-[#153F93]';
          $text_color = ($j == 1) ? 'text-[#E30713]' : 'text-[#153F93]';
        ?>
          <article class="bg-white rounded-[20px] shadow-[0_6px_20px_rgba(0,0,0,0.12)] overflow-hidden flex flex-col h-full">
            <?php if ($subtitle): ?>
              <div class="<?= $bg_color; ?> pt-3 text-[#ffffff] text-[22px] text-center font-semibold leading-relaxed">
                <?= esc_html($subtitle); ?>
              </div>
              <div class="<?= $bg_color; ?> pb-3 text-[#ffffff] text-[16px] text-center font-semibold leading-relaxed">
                <?= esc_html($subsubtitle); ?>
              </div>
            <?php endif; ?>
            
            <div class="h-[220px] flex flex-col items-center justify-center gap-1">
              <?php if ($text): ?>
                <div class="px-6 font-bold <?= $text_color ?> text-[24px] text-center leading-relaxed">
                  <?= esc_html($text); ?>
                </div>
                <div class="px-6 font-bold <?= $text_color ?> text-[16px] text-center leading-relaxed">
                  <?= esc_html($small_text); ?>
                </div>
              <?php endif; ?>

              <?php if ($j==3): ?>
                <!-- Линия -->
                <div class="px-12 w-auto h-[1px]" style="background: linear-gradient(to right,#538EFF 8%,#004CDD 19%,#004CDD 34%,#0058FF 50%);"></div>
                <div class="font-bold <?= $text_color ?> text-[20px] text-center leading-relaxed">
                  <?= esc_html($text); ?>
                </div>
                <div class="font-bold <?= $text_color ?> text-[16px] text-center leading-relaxed">
                  <?= esc_html($small_text); ?>
                </div>
              <?php endif; ?>

            </div>

          </article>
          <?php endif; ?>
        <?php endfor; ?>   
      
    </div>     

    <!-- Подзаголовок 3 -->
    <div class="text-[#154092] text-[24px] text-center font-bold my-4">
      <?php the_field('заголовок_4'); ?>
    </div>
    <!-- Карточка 3 -->
    <div class="grid grid-cols-1 md:grid-cols-2 lgm:grid-cols-3 gap-6 lgm:gap-8 items-stretch m-6">
      <!-- блок 1 -->
        <?php for ($j = 8; $j <= 10; $j++) :
          $subtitle = get_field('подзаголовок_' . $j);
          $text     = get_field('стоимость_'. $j+1);
          $small_text = get_field( 'текст_'.$j+1);
          if ($subtitle || $text) : 
          $bg_color = ($j == 1) ? 'bg-[#E30713]' : 'bg-[#00963F]';
          $text_color = ($j == 1) ? 'text-[#E30713]' : 'text-[#153F93]';
        ?>
          <article class="bg-white rounded-[20px] shadow-[0_6px_20px_rgba(0,0,0,0.12)] overflow-hidden flex flex-col h-full">
            <?php if ($subtitle): ?>
              <div class="<?= $bg_color; ?> py-3 text-[#ffffff] text-[22px] text-center font-semibold leading-relaxed">
                <?= esc_html($subtitle); ?>
              </div>
            <?php endif; ?>
            
            <div class="h-[220px] flex flex-col items-center justify-center gap-1">
              <?php if ($text): ?>
                <div class="px-6 font-bold <?= $text_color ?> text-[24px] text-center leading-relaxed">
                  <?= esc_html($text); ?>
                </div>
                <div class="px-6 font-bold <?= $text_color ?> text-[16px] text-center leading-relaxed">
                  <?= esc_html($small_text); ?>
                </div>
              <?php endif; ?>

              <?php if ($j==3): ?>
                <!-- Линия -->
                <div class="px-12 w-auto h-[1px]" style="background: linear-gradient(to right,#538EFF 8%,#004CDD 19%,#004CDD 34%,#0058FF 50%);"></div>
                <div class="font-bold <?= $text_color ?> text-[20px] text-center leading-relaxed">
                  <?= esc_html($text); ?>
                </div>
                <div class="font-bold <?= $text_color ?> text-[16px] text-center leading-relaxed">
                  <?= esc_html($small_text); ?>
                </div>
              <?php endif; ?>

            </div>

          </article>
          <?php endif; ?>
        <?php endfor; ?>   
      
    </div> 

    
    <!-- Карточка 4 -->
    <div class="grid grid-cols-1 md:grid-cols-2 lgm:grid-cols-3 gap-6 lgm:gap-8 items-stretch m-6">
      <!-- блок 1 -->
        <?php for ($j = 11; $j <= 13; $j++) :
          $subtitle = get_field('подзаголовок_' . $j);
          $text     = get_field('стоимость_'. $j+1);
          $small_text = get_field( 'текст_'.$j+1);
          if ($subtitle || $text) : 
          $bg_color = ($j == 1) ? 'bg-[#E30713]' : 'bg-[#153F93]';
          $text_color = ($j == 1) ? 'text-[#E30713]' : 'text-[#153F93]';
        ?>
          <!-- Подзаголовок 4 -->
          <div class='grid grid-cols-1'>
            <div class="min-h-[70px] text-[#154092] text-[24px] text-center font-bold my-4">
              <?php the_field('заголовок_'.$j-6); ?>
            </div>
            <article class="bg-white rounded-[20px] shadow-[0_6px_20px_rgba(0,0,0,0.12)] overflow-hidden flex flex-col h-full">
              <?php if ($subtitle): ?>
                <div class="<?= $bg_color; ?> py-3 text-[#ffffff] text-[22px] text-center font-semibold leading-relaxed">
                  <?= esc_html($subtitle); ?>
                </div>
              <?php endif; ?>
              
              <div class="h-[180px] flex flex-col items-center justify-center gap-1">
                <?php if ($text): ?>
                  <div class="font-bold <?= $text_color ?> text-[24px] text-center leading-relaxed">
                    <?= esc_html($text); ?>
                  </div>
                  <div class="font-bold <?= $text_color ?> text-[16px] text-center leading-relaxed">
                    <?= esc_html($small_text); ?>
                  </div>
                <?php endif; ?>
              </div>

            </article>
          </div>
          <?php endif; ?>
        <?php endfor; ?>   
      
    </div> 
      

      
  </div>
</section>

<!-- Блок 3: Запись -->
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
      
      <!-- Кубики -->
      <img src="<?= get_template_directory_uri(); ?>/assets/main/5-2.webp"
           alt="кубики"
           class="w-[80px] lgm:w-[160px] h-auto mb-4 lgm:absolute lgm:top-[20%] lgm:mb-0 z-0" />
      
      <!-- Заголовок -->
      <div class="relative z-10 lgm:mt-[160px]">
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
           class="mx-auto lgm:mx-0 mt-5 inline-block px-6 self-start py-2 bg-[#FEED00] text-[#153F93] rounded-[20px] font-medium hover:text-[#ffffff] hover:bg-[#153F93] transition">
          <?= esc_html($btn_txt); ?>
        </a>
      <?php endif; ?>

    </div>
  </div>
</section>


<?php get_footer(); ?>