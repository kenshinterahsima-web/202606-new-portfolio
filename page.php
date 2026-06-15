<?php get_header(); ?>
<main style="padding-top: 7rem;">

    <div class="c-page-hero">
        <div class="inner">
            <h1 class="c-page-hero-title"><?php the_title(); ?></h1>
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
