<?php
/**
 * The main template file
 *
 * @package CPA_Journey
 */

get_header();
?>

<main id="primary" class="site-main">
    <!-- Latest Articles -->
    <section id="latest" class="section section--latest">
        <div class="section__container">
            <div class="section__header">
                <h2 class="section__title">
                    <i data-lucide="pen-tool"></i>
                    <?php esc_html_e('最新の記事', 'cpajpurney'); ?>
                </h2>
                <a href="<?php echo esc_url(get_permalink(get_option('page_for_posts'))); ?>" class="link-arrow">
                    すべて見る <i data-lucide="arrow-right"></i>
                </a>
            </div>

            <?php if (have_posts()) : ?>
                <div class="articles-grid">
                    <?php
                    while (have_posts()) :
                        the_post();
                        
                        // カテゴリー情報を取得
                        $categories = get_the_category();
                        $category_name = !empty($categories) ? $categories[0]->name : '';
                        $category_slug = !empty($categories) ? $categories[0]->slug : '';
                        
                        // カテゴリーに応じたアイコンを設定
                        $icon = 'file-text';
                        if ($category_slug === 'study' || $category_slug === '勉強法') {
                            $icon = 'book-open';
                        } elseif ($category_slug === 'time' || $category_slug === '時間管理') {
                            $icon = 'clock';
                        } elseif ($category_slug === 'failure' || $category_slug === '失敗談') {
                            $icon = 'alert-circle';
                        }
                        
                        // グレーカテゴリーかどうか
                        $is_gray_category = ($category_slug === 'failure' || $category_slug === '失敗談');
                        ?>
                        
                        <article id="post-<?php the_ID(); ?>" <?php post_class('article-card'); ?>>
                            <a href="<?php the_permalink(); ?>" class="article-card__thumb">
                                <?php if (has_post_thumbnail()) : ?>
                                    <?php the_post_thumbnail('medium_large'); ?>
                                <?php else : ?>
                                    <div class="article-card__icon-wrapper">
                                        <i data-lucide="<?php echo esc_attr($icon); ?>"></i>
                                    </div>
                                <?php endif; ?>
                                <?php if ($category_name) : ?>
                                    <span class="article-card__category<?php echo $is_gray_category ? ' article-card__category--gray' : ''; ?>">
                                        <?php echo esc_html($category_name); ?>
                                    </span>
                                <?php endif; ?>
                            </a>
                            <div class="article-card__content">
                                <time class="article-card__date" datetime="<?php echo esc_attr(get_the_date('c')); ?>">
                                    <?php echo esc_html(get_the_date('Y.m.d')); ?>
                                </time>
                                <?php the_title('<h3 class="article-card__title">', '</h3>'); ?>
                                <p class="article-card__excerpt">
                                    <?php echo wp_trim_words(get_the_excerpt(), 60, '...'); ?>
                                </p>
                                <div class="article-card__footer">
                                    <a href="<?php the_permalink(); ?>" class="link-more">
                                        続きを読む <i data-lucide="chevron-right"></i>
                                    </a>
                                </div>
                            </div>
                        </article>
                        
                    <?php endwhile; ?>
                </div>

                <?php the_posts_pagination(array(
                    'mid_size'  => 2,
                    'prev_text' => '&laquo;',
                    'next_text' => '&raquo;',
                )); ?>

            <?php else : ?>
                <div class="no-results">
                    <p><?php esc_html_e('記事がありません。', 'cpajpurney'); ?></p>
                </div>
            <?php endif; ?>
        </div>
    </section>

    <!-- Profile Section -->
    <section class="section section--profile">
        <div class="profile-box">
            <!-- Avatar -->
            <div class="profile-box__avatar-wrapper">
                <div class="profile-box__avatar">
                    <i data-lucide="user"></i>
                </div>
                <div class="profile-box__badge">
                    <i data-lucide="pen-tool"></i>
                </div>
            </div>

            <!-- Content -->
            <div class="profile-box__content">
                <h2 class="profile-box__title">About Me</h2>
                <p class="profile-box__name">管理人（31歳・男性・社会人）</p>
                <p class="profile-box__desc">
                    会計未経験・簿記資格なしの状態から、働きながらUSCPAに挑戦中。
                    2025年11月にFARに合格しました。模試46点から立て直し、9ヶ月・約700時間かけての合格です。
                    決して「短期合格」や「天才肌」ではありません。
                    仕事と勉強の両立に悩み、何度も挫折しかけた経験があるからこそ伝えられる、
                    「崩れても戻せる運用」のヒントを発信しています。
                </p>
                <div class="profile-box__tags">
                    <span class="tag">#会計未経験から挑戦</span>
                    <span class="tag">#TOEIC 935点</span>
                    <span class="tag">#iPad×Notion活用</span>
                </div>
            </div>
        </div>
    </section>
</main>

<?php
get_footer();
