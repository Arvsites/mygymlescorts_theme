<?php
function mygym_enqueue_scripts() {
    // Tailwind CSS (будет добавлен после настройки)
    wp_enqueue_style('tailwind', get_template_directory_uri() . '/dist/output.css', [], '1.0');
    wp_enqueue_style('custom-style', get_template_directory_uri() . '/style.css'); 
    // Alpine.js
    wp_enqueue_script('alpine', 'https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js', [], '3.x', true);
    wp_enqueue_script('menu-js', get_template_directory_uri() . '/assets/js/menu.js', [], null, true);
}
add_action('wp_enqueue_scripts', 'mygym_enqueue_scripts');


function mygym_register_menus() {
    register_nav_menus([
        'primary'      => __('Главное меню', 'mygym'),
        'social_menu'  => __('Соцсети (иконки)', 'mygym'),
    ]);
    add_theme_support('post-thumbnails');
    add_image_size('program-card', 620, 420, true); // ~3:2, жёсткий кроп
}
add_action('after_setup_theme', 'mygym_register_menus');

/* ===== ACF Schedule: шорткод [acf_schedule field="расписание"] ===== */
add_shortcode('acf_schedule', function($atts){
    $a = shortcode_atts([
      'field' => 'расписание', // имя textarea-поля ACF
      'title' => 'Расписание',  // заголовок над таблицей (optional)
    ], $atts, 'acf_schedule');
  
    if (!function_exists('get_field')) {
      return '<p style="color:#d33">ACF не установлен/активирован.</p>';
    }
  
    // 1) Берём сырой текст из ACF
    $raw = get_field($a['field'], get_the_ID());
    if (!$raw) return '<p>Нет данных расписания.</p>';
  
    // 2) Настройки (можно менять под себя)
    $days = []; // заголовки столбцов
    $colorMap = [
      'yellow' => '#FFEC45',
      'pink'   => '#F5B1B1',
      'violet' => '#C7B2F5',
      'green'  => '#A6EAC0',
      'lime'   => '#D8F4B0',
    ];
    $gridBg   = '#FFF8BC';
    $headBg   = '#FFF6A1';
    $textCol  = '#154092';
  
    // 3) Парсим строки вида [TIME; Пн; Вт; ...; Вс]
    //    Разделители между строками — запятые ИЛИ переносы строк.
    $norm = preg_replace('/\r\n?/', "\n", trim($raw));
    // удалим финальные "],"
    $norm = preg_replace('/\],\s*$/', ']', $norm);
    // нарежем по закрывающей скобке
    $chunks = preg_split('/\]\s*,?\s*\n|\]\s*,\s*/u', $norm);
  
    $rows = [];
    foreach ($chunks as $ch) {
      $ch = trim($ch);
      if ($ch === '') continue;
      $ch = trim($ch, "[] \t");
      // специальный случай: первая строка может быть заголовком вида [ВРЕМЯ; Пн; Вт; ...]
      if (preg_match('/^время/i', $ch)) {
        // если хотите — можно переопределить $days из ACF
        $parts = array_map('trim', explode(';', $ch));
        if (count($parts) >= 8) {
          $days = array_slice($parts, 1, 7);
        }
        continue;
      }
      $parts = array_map('trim', explode(';', $ch));
      if (count($parts) < 8) $parts = array_pad($parts, 8, '');
      if (count($parts) > 8) $parts = array_slice($parts, 0, 8);
      $rows[] = $parts; // [time, d1..d7]
    }
    if (!$rows) return '<p>Формат не распознан.</p>';
  
    // 4) Рендер таблицы с поддержкой @rowN и @colN и цветов @yellow/@#HEX
    $gridBusy = []; // gridBusy[row][col] = true — занята rowspan/colspan
  
    ob_start(); ?>
    <style>
        /* Обёртка таблицы: горизонтальный скролл ТОЛЬКО тут */
        .acf-sched{
            display:block;
            overflow-x:auto;      /* только по X */
            overflow-y:hidden;    /* исключаем вертикальные вложенные скроллы */
            -webkit-overflow-scrolling:touch; /* инерция в iOS */
            touch-action:pan-x;   /* жесты по горизонтали остаются тут, вертикаль уходит родителю */
            overscroll-behavior-x:contain; /* не «дергаем» страницу при долистывании */
        }

        .acf-sched table{
            width:100%;
            min-width: 920px;     /* чтобы на мобильном был запас и появилась горизонтальная полоса */
            border-collapse:separate;border-spacing:12px;
        }

        .acf-sched th,.acf-sched td{
            padding:10px;border-radius:12px;text-align:center;font-weight:700;color:<?= esc_attr($textCol) ?>;
            white-space:nowrap;   /* компактнее в узких колонках */
        }

        .acf-sched thead th{position:sticky;top:0;background:<?= esc_attr($headBg) ?>;z-index:1}
        .acf-sched .time{background:transparent;font-weight:600;white-space:nowrap}

        .acf-sched .empty{background:<?= esc_attr($gridBg) ?>;color:transparent}
    </style>    
  
    <div class="acf-sched">
      <table>
        <?php if (!empty($a['title'])): ?>
          <caption style="caption-side:top;text-align:left;font-weight:800;margin:0 0 8px;color:<?= esc_attr($textCol) ?>;">
            <?= esc_html($a['title']) ?>
          </caption>
        <?php endif; ?>
        <thead>
          <tr>
            
            <?php foreach ($days as $d): ?>
              <th scope="col"><?= esc_html($d) ?></th>
            <?php endforeach; ?>
          </tr>
        </thead>
        <tbody>
        <?php foreach ($rows as $rIdx => $parts):
          [$time,$c1,$c2,$c3,$c4,$c5,$c6,$c7] = $parts;
          $cells = [$c1,$c2,$c3,$c4,$c5,$c6,$c7]; ?>
          <tr>
            <th scope="row" class="time"><?= esc_html($time) ?></th>
            <?php for ($dIdx=0;$dIdx<7;$dIdx++):
              if (!empty($gridBusy[$rIdx][$dIdx])) continue;
  
              $rawCell = trim($cells[$dIdx]);
              if ($rawCell === '') { echo '<td class="empty">&nbsp;</td>'; continue; }
  
              // Парсим метки: @yellow / @#HEX / @rowN / @colN (порядок любой)
                $bg = null; 
                $rowspan = 1; 
                $colspan = 1; 
                $txt = $rawCell;

                // 1) Сначала вытащим rowspan/colspan
                if (preg_match('/@row(\d+)/i', $rawCell, $m)) {
                $rowspan = max(1, (int)$m[1]);
                }
                if (preg_match('/@col(\d+)/i', $rawCell, $m)) {
                $colspan = max(1, (int)$m[1]);
                }

                // 2) Цвет: поддержка @yellow|@pink|... и @#RRGGBB
                if (preg_match_all('/@(?:#[0-9A-Fa-f]{6}|[a-z]+)/u', $rawCell, $m)) {
                foreach ($m[0] as $full) {
                    $tag = strtolower(ltrim($full, '@'));
                    if ($tag === 'row' || $tag === 'col') continue; // пропускаем служебные
                    if (isset($colorMap[$tag])) {
                    $bg = $colorMap[$tag];
                    } elseif (preg_match('/^#[0-9A-Fa-f]{6}$/', $tag)) {
                    $bg = $tag;
                    }
                }
                }

                // 3) Удаляем все метки из текста (важно: row/col с числами — первыми)
                $txt = preg_replace('/@(?:row\d+|col\d+|#[0-9A-Fa-f]{6}|[a-z]+)/iu', '', $rawCell);
                $txt = trim($txt);

  
              // Пометить занятость «под» rowspan/colspan
              if ($rowspan>1 || $colspan>1) {
                for ($ri=1; $ri<$rowspan; $ri++) {
                  for ($ci=0; $ci<$colspan; $ci++) {
                    $gridBusy[$rIdx+$ri][$dIdx+$ci] = true;
                  }
                }
              }
  
              $attrs = [];
              if ($rowspan>1) $attrs[] = 'rowspan="'.$rowspan.'"';
              if ($colspan>1) $attrs[] = 'colspan="'.$colspan.'"';
              $style = 'background:'.esc_attr($bg ?: $gridBg);
              $attrs[] = 'style="'.$style.'"';
  
              echo '<td '.implode(' ', $attrs).'>'.esc_html($txt).'</td>';
  
              if ($colspan>1) $dIdx += ($colspan-1);
            endfor; ?>
          </tr>
        <?php endforeach; ?>
        </tbody>
      </table>
    </div>
    <?php
    return ob_get_clean();
  });
  
  


add_action('wp_enqueue_scripts', function () {
  wp_enqueue_script(
    'trial-modal',
    get_template_directory_uri() . '/assets/js/trial-modal.js',
    [],
    '1.0.0',
    true
  );
  // Тексты и параметры для JS (Polylang support)
  $ok  = function_exists('pll__') ? pll__('Спасибо! Мы свяжемся с вами в ближайшее время.') : 'Спасибо! Мы свяжемся с вами в ближайшее время.';
  $err = function_exists('pll__') ? pll__('Ошибка отправки. Попробуйте позже.') : 'Ошибка отправки. Попробуйте позже.';
  wp_localize_script('trial-modal', 'MyGymTrial', [
    'ajax_url' => admin_url('admin-ajax.php'),
    'nonce'    => wp_create_nonce('mygym_trial_nonce'),
    'okText'   => $ok,
    'errText'  => $err,
  ]);
});

add_action('wp_ajax_mygym_send_trial',     'mygym_send_trial');
add_action('wp_ajax_nopriv_mygym_send_trial', 'mygym_send_trial');
function mygym_send_trial() {
  // Проверка nonce
  if (!isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'mygym_trial_nonce')) {
    wp_send_json_error(['message' => 'bad_nonce'], 400);
  }
  // Простейший honeypot антиспам
  if (!empty($_POST['website'])) {
    wp_send_json_error(['message' => 'spam'], 400);
  }
  // Данные
  $name    = sanitize_text_field($_POST['name'] ?? '');
  $phone   = sanitize_text_field($_POST['phone'] ?? '');
  $email   = sanitize_email($_POST['email'] ?? '');
  $message = sanitize_textarea_field($_POST['message'] ?? '');
  if ($name === '' || $phone === '' || !is_email($email)) {
    wp_send_json_error(['message' => 'validation'], 400);
  }
  // Куда отправлять
  $to = get_option('alexejvaleev@mail.ru'); // можно заменить на нужный email
  $subject = 'Новая заявка с сайта: ' . wp_specialchars_decode(get_bloginfo('name'), ENT_QUOTES);
  $body = "Имя: {$name}\nТелефон: {$phone}\nEmail: {$email}\nСообщение: {$message}\nСтраница: " . (wp_get_referer() ?: home_url()) . "\n";
  $headers = [ 'Content-Type: text/plain; charset=UTF-8', 'Reply-To: ' . $name . ' <' . $email . '>', ];
  $sent = wp_mail($to, $subject, $body, $headers);
  if ($sent) {
    wp_send_json_success(['message' => 'ok']);
  } else {
    wp_send_json_error(['message' => 'mail_failed'], 500);
  }
}

?>

