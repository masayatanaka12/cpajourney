<?php
/**
 * The template for displaying archive pages
 *
 * @package CPA_Journey
 */

get_header();
?>

<main id="primary" class="site-main">
    <?php if (have_posts()) : ?>
        <header class="archive-header">
            <div class="container">
                <?php
                the_archive_title('<h1 class="archive-title">', '</h1>');
                the_archive_description('<div class="archive-description">', '</div>');
                ?>
            </div>
        </header>

        <div class="container">
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
        </div>

    <?php else : ?>
        <div class="container">
            <div class="no-results">
                <p><?php esc_html_e('No posts found.', 'cpajpurney'); ?></p>
            </div>
        </div>
    <?php endif; ?>
</main>

<?php
get_footer();
