<?php get_header(); ?>
<main style="padding-top: 7rem;">

    <div class="c-page-hero">
        <div class="inner">
            <span class="c-page-hero-label">About</span>
            <h1 class="c-page-hero-title">私たちについて</h1>
        </div>
    </div>

    <!-- ミッション -->
    <section class="section">
        <div class="inner">
            <div class="c-heading">
                <span class="c-heading-label">Mission</span>
                <h2 class="c-heading-title">私たちのミッション</h2>
                <p class="c-heading-desc">ここにミッションの説明文が入ります。企業の理念や目指す姿を記載してください。</p>
            </div>
        </div>
    </section>

    <!-- メンバー / 概要 -->
    <section class="section section-bg">
        <div class="inner">
            <div class="c-heading">
                <span class="c-heading-label">Team</span>
                <h2 class="c-heading-title">チーム紹介</h2>
            </div>
            <div class="about-team-grid">
                <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                <div class="entry-content">
                    <?php the_content(); ?>
                </div>
                <?php endwhile; endif; ?>
            </div>
        </div>
    </section>

</main>
<?php get_footer(); ?>
