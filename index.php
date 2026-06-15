<?php get_header(); ?>
<main style="padding-top: 7rem;">

    <div class="c-page-hero">
        <div class="inner">
            <span class="c-page-hero-label">News</span>
            <h1 class="c-page-hero-title">ニュース</h1>
        </div>
    </div>

    <section class="section">
        <div class="inner">
            <?php if (have_posts()) : ?>
            <div class="top-news-list">
                <?php while (have_posts()) : the_post(); ?>
                <a href="<?php the_permalink(); ?>" class="top-news-item js-reveal">
                    <span class="top-news-date"><?php echo get_the_date('Y.m.d'); ?></span>
                    <?php $cats = get_the_category(); if ($cats) : ?>
                    <span class="top-news-cat"><?php echo esc_html($cats[0]->name); ?></span>
                    <?php endif; ?>
                    <span class="top-news-title"><?php the_title(); ?></span>
                </a>
                <?php endwhile; ?>
            </div>

            <div style="margin-top:4rem;">
                <?php the_posts_pagination(['mid_size' => 2]); ?>
            </div>
            <?php else : ?>
            <p>投稿がありません。</p>
            <?php endif; ?>
        </div>
    </section>

</main>
<?php get_footer(); ?>
