<?php get_header(); ?>
<main style="padding-top: 7rem;">

    <div class="c-page-hero">
        <div class="inner">
            <?php
            $cats = get_the_category();
            if ($cats) : ?>
            <span class="c-page-hero-label"><?php echo esc_html($cats[0]->name); ?></span>
            <?php endif; ?>
            <h1 class="c-page-hero-title"><?php the_title(); ?></h1>
            <p style="margin-top:1.6rem;font-size:1.3rem;color:rgba(255,255,255,0.5);"><?php echo get_the_date('Y.m.d'); ?></p>
        </div>
    </div>

    <article class="section">
        <div class="inner-sm">
            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <div class="entry-content">
                <?php the_content(); ?>
            </div>
            <?php endwhile; endif; ?>
        </div>
    </article>

</main>
<?php get_footer(); ?>
