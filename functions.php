<?php
// アーカイブページ
function post_has_archive( $args, $post_type ) {
 
    if ( 'post' == $post_type ) {
        $args['rewrite'] = true;
        $args['has_archive'] = 'all'; 
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
    $cats = get_categories('exclude=5');
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

//カスタムcss
add_action( 'admin_menu', 'custom_css_hooks' );
add_action( 'save_post', 'save_custom_css' );
add_action( 'wp_head','insert_custom_css' );
function custom_css_hooks() {
  add_meta_box( 'custom_css', 'Custom CSS', 'custom_css_input', 'post', 'normal', 'high' );
  add_meta_box( 'custom_css', 'Custom CSS', 'custom_css_input', 'page', 'normal', 'high' );
}
function custom_css_input() {
  global $post;
  echo '<input type="hidden" name="custom_css_noncename" id="custom_css_noncename" value="'.wp_create_nonce('custom-css').'" />';
  echo '<textarea name="custom_css" id="custom_css" rows="5" cols="30" style="width:100%;">'.get_post_meta($post->ID,'_custom_css',true).'</textarea>';
}
function save_custom_css($post_id) {
  if ( !wp_verify_nonce( $_POST['custom_css_noncename'], 'custom-css' ) ) return $post_id;
  if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE) return $post_id;
  $custom_css = $_POST['custom_css'];
  update_post_meta( $post_id, '_custom_css', $custom_css );
}
function insert_custom_css() {
  if ( is_page() || is_single() ) {
    if ( have_posts() ) : while ( have_posts() ) : the_post();
      echo '<style type="text/css">' . get_post_meta(get_the_ID(), '_custom_css', true) . '</style>';
    endwhile; endif;
    rewind_posts();
  }
}

//カスタムjs
add_action( 'admin_menu', 'custom_js_hooks' );
add_action( 'save_post', 'save_custom_js' );
add_action( 'wp_head','insert_custom_js' );
function custom_js_hooks() {
  add_meta_box( 'custom_js', 'Custom JS', 'custom_js_input', 'post', 'normal', 'high' );
  add_meta_box( 'custom_js', 'Custom JS', 'custom_js_input', 'page', 'normal', 'high' );
}
function custom_js_input() {
  global $post;
  echo '<input type="hidden" name="custom_js_noncename" id="custom_js_noncename" value="'.wp_create_nonce('custom-js').'" />';
  echo '<textarea name="custom_js" id="custom_js" rows="5" cols="30" style="width:100%;">'.get_post_meta($post->ID,'_custom_js',true).'</textarea>';
}
function save_custom_js($post_id) {
  if (!wp_verify_nonce($_POST['custom_js_noncename'], 'custom-js')) return $post_id;
  if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return $post_id;
  $custom_js = $_POST['custom_js'];
  update_post_meta($post_id, '_custom_js', $custom_js);
}
function insert_custom_js() {
  if ( is_page() || is_single() ) {
    if ( have_posts() ) : while ( have_posts() ) : the_post();
      echo '<script type="text/javascript">' . get_post_meta(get_the_ID(), '_custom_js', true) . '</script>';
    endwhile; endif;
    rewind_posts();
  }
}

//日付アーカイブページのタイトルタグ修正
function jp_date_wp_title( $title, $sep, $seplocation ) {
  if ( is_date() ) {
    $m = get_query_var('m');
    if ( $m ) {
      $year = substr($m, 0, 4);
      $month = intval(substr($m, 4, 2));
      $day = intval(substr($m, 6, 2));
    } else {
      $year = get_query_var('year');
      $month = get_query_var('monthnum');
      $day = get_query_var('day');
    }
 
    $title = ($seplocation != 'right' ? " $sep " : '') .
         ($year ? $year . '年' : '') .
         ($month ? $month . '月' : '') .
         ($day ? $day . '日' : '') .
         ($seplocation == 'right' ? " $sep " : '');
  }
  return $title;
}
add_filter( 'wp_title', 'jp_date_wp_title', 10, 3 );
  /*header内JS非同期読み込みasync/defer*/
  function replace_scripttag ( $tag ) {
      if ( !preg_match( '/b(defer|async)b/', $tag ) ) {
          return str_replace( "type='text/javascript'", 'defer', $tag );
      }
      return $tag;
  }
  add_filter( 'script_loader_tag', 'replace_scripttag' );

// 人気記事出力用関数
function getPostViews($postID){
  $count_key = 'post_views_count';
  $count = get_post_meta($postID, $count_key, true);
  if($count==''){
          delete_post_meta($postID, $count_key);
          add_post_meta($postID, $count_key, '0');
          return "0 View";
  }
  return $count.' Views';
}
// 記事viewカウント用関数
function setPostViews($postID) {
  $count_key = 'post_views_count';
  $count = get_post_meta($postID, $count_key, true);
  if($count==''){
          $count = 0;
          delete_post_meta($postID, $count_key);
          add_post_meta($postID, $count_key, '0');
  }else{
          $count++;
          update_post_meta($postID, $count_key, $count);
  }
}
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);

// 100文字読書の追加
add_action('init', 'create_post_type');
function create_post_type() {
  register_post_type('books', 
    array(
      'labels' => array(
      'name' => '100文字読書',
      'singular_name' => '100文字読書'
      ),
      'public' => true,
      'menu_position' =>5,
    )
  );
}