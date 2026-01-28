<?php
/**
 * The footer template
 *
 * @package CPA_Journey
 */
?>

    <!-- Footer -->
    <footer class="site-footer">
        <div class="site-footer__inner">
            <div class="site-footer__brand">
                <div class="logo logo--footer">
                    <i data-lucide="compass"></i>
                    <span class="logo__text"><?php bloginfo('name'); ?></span>
                </div>
                <p class="site-footer__desc"><?php bloginfo('description'); ?></p>
            </div>

            <div class="site-footer__social">
                <?php 
                // SNSリンクはカスタマイザーで設定するか、直接編集してください
                $twitter_url = '';
                $instagram_url = '';
                
                if ($twitter_url) : ?>
                    <a href="<?php echo esc_url($twitter_url); ?>" class="social-link" target="_blank" rel="noopener">
                        <i data-lucide="twitter"></i>
                    </a>
                <?php endif; ?>
                
                <?php if ($instagram_url) : ?>
                    <a href="<?php echo esc_url($instagram_url); ?>" class="social-link" target="_blank" rel="noopener">
                        <i data-lucide="instagram"></i>
                    </a>
                <?php endif; ?>
            </div>
        </div>
        <div class="site-footer__copyright">
            &copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. All Rights Reserved.
        </div>
    </footer>
</div><!-- #page -->

<?php wp_footer(); ?>

<!-- Initialize Lucide Icons -->
<script>
    if (typeof lucide !== 'undefined') {
        lucide.createIcons();
    }
</script>

</body>
</html>
