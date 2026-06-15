<?php get_header(); ?>
<main style="padding-top: 7rem;">

    <div class="c-page-hero">
        <div class="inner">
            <span class="c-page-hero-label">Company</span>
            <h1 class="c-page-hero-title">会社概要</h1>
        </div>
    </div>

    <!-- 会社概要テーブル -->
    <section class="section">
        <div class="inner-sm">
            <div class="c-heading">
                <span class="c-heading-label">About Us</span>
                <h2 class="c-heading-title">会社情報</h2>
            </div>

            <table class="company-table">
                <tbody>
                    <tr>
                        <th>会社名</th>
                        <td><?php bloginfo('name'); ?></td>
                    </tr>
                    <tr>
                        <th>設立</th>
                        <td>20XX年XX月</td>
                    </tr>
                    <tr>
                        <th>所在地</th>
                        <td>〒000-0000 東京都XX区XX 0-0-0</td>
                    </tr>
                    <tr>
                        <th>代表者</th>
                        <td>代表者名</td>
                    </tr>
                    <tr>
                        <th>事業内容</th>
                        <td>事業内容の説明が入ります</td>
                    </tr>
                </tbody>
            </table>

            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <?php if (get_the_content()) : ?>
            <div class="entry-content" style="margin-top: 6rem;">
                <?php the_content(); ?>
            </div>
            <?php endif; endwhile; endif; ?>
        </div>
    </section>

</main>
<?php get_footer(); ?>
