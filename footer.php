<?php if (!is_front_page()) : ?>
<nav class="c-breadcrumb" aria-label="パンくずリスト">
    <ol class="c-breadcrumb-list inner">
        <li class="c-breadcrumb-item"><a class="c-breadcrumb-link" href="<?php echo home_url('/'); ?>">HOME</a></li>
        <?php if (is_singular()) : ?>
            <li class="c-breadcrumb-item"><span class="c-breadcrumb-current" aria-current="page"><?php the_title(); ?></span></li>
        <?php elseif (!is_front_page()) : ?>
            <li class="c-breadcrumb-item"><span class="c-breadcrumb-current" aria-current="page"><?php echo get_the_archive_title(); ?></span></li>
        <?php endif; ?>
    </ol>
</nav>

<footer class="footer">
    <div class="footer-inner inner">
        <div class="footer-logo">
            <a href="<?php echo home_url('/'); ?>"><?php bloginfo('name'); ?></a>
        </div>
        <nav class="footer-nav" aria-label="フッターナビ">
            <div class="footer-nav-item"><a href="<?php echo home_url('/about/'); ?>">About</a></div>
            <div class="footer-nav-item"><a href="<?php echo home_url('/service/'); ?>">Service</a></div>
            <div class="footer-nav-item"><a href="<?php echo home_url('/news/'); ?>">News</a></div>
            <div class="footer-nav-item"><a href="<?php echo home_url('/company/'); ?>">Company</a></div>
            <div class="footer-nav-item"><a href="<?php echo home_url('/contact/'); ?>">Contact</a></div>
        </nav>
    </div>

    <div class="footer-bottom">
        <div class="inner" style="display:flex;justify-content:space-between;align-items:center;gap:2rem;flex-wrap:wrap;">
            <small>© <?php echo date('Y'); ?> <?php bloginfo('name'); ?></small>
            <div class="footer-bottom-links">
                <a href="<?php echo home_url('/privacy-policy/'); ?>">プライバシーポリシー</a>
            </div>
        </div>
    </div>
</footer>
<?php endif; ?>

<?php wp_footer(); ?>
</body>
</html>
