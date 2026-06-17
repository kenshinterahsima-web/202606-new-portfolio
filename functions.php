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

    // JS
    wp_enqueue_script('theme-main', $uri . '/assets/js/main.js', [], filemtime($dir . '/assets/js/main.js'), true);
    wp_localize_script('theme-main', 'themeAjax', ['ajaxurl' => admin_url('admin-ajax.php')]);
}
add_action('wp_enqueue_scripts', 'theme_enqueue_assets');


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
