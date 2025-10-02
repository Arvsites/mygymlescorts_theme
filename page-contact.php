<?php
/* Template Name: contact */
get_header();
?>

<?php the_title(); ?>

<!-- Блок 1: Вступление -->
<section class="mt-14 w-full bg-[#00963F] relative overflow-hidden">
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
        <h2 class="text-white font-bold text-[36px] lgm:text-[45px] leading-tight mb-4">
        <?php the_field("блок_1"); ?>
        </h2>        
      </div>

    </div>
  </div>
</section>

<!-- Блок 2: Контактные данные -->
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
          <?php the_field("блок_5_заголовок"); ?>
        </h2>
      </div>

      

      <!-- Кнопка -->
      <?php
      $btn = [
        'url'    => get_field('блок_5_ссылка'),
        'title'  => get_field('блок_5_кнопка'),
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