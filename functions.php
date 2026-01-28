<?php
/**
 * CPA Journey Theme Functions
 *
 * @package CPA_Journey
 */

// テーマのセットアップ
function cpajpurney_setup() {
    // タイトルタグのサポート
    add_theme_support('title-tag');

    // アイキャッチ画像のサポート
    add_theme_support('post-thumbnails');

    // HTMLのサポート
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
    ));

    // ナビゲーションメニューの登録
    register_nav_menus(array(
        'primary' => __('Primary Menu', 'cpajpurney'),
        'footer'  => __('Footer Menu', 'cpajpurney'),
    ));
}
add_action('after_setup_theme', 'cpajpurney_setup');

/**
 * ウィジェットエリアの登録
 */
function cpajpurney_widgets_init() {
    register_sidebar(array(
        'name'          => __('Sidebar', 'cpajpurney'),
        'id'            => 'sidebar-1',
        'description'   => __('Add widgets here.', 'cpajpurney'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ));
}
add_action('widgets_init', 'cpajpurney_widgets_init');

/**
 * Viteアセットの読み込み
 */
function cpajpurney_enqueue_assets() {
    $theme_path = get_template_directory();
    $theme_uri = get_template_directory_uri();
    
    // 開発モードかどうかを判定
    $is_dev = defined('WP_DEBUG') && WP_DEBUG && file_exists($theme_path . '/hot');
    
    if ($is_dev) {
        // 開発モード: Vite dev serverから読み込み
        $vite_host = 'http://localhost:5173';
        
        // Vite client（HMR用）
        wp_enqueue_script(
            'vite-client',
            $vite_host . '/@vite/client',
            array(),
            null,
            false
        );
        
        // メインスクリプト
        wp_enqueue_script(
            'cpajpurney-main',
            $vite_host . '/src/main.js',
            array(),
            null,
            true
        );
        
        // type="module" を追加
        add_filter('script_loader_tag', 'cpajpurney_add_module_type', 10, 3);
        
    } else {
        // 本番モード: ビルドされたファイルから読み込み
        $manifest_path = $theme_path . '/dist/.vite/manifest.json';
        
        if (file_exists($manifest_path)) {
            $manifest = json_decode(file_get_contents($manifest_path), true);
            
            if (isset($manifest['src/main.js'])) {
                $main_js = $manifest['src/main.js'];
                
                // CSSファイルの読み込み
                if (isset($main_js['css'])) {
                    foreach ($main_js['css'] as $css_file) {
                        wp_enqueue_style(
                            'cpajpurney-style',
                            $theme_uri . '/dist/' . $css_file,
                            array(),
                            null
                        );
                    }
                }
                
                // JSファイルの読み込み
                wp_enqueue_script(
                    'cpajpurney-main',
                    $theme_uri . '/dist/' . $main_js['file'],
                    array(),
                    null,
                    true
                );
                
                // type="module" を追加
                add_filter('script_loader_tag', 'cpajpurney_add_module_type', 10, 3);
            }
        }
    }
}
add_action('wp_enqueue_scripts', 'cpajpurney_enqueue_assets');

/**
 * Lucideアイコンの読み込み
 */
function cpajpurney_enqueue_lucide() {
    wp_enqueue_script(
        'lucide-icons',
        'https://unpkg.com/lucide@latest',
        array(),
        null,
        true
    );
}
add_action('wp_enqueue_scripts', 'cpajpurney_enqueue_lucide');

/**
 * スクリプトタグに type="module" を追加
 */
function cpajpurney_add_module_type($tag, $handle, $src) {
    if (in_array($handle, array('vite-client', 'cpajpurney-main'))) {
        $tag = str_replace('<script ', '<script type="module" ', $tag);
    }
    return $tag;
}

/**
 * コメントフォームの「ログインしています」メッセージを非表示
 */
function cpajpurney_remove_comment_logged_in_as($defaults) {
    $defaults['logged_in_as'] = '';
    return $defaults;
}
add_filter('comment_form_defaults', 'cpajpurney_remove_comment_logged_in_as');
