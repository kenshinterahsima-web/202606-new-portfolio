<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php
    $site_name = get_bloginfo('name');
    $site_desc = get_bloginfo('description');

    if (is_front_page()) {
        $page_title = $site_name . ($site_desc ? ' | ' . $site_desc : '');
        $meta_desc  = $site_desc;
        $og_type    = 'website';
        $canonical  = home_url('/');
    } elseif (is_singular()) {
        global $post;
        $excerpt    = $post->post_excerpt ?: wp_trim_words(strip_tags($post->post_content), 50, '');
        $page_title = get_the_title() . ' | ' . $site_name;
        $meta_desc  = $excerpt ?: $site_desc;
        $og_type    = is_single() ? 'article' : 'website';
        $canonical  = get_permalink();
    } else {
        $page_title = get_the_archive_title() . ' | ' . $site_name;
        $meta_desc  = $site_desc;
        $og_type    = 'website';
        global $wp;
        $canonical  = user_trailingslashit(home_url($wp->request));
    }

    $og_image = get_template_directory_uri() . '/assets/images/ogp.png';
    ?>

    <title><?php echo esc_html($page_title); ?></title>
    <meta name="description" content="<?php echo esc_attr($meta_desc); ?>">
    <meta name="robots" content="<?php echo (is_404() || is_page('thanks')) ? 'noindex, nofollow' : 'index, follow'; ?>">
    <?php if (!is_404()) : ?>
    <link rel="canonical" href="<?php echo esc_url($canonical); ?>">
    <?php endif; ?>

    <!-- OGP -->
    <meta property="og:title"       content="<?php echo esc_attr($page_title); ?>">
    <meta property="og:type"        content="<?php echo esc_attr($og_type); ?>">
    <meta property="og:url"         content="<?php echo esc_url($canonical); ?>">
    <meta property="og:image"       content="<?php echo esc_url($og_image); ?>">
    <meta property="og:site_name"   content="<?php echo esc_attr($site_name); ?>">
    <meta property="og:description" content="<?php echo esc_attr($meta_desc); ?>">
    <meta property="og:locale"      content="ja_JP">
    <meta name="twitter:card"       content="summary_large_image">

    <!-- Favicon -->
    <link rel="icon" type="image/jpeg" href="<?php echo get_template_directory_uri(); ?>/assets/images/favicon.jpg">

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<?php if (!is_front_page()) : ?>
<header class="header">
    <div class="header-inner">
        <div class="header-logo">
            <a href="<?php echo home_url('/'); ?>">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/logo.svg" alt="<?php bloginfo('name'); ?>">
            </a>
        </div>

        <nav class="g-nav" id="gNav" aria-label="グローバルナビ">
            <ul class="g-nav-list">
                <li class="g-nav-item"><a href="<?php echo home_url('/about/'); ?>">About</a></li>
                <li class="g-nav-item"><a href="<?php echo home_url('/service/'); ?>">Service</a></li>
                <li class="g-nav-item"><a href="<?php echo home_url('/news/'); ?>">News</a></li>
                <li class="g-nav-item"><a href="<?php echo home_url('/company/'); ?>">Company</a></li>
            </ul>
            <div class="header-cta">
                <a href="<?php echo home_url('/contact/'); ?>" class="c-btn c-btn--primary">お問い合わせ</a>
            </div>
        </nav>

        <button class="burger" id="burger" aria-label="メニューを開閉" aria-expanded="false" aria-controls="mobileMenu">
            <span></span>
            <span></span>
            <span></span>
        </button>
    </div>
</header>

<div class="mobile-menu" id="mobileMenu" aria-hidden="true">
    <ul class="mobile-nav">
        <li><a href="<?php echo home_url('/about/'); ?>"><span>About</span><span>→</span></a></li>
        <li><a href="<?php echo home_url('/service/'); ?>"><span>Service</span><span>→</span></a></li>
        <li><a href="<?php echo home_url('/news/'); ?>"><span>News</span><span>→</span></a></li>
        <li><a href="<?php echo home_url('/company/'); ?>"><span>Company</span><span>→</span></a></li>
    </ul>
    <div class="mobile-cta">
        <a href="<?php echo home_url('/contact/'); ?>" class="c-btn c-btn--primary">お問い合わせ</a>
    </div>
</div>
<?php endif; ?>
