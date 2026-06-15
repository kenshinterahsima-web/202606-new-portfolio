<?php get_header(); ?>
<main style="padding-top: 7rem;">

    <div class="c-page-hero">
        <div class="inner">
            <span class="c-page-hero-label">Contact</span>
            <h1 class="c-page-hero-title">お問い合わせ</h1>
        </div>
    </div>

    <!-- 電話お問い合わせ -->
    <section class="section section-bg">
        <div class="inner-sm">
            <div class="contact-tel">
                <p class="contact-tel__label">お電話でお問い合わせ</p>
                <a class="contact-tel__number" href="tel:07042018904">070-4201-8904</a>
                <p class="contact-tel__note">
                    受付時間：8:00〜17:00<br>
                    （毎週日曜を除く）<br>
                    営業電話はお断りしております。ご遠慮ください。
                </p>
            </div>
        </div>
    </section>

    <!-- フォームお問い合わせ -->
    <section class="section">
        <div class="inner-sm">
            <div class="c-heading u-text-center">
                <h2 class="c-heading-title">お気軽にご連絡ください</h2>
                <p class="c-heading-desc">お仕事のご依頼・ご相談はこちらのフォームよりお気軽にお問い合わせください。</p>
            </div>

            <?php echo do_shortcode('[contact-form-7 id="119f859" title="お問い合わせ"]'); ?>
        </div>
    </section>

</main>
<?php get_footer(); ?>
