<?php
/**
 * The main template file
 *
 * @package CPA_Journey
 */

get_header();
?>

<main id="primary" class="site-main">
    <?php if (is_home() && !is_paged()) : ?>
        <section class="hero-section">
            <div class="container">
                <h1><?php bloginfo('name'); ?></h1>
                <p><?php bloginfo('description'); ?></p>
            </div>
        </section>
    <?php endif; ?>

    <div class="container">
        <?php if (have_posts()) : ?>
            
            <?php if (is_home()) : ?>
                <h2 class="section-title"><?php esc_html_e('Latest Posts', 'cpajpurney'); ?></h2>
            <?php endif; ?>

            <div class="posts-grid">
                <?php
                while (have_posts()) :
                    the_post();
                    ?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class('post-card'); ?>>
                        <?php if (has_post_thumbnail()) : ?>
                            <a href="<?php the_permalink(); ?>" class="post-card__thumbnail">
                                <?php the_post_thumbnail('medium_large'); ?>
                            </a>
                        <?php else : ?>
                            <a href="<?php the_permalink(); ?>" class="post-card__thumbnail post-card__thumbnail--placeholder">
                                <span>📝</span>
                            </a>
                        <?php endif; ?>

                        <div class="post-card__content">
                            <div class="post-card__meta">
                                <time datetime="<?php echo esc_attr(get_the_date('c')); ?>">
                                    <?php echo esc_html(get_the_date()); ?>
                                </time>
                            </div>
                            
                            <?php the_title('<h2 class="post-card__title"><a href="' . esc_url(get_permalink()) . '">', '</a></h2>'); ?>

                            <div class="post-card__excerpt">
                                <?php the_excerpt(); ?>
                            </div>

                            <a href="<?php the_permalink(); ?>" class="post-card__link">
                                <?php esc_html_e('Read more', 'cpajpurney'); ?>
                            </a>
                        </div>
                    </article>
                    <?php
                endwhile;
                ?>
            </div>

            <?php the_posts_pagination(array(
                'mid_size'  => 2,
                'prev_text' => '&laquo;',
                'next_text' => '&raquo;',
            )); ?>

        <?php else : ?>
            <div class="no-results">
                <p><?php esc_html_e('No posts found.', 'cpajpurney'); ?></p>
            </div>
        <?php endif; ?>
    </div>
</main>

<?php
get_footer();
