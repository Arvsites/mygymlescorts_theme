<?php
/* Template Name: schedule */
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

<!-- Блок 2: Расписание -->
<div class="max-w-[1200px] lg:mx-auto pl-10 py-10">
  <!-- ВЫВОДИТ ТА САМУЮ ТАБЛИЦУ ИЗ РЕДАКТОРА -->
  <div class="schedule-wrap">
    <?php echo do_shortcode('[acf_schedule field="расписание" title=""]'); ?>
  </div>

  <script>
    (function(){
      var wrap = document.querySelector('.schedule-wrap');
      if (!wrap) return;

      var scroller = wrap.querySelector('.acf-sched');
      var tableEl  = scroller ? scroller.querySelector('table') : null; // ВАЖНО: внутренняя таблица
      var xbar     = wrap.querySelector('.acf-sched-xbar');
      if (!scroller || !tableEl || !xbar) return;

      var spacer = xbar.querySelector('.spacer');

      function syncWidth(){
        // ширина дорожки = фактическая ширина СОДЕРЖИМОГО (таблицы)
        spacer.style.width = tableEl.scrollWidth + 'px';
        xbar.scrollLeft = scroller.scrollLeft;
      }

      // двусторонняя синхронизация
      var lock = false;
      scroller.addEventListener('scroll', function(){
        if (lock) return; lock = true;
        xbar.scrollLeft = scroller.scrollLeft;
        lock = false;
      });
      xbar.addEventListener('scroll', function(){
        if (lock) return; lock = true;
        scroller.scrollLeft = xbar.scrollLeft;
        lock = false;
      });

      // Пересчитать после загрузки и на ресайзе
      window.addEventListener('load', syncWidth);
      window.addEventListener('resize', syncWidth);
      // На случай, если контент таблицы доотрисуется чуть позже
      setTimeout(syncWidth, 0);
    })();

    (function(){
      var sc = document.querySelector('.schedule-wrap .acf-sched');
      if (!sc) return;

      var down=false, sx=0, sl=0;

      sc.addEventListener('mousedown', function(e){
        down=true; sx=e.pageX; sl=sc.scrollLeft;
        sc.classList.add('grabbing');
        sc.style.cursor='grabbing';
      });

      function up(){ down=false; sc.classList.remove('grabbing'); sc.style.cursor='grab'; }
      document.addEventListener('mouseup', up);
      document.addEventListener('mouseleave', up);

      sc.addEventListener('mousemove', function(e){
        if(!down) return;
        e.preventDefault();
        sc.scrollLeft = sl - (e.pageX - sx);
      });

      sc.addEventListener('dragstart', function(e){ e.preventDefault(); });

      // На колёсике с Shift — горизонталь
      sc.addEventListener('wheel', function(e){
        if (e.shiftKey && Math.abs(e.deltaY) > Math.abs(e.deltaX)) {
          sc.scrollLeft += e.deltaY;
          e.preventDefault();
        }
      }, { passive:false });
    })();
  </script>


</div>

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