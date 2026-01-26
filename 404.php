<?php
/**
 * The template for displaying 404 pages
 *
 * @package CPA_Journey
 */

get_header();
?>

<main id="primary" class="site-main">
    <div class="container">
        <section class="error-404 not-found">
            <header class="page-header">
                <h1 class="page-title"><?php esc_html_e('404 - Page Not Found', 'cpajpurney'); ?></h1>
            </header>

            <div class="page-content">
                <p><?php esc_html_e('It looks like nothing was found at this location. Maybe try a search?', 'cpajpurney'); ?></p>

                <?php get_search_form(); ?>

                <div class="error-404__widgets">
                    <div class="widget">
                        <h2 class="widget-title"><?php esc_html_e('Recent Posts', 'cpajpurney'); ?></h2>
                        <ul>
                            <?php
                            $recent_posts = wp_get_recent_posts(array(
                                'numberposts' => 5,
                                'post_status' => 'publish',
                            ));
                            foreach ($recent_posts as $post) :
                                ?>
                                <li>
                                    <a href="<?php echo esc_url(get_permalink($post['ID'])); ?>">
                                        <?php echo esc_html($post['post_title']); ?>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>

                    <?php if (has_nav_menu('primary')) : ?>
                        <div class="widget">
                            <h2 class="widget-title"><?php esc_html_e('Menu', 'cpajpurney'); ?></h2>
                            <?php
                            wp_nav_menu(array(
                                'theme_location' => 'primary',
                                'menu_class'     => 'menu-list',
                            ));
                            ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </section>
    </div>
</main>

<?php
get_footer();
