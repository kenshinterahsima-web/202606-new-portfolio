<?php get_header(); ?>
<main style="padding-top: 7rem;">

    <div class="c-page-hero">
        <div class="inner">
            <span class="c-page-hero-label">Service</span>
            <h1 class="c-page-hero-title">サービス</h1>
        </div>
    </div>

    <!-- サービス一覧 -->
    <section class="section">
        <div class="inner">
            <div class="c-heading u-text-center">
                <span class="c-heading-label">What We Do</span>
                <h2 class="c-heading-title">提供するサービス</h2>
                <p class="c-heading-desc">ここにサービスの概要説明が入ります。</p>
            </div>

            <div class="top-services-grid">
                <div class="c-card">
                    <div class="c-card-body">
                        <span class="c-card-label">Service 01</span>
                        <h3 class="c-card-title">サービス名 A</h3>
                        <p class="c-card-text">サービスの説明文がここに入ります。どんな価値を提供するか簡潔に記載してください。</p>
                    </div>
                </div>
                <div class="c-card">
                    <div class="c-card-body">
                        <span class="c-card-label">Service 02</span>
                        <h3 class="c-card-title">サービス名 B</h3>
                        <p class="c-card-text">サービスの説明文がここに入ります。どんな価値を提供するか簡潔に記載してください。</p>
                    </div>
                </div>
                <div class="c-card">
                    <div class="c-card-body">
                        <span class="c-card-label">Service 03</span>
                        <h3 class="c-card-title">サービス名 C</h3>
                        <p class="c-card-text">サービスの説明文がここに入ります。どんな価値を提供するか簡潔に記載してください。</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- エディターコンテンツ -->
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    <?php if (get_the_content()) : ?>
    <section class="section section-bg">
        <div class="inner-sm">
            <div class="entry-content">
                <?php the_content(); ?>
            </div>
        </div>
    </section>
    <?php endif; endwhile; endif; ?>

</main>
<?php get_footer(); ?>
