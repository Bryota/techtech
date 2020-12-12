<?php
// アーカイブページ
function post_has_archive( $args, $post_type ) {
 
    if ( 'post' == $post_type ) {
        $args['rewrite'] = true;
        $args['has_archive'] = 'all'; //任意のスラッグ名
    }
    return $args;
 
}
add_filter( 'register_post_type_args', 'post_has_archive', 10, 2 );

// ヴィジェットカスタマイズ
if ( function_exists('register_sidebar') ) {
  
    register_sidebar(array(
        'name'          => 'アーカイブ用',
        'id'            => 'sidebar-1',
        'description'   => 'トップページ・アーカイブ用のサイドバー',
        'class'         => 's1',
        'before_widget' => '<aside class="single-widget">',
        'after_widget' => '</aside>',
        'before_title' => '<h4 class="widget-title">',
        'after_title' => '</h4>',
    ));
  
    register_sidebar(array(
        'name'          => '個別記事用',
        'id'            => 'sidebar-2',
        'description'   => '個別記事用のサイドバー',
        'class'         => 's2',
        'before_widget' => '<aside class="single-widget">',
        'after_widget' => '</aside>',
        'before_title' => '<h4 class="widget-title">',
        'after_title' => '</h4>',
    ));
  
}

// ヴィジェット「最近の投稿」カスタマイズ
/**
 * Recent_Posts widget class
 *
 * @since 2.8.0
 */
class My_WP_Widget_Recent_Posts extends WP_Widget_Recent_Posts {
    public function widget($args, $instance) {
        $cache = array();
        if ( ! $this->is_preview() ) {
            $cache = wp_cache_get( 'widget_recent_posts', 'widget' );
        }
 
        if ( ! is_array( $cache ) ) {
            $cache = array();
        }
 
        if ( ! isset( $args['widget_id'] ) ) {
            $args['widget_id'] = $this->id;
        }
 
        if ( isset( $cache[ $args['widget_id'] ] ) ) {
            echo $cache[ $args['widget_id'] ];
            return;
        }
 
        ob_start();
 
        $title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : __( 'Recent Posts' );
 
        /** This filter is documented in wp-includes/default-widgets.php */
        $title = apply_filters( 'widget_title', $title, $instance, $this->id_base );
 
        $number = ( ! empty( $instance['number'] ) ) ? absint( $instance['number'] ) : 5;
        if ( ! $number )
            $number = 5;
        $show_date = isset( $instance['show_date'] ) ? $instance['show_date'] : false;
 
        /**
         * Filter the arguments for the Recent Posts widget.
         *
         * @since 3.4.0
         *
         * @see WP_Query::get_posts()
         *
         * @param array $args An array of arguments used to retrieve the recent posts.
         */
        $r = new WP_Query( apply_filters( 'widget_posts_args', array(
            'posts_per_page'      => $number,
            'no_found_rows'       => true,
            'post_status'         => 'publish',
            'ignore_sticky_posts' => true
        ) ) );
 
        if ($r->have_posts()) :
?>
        <?php echo $args['before_widget']; ?>
        <?php if ( $title ) {
            echo $args['before_title'] . $title . $args['after_title'];
        } ?>
        <?php while ( $r->have_posts() ) : $r->the_post(); ?>
        <div class="widget-single-post clearfix">
            <?php the_post_thumbnail(array(80,80));?>
            <div class="widget-post-content">
                <h4><a href="<?php the_permalink();?>"><?php the_title();?></a></h4>
                <p><?php echo post_custom('これなに'); ?></p>
            </div>
        </div>
        <?php endwhile; ?>
        <?php echo $args['after_widget']; ?>
<?php
        // Reset the global $the_post as this query will have stomped on it
        wp_reset_postdata();
 
        endif;
 
        if ( ! $this->is_preview() ) {
            $cache[ $args['widget_id'] ] = ob_get_flush();
            wp_cache_set( 'widget_recent_posts', $cache, 'widget' );
        } else {
            ob_end_flush();
        }
    }
}
function wp_my_widget_register() {
    register_widget('My_WP_Widget_Recent_Posts');
}
add_action('widgets_init', 'wp_my_widget_register');

// ヴィジェット「カテゴリー」ショートコード
// カテゴリ一覧（記事数を含む）
function echo_list_cats_and_count($content) {
    // カテゴリ情報取得
    $cats = get_categories('exclude=2');
    // Buffer output
    ob_start();
    ?>
    <div class="widget sidebar-widget widget_categories">
        <ul class="post-cat-list">
        <?php
        // カテゴリ一覧を表示
        foreach($cats as $category) {
        ?>
            <li><a href="<?= get_category_link( $category->term_id ) ?>"><?= $category->name ?><span>(<?= $category->count ?>)</span></a></li>
        <?php
        }
         
        ?>
        </ul>
    </div>
    <?php
    // clear buffer
    $output = ob_get_clean();
    return $output;
}
add_shortcode('list_cats_and_count', 'echo_list_cats_and_count');

// ヴィジェット「タグ」ショートコード
function echo_list_tags_and_count($content) {
    // タグ情報取得
    $tags = get_tags();
    // Buffer output
    ob_start();
    ?>
    <div class="textwidget custom-html-widget">   
        <div class="tags">
        <?php
        // カテゴリ一覧を表示
        foreach($tags as $tag) {
        ?>
            <a href="<?= get_tag_link($tag->term_id)?>"><?= $tag->name?></a>
        <?php
        }
         
        ?>
        </div>
    </div>
    <?php
    // clear buffer
    $output = ob_get_clean();
    return $output;
}
add_shortcode('list_tags_and_count', 'echo_list_tags_and_count');


// アイキャッチ画像を使用可能にする
add_theme_support('post-thumbnails');

