<?php

// アイキャッチ画像を有効化
add_theme_support('post-thumbnails');

// 管理バーを非表示
add_filter('show_admin_bar', '__return_false');

// メニューを登録
register_nav_menus([
    'primary' => 'グローバルナビ',
    'footer'  => 'フッターナビ',
]);

function theme_enqueue_assets() {
    $uri = get_template_directory_uri();
    $dir = get_template_directory();

    // Google Fonts（不要ならコメントアウト）
    wp_enqueue_style('theme-fonts',
        'https://fonts.googleapis.com/css2?family=Inter:wght@400;700&family=Noto+Sans+JP:wght@400;500;700;900&display=swap',
        [], null
    );

    // スタイルシート（ページ共通）
    wp_enqueue_style('theme-index',     $uri . '/assets/css/index.css',     [], filemtime($dir . '/assets/css/index.css'));
    wp_enqueue_style('theme-component', $uri . '/assets/css/component.css', [], filemtime($dir . '/assets/css/component.css'));

    // フロントページ専用CSS
    if (is_front_page()) {
        wp_enqueue_style('theme-front-page', $uri . '/assets/css/front-page.css', [], filemtime($dir . '/assets/css/front-page.css'));
    }

    // 投稿ページ専用CSS
    if (is_single() || is_page()) {
        wp_enqueue_style('theme-single', $uri . '/assets/css/single.css', [], is_file($dir . '/assets/css/single.css') ? filemtime($dir . '/assets/css/single.css') : '1.0');
    }

    // 固定ページ個別CSS
    $page_slugs = ['about', 'service', 'company', 'contact', 'privacy-policy'];
    foreach ($page_slugs as $slug) {
        if (is_page($slug)) {
            $css_file = $dir . '/assets/css/' . $slug . '.css';
            wp_enqueue_style('theme-' . $slug, $uri . '/assets/css/' . $slug . '.css', [], filemtime($css_file));
        }
    }

    // JS
    wp_enqueue_script('theme-main', $uri . '/assets/js/main.js', [], filemtime($dir . '/assets/js/main.js'), true);
    wp_localize_script('theme-main', 'themeAjax', ['ajaxurl' => admin_url('admin-ajax.php')]);
}
add_action('wp_enqueue_scripts', 'theme_enqueue_assets');


// ============================================================
// AJAX：カテゴリフィルター（ニュース等で使う場合）
// ============================================================
function theme_filter_posts() {
    $cat_id = isset($_POST['cat_id']) ? intval($_POST['cat_id']) : 0;
    $args = [
        'post_type'      => 'post',
        'posts_per_page' => 10,
        'cat'            => $cat_id ?: 0,
    ];
    $query = new WP_Query($args);
    if ($query->have_posts()) :
        while ($query->have_posts()) : $query->the_post();
            get_template_part('template-parts/news-item');
        endwhile;
    endif;
    wp_die();
}
add_action('wp_ajax_filter_posts',        'theme_filter_posts');
add_action('wp_ajax_nopriv_filter_posts', 'theme_filter_posts');


// ============================================================
// カスタム投稿タイプ（必要に応じてコメントを外す）
// ============================================================
/*
function theme_register_post_types() {
    register_post_type('works', [
        'labels'      => ['name' => '実績', 'singular_name' => '実績'],
        'public'      => true,
        'has_archive' => true,
        'supports'    => ['title', 'editor', 'thumbnail', 'excerpt'],
        'menu_icon'   => 'dashicons-portfolio',
        'rewrite'     => ['slug' => 'works'],
    ]);
}
add_action('init', 'theme_register_post_types');
*/
