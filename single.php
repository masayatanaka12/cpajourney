<?php
/**
 * The template for displaying single posts
 *
 * @package CPA_Journey
 */

get_header();
?>

<main id="primary" class="site-main">
    <?php
    while (have_posts()) :
        the_post();
        
        // カテゴリー情報を取得
        $categories = get_the_category();
        $category_name = !empty($categories) ? $categories[0]->name : '';
        $category_link = !empty($categories) ? get_category_link($categories[0]->term_id) : '';
    ?>
    
    <!-- Breadcrumb -->
    <nav class="breadcrumb" aria-label="パンくずリスト">
        <ol class="breadcrumb__list">
            <li class="breadcrumb__item">
                <a href="<?php echo esc_url(home_url('/')); ?>">ホーム</a>
            </li>
            <?php if ($category_name) : ?>
                <li class="breadcrumb__item">
                    <a href="<?php echo esc_url($category_link); ?>"><?php echo esc_html($category_name); ?></a>
                </li>
            <?php endif; ?>
            <li class="breadcrumb__item breadcrumb__item--current">
                <?php the_title(); ?>
            </li>
        </ol>
    </nav>

    <!-- Post Container -->
    <article id="post-<?php the_ID(); ?>" <?php post_class('post-container'); ?>>
        
        <!-- Post Header -->
        <header class="post-header">
            <div class="post-header__meta">
                <time class="post-header__date" datetime="<?php echo esc_attr(get_the_date('c')); ?>">
                    <i data-lucide="calendar"></i>
                    <?php echo esc_html(get_the_date('Y.m.d')); ?>
                </time>
                <?php if ($category_name) : ?>
                    <a href="<?php echo esc_url($category_link); ?>" class="post-header__category">
                        <?php echo esc_html($category_name); ?>
                    </a>
                <?php endif; ?>
            </div>
            
            <h1 class="post-header__title"><?php the_title(); ?></h1>
            
            <div class="post-header__thumb">
                <?php if (has_post_thumbnail()) : ?>
                    <?php the_post_thumbnail('large'); ?>
                <?php else : ?>
                    <div class="thumb-placeholder">
                        <i data-lucide="image"></i>
                    </div>
                <?php endif; ?>
            </div>
        </header>

        <!-- Post Content -->
        <div class="post-content">
            <?php the_content(); ?>

            <?php
            wp_link_pages(array(
                'before' => '<div class="page-links">' . esc_html__('Pages:', 'cpajpurney'),
                'after'  => '</div>',
            ));
            ?>
        </div>

        <!-- Post Footer -->
        <?php if (has_tag()) : ?>
            <footer class="post-footer">
                <div class="post-footer__tags">
                    <span class="tag-label"><?php esc_html_e('Tags:', 'cpajpurney'); ?></span>
                    <?php
                    $tags = get_the_tags();
                    if ($tags) {
                        foreach ($tags as $tag) {
                            echo '<a href="' . esc_url(get_tag_link($tag->term_id)) . '">' . esc_html($tag->name) . '</a>';
                        }
                    }
                    ?>
                </div>
            </footer>
        <?php endif; ?>
        
    </article>

    <?php
    // 前後の記事ナビゲーション
    the_post_navigation(array(
        'prev_text' => '<span class="nav-subtitle">' . esc_html__('前の記事', 'cpajpurney') . '</span> <span class="nav-title">%title</span>',
        'next_text' => '<span class="nav-subtitle">' . esc_html__('次の記事', 'cpajpurney') . '</span> <span class="nav-title">%title</span>',
    ));

    // コメント
    if (comments_open() || get_comments_number()) :
        comments_template();
    endif;

    endwhile;
    ?>
</main>

<?php
get_footer();
