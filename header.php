<?php
/**
 * Шапка темы.
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500&display=swap" rel="stylesheet">
  <?php wp_head(); ?>
</head>
<body <?php body_class('min-h-screen flex flex-col'); ?>>


<header id="site-header" class="fixed top-0 left-0 z-50 w-full bg-gradient-to-r from-[#6081C0] to-[#143F92] text-white">
  <!-- ПК версия -->
  <div class="w-full lg:pl-[40px] xl:pl-[115px] md:pl-auto pr-[135px] pt-[12px] hidden lg:block">
    <div id="header-row" class="flex items-center h-[100px]">
      
      <!-- ЛОГОТИП -->
      <div class="flex items-center w-[100px] shrink-0 min-w-[100px]">
        <a href="<?= esc_url(home_url()); ?>">
          <img src="<?= get_template_directory_uri(); ?>/assets/header/logo.svg" alt="Logo" class="logo-img object-contain">
        </a>
      </div>

      <!-- ОСНОВНОЙ КОНТЕНТ -->
      <div class="relative flex-col justify-between flex-1 h-full ml-[40px]">
        
        <!-- Верхняя строка -->
        <div class="flex justify-between items-center text-sm text-[#f7f9fe] font-semibold flex-1 h-1/2">      
          
          <!-- Адрес и телефон -->
          <div class="flex justify-center items-center gap-12 text-[16px] mx-auto">
            <div class="flex items-center gap-1">

              <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-[#f7f9fe]" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10 2a6 6 0 00-6 6c0 4.18 6 10 6 10s6-5.82 6-10a6 6 0 00-6-6zM8 8a2 2 0 114 0 2 2 0 01-4 0z" clip-rule="evenodd" />
              </svg>
              <span><a href="https://maps.app.goo.gl/4LZ3qDUTQWxK3YGc7" class="hover:text-white" target="_blank" rel="noopener noreferrer">Carrer de Breda, 11, Les Corts, 08029 Barcelona</a></span>
              
            </div>
            <div class="flex items-center gap-1">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-[#FEED00]" viewBox="0 0 24 24" fill="currentColor">
                <path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07 19.5 19.5 0 01-6-6A19.79 19.79 0 013.08 4.18 2 2 0 015.06 2h3a2 2 0 012 1.72c.12.81.3 1.6.54 2.36a2 2 0 01-.45 2.11L9 9a16 16 0 006 6l.81-.63a2 2 0 012.11-.45c.76.24 1.55.42 2.36.54a2 2 0 011.72 2.01z" />
              </svg>
              <span class="text-[#FEED00]">+</span>
            </div>
          </div>
          
          <!-- Флаги языков -->
          <div class="flex gap-2">
            <?php
            if ( function_exists( 'pll_the_languages' ) ) {
                $languages = pll_the_languages( [
                    'raw' => 1,          // получаем массив вместо HTML
                    'hide_if_empty' => 0,
                    'force_home' => 0    // остаёмся на текущей странице
                ] );

                // соответствие slugs → картинки
                $flags = [
                    'es' => 'flag-esp.png',
                    'en' => 'flag-eng.png',
                    'ca' => 'flag-cat.png', // у Polylang каталонский обычно "ca"
                    'ru' => 'flag-rus.png'
                ];

                foreach ( $languages as $slug => $lang ) {
                    if ( isset( $flags[$slug] ) ) {
                        echo '<a href="' . esc_url( $lang['url'] ) . '">';
                        echo '<img src="' . get_template_directory_uri() . '/assets/header/' . $flags[$slug] . '" alt="' . esc_attr( strtoupper($slug) ) . '" class="h-4">';
                        echo '</a>';
                    }
                }
            }
            ?>
          </div>

        </div>

        <!-- Линия -->
        <div class="absolute top-1/2 left-0 w-full h-[1px]" style="background: linear-gradient(to right,#538EFF 8%,#004CDD 19%,#004CDD 34%,#0058FF 50%);"></div>
        
        <!-- Меню -->
        <div class="relative w-full flex justify-end items-center h-1/2">

          <!-- Основное меню -->
          <nav id="main-menu"
              class="absolute top-full left-0 w-full bg-[#143F92] p-6 text-[20px] font-medium
                      hidden flex-col gap-4 transition-all duration-300
                      md:static md:flex md:flex-row md:bg-transparent md:p-0 md:justify-between md:h-10 md:items-center md:w-full md:text-[20px]">
                      <?php
                      if (function_exists('pll_current_language')) {
                        $lang = strtoupper(pll_current_language());
                        wp_nav_menu(array(
                          'theme_location' => 'primary',
                          'menu' => 'Main ' . $lang,
                          'container' => false,
                          'menu_class' => 'flex flex-col md:flex-row md:justify-between w-full gap-4 md:gap-[10px]',
                          'fallback_cb' => false,
                          'link_before' => '<span class="menu-link">', 
                          'link_after'  => '</span>',
                        ));
                      }
                      ?>

          </nav>
        </div>
        
      </div>
    </div>
  </div>

   <!-- Меню мобильной версии -->
  <div class="w-full px-6 py-2 flex flex-col gap-4 lg:hidden">
    <div class="flex justify-between items-center">

      <!-- Логотип -->
      <a href="<?= esc_url(home_url()); ?>">
        <img src="<?= get_template_directory_uri(); ?>/assets/header/logo-m1.svg" alt="Logo" class="pt-[10px] h-13">
      </a>

   
      <!-- Флаги языков -->
      <div class="flex gap-4 mt-1 z-50">
        <?php
        if ( function_exists( 'pll_the_languages' ) ) {
            $languages = pll_the_languages( [
                'raw' => 1,          // получаем массив вместо HTML
                'hide_if_empty' => 0,
                'force_home' => 0    // остаёмся на текущей странице
            ] );

            // соответствие slugs → картинки
            $flags = [
                'es' => 'flag-esp.png',
                'en' => 'flag-eng.png',
                'ca' => 'flag-cat.png', // у Polylang каталонский обычно "ca"
                'ru' => 'flag-rus.png'
            ];

            foreach ( $languages as $slug => $lang ) {
                if ( isset( $flags[$slug] ) ) {
                    echo '<a href="' . esc_url( $lang['url'] ) . '">';
                    echo '<img src="' . get_template_directory_uri() . '/assets/header/' . $flags[$slug] . '" alt="' . esc_attr( strtoupper($slug) ) . '" class="h-4">';
                    echo '</a>';
                }
            }
        }
        ?>
      </div>

      <!-- Кнопка-бургер -->
      <button id="burger" class="burger z-50 flex flex-col justify-between w-6 h-5 focus:outline-none">
        <span class="burger-line"></span>
        <span class="burger-line"></span>
        <span class="burger-line"></span>
      </button>
    </div>
  </div>

  <!-- Выпадающее меню мобильной версии -->
  <div id="menu-wrap" class="fixed top-0 left-0 w-full h-full bg-[#143F92] text-white text-[20px] hidden flex-col items-center justify-start z-30 pt-[0px] overflow-y-auto">
    <!-- Верхняя строка -->
    <div id="menu-header-fixed" class="sticky  pr-[100px] top-[0px] left-0 w-full bg-[#143F92] text-[#BCD3FF] text-sm font-light px-8 py-6 z-40 flex justify-between items-center">      
      <!-- Логотип -->
      <a href="<?= esc_url(home_url()); ?>">
        <img src="<?= get_template_directory_uri(); ?>/assets/header/logo-m2.svg" alt="Logo" class="h-10">
      </a>
    </div>

    <!-- Меню -->
    <div class="pt-0 w-full px-8 flex flex-col items-start gap-6 text-left">
      <!-- Список меню -->     
      <div class="w-full">  
        <?php
        if (function_exists('pll_current_language')) {
          $lang = strtoupper(pll_current_language());
          wp_nav_menu([
            'theme_location' => 'primary',
            'menu' => 'Main ' . $lang,
            'container' => false,
            'menu_class' => 'flex flex-col gap-4 text-left',
            'fallback_cb' => false
          ]);
        }
        ?>

        
       </div>

      <!-- Линия -->
      <div class="w-full h-[1px]" style="background: linear-gradient(to right,#538EFF 8%,#004CDD 19%,#004CDD 34%,#0058FF 50%);"></div>
 
      <!-- Контакты -->
      <div class="flex flex-col gap-2 text-[#BCD3FF] text-sm font-light">
        <!-- Телефон -->  
        <div class="flex items-center gap-1">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-[#BCD3FF]" viewBox="0 0 24 24" fill="currentColor">
            <path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07 19.5 19.5 0 01-6-6A19.79 19.79 0 013.08 4.18 2 2 0 015.06 2h3a2 2 0 012 1.72c.12.81.3 1.6.54 2.36a2 2 0 01-.45 2.11L9 9a16 16 0 006 6l.81-.63a2 2 0 012.11-.45c.76.24 1.55.42 2.36.54a2 2 0 011.72 2.01z" />
          </svg>
          <span>+</span>
        </div>

        <!-- Адрес -->
        <div class="flex items-center gap-1">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-[#BCD3FF]" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M10 2a6 6 0 00-6 6c0 4.18 6 10 6 10s6-5.82 6-10a6 6 0 00-6-6zM8 8a2 2 0 114 0 2 2 0 01-4 0z" clip-rule="evenodd" />
          </svg>
          <span><a href="https://maps.app.goo.gl/4LZ3qDUTQWxK3YGc7" class="hover:text-white" target="_blank" rel="noopener noreferrer">Carrer de Breda, 11, Les Corts, 08029 Barcelona</a></span>
           
        </div>
      </div>
    </div>

  </div>
  
</header>

<?php wp_body_open(); ?>
