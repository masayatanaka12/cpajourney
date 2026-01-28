<?php
/**
 * The header template
 *
 * @package CPA_Journey
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    
    <!-- Google Fonts: Zen Kaku Gothic New -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Zen+Kaku+Gothic+New:wght@300;400;500;700&display=swap" rel="stylesheet">
    
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div id="page" class="site">
    <!-- Header -->
    <header class="site-header">
        <div class="site-header__inner">
            <div class="site-header__brand">
                <a href="<?php echo esc_url(home_url('/')); ?>" class="logo">
                    <div class="logo__icon">
                        <i data-lucide="compass"></i>
                    </div>
                    <span class="logo__text"><?php bloginfo('name'); ?></span>
                </a>
                <?php 
                $description = get_bloginfo('description');
                if ($description) : ?>
                    <span class="site-header__tagline">
                        <?php echo esc_html($description); ?>
                    </span>
                <?php endif; ?>
            </div>

            <nav class="site-header__nav">
                <?php if (has_nav_menu('primary')) : ?>
                    <?php
                    wp_nav_menu(array(
                        'theme_location' => 'primary',
                        'menu_class'     => 'header-menu',
                        'container'      => false,
                        'depth'          => 1,
                    ));
                    ?>
                <?php else : ?>
                    <a href="<?php echo esc_url(home_url('/contact')); ?>" class="btn btn--outline">お問い合わせ</a>
                <?php endif; ?>
            </nav>
        </div>
    </header>
