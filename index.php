        <?php get_header();?>
        <div class="intelligent-header-space "></div>
            <div class="content gray-bg">
                <!-- Breadcrumb area start -->
                <div class="portfolio-filter-wrap text-center pt-50">
                    <ul class="portfolio-filter hover-style-one">
                    <li class="active"><a href="<?php echo home_url(); ?>" >トップページ</a></li>
                    <?php
                        $categories = get_categories('exclude=5');
                        foreach($categories as $cat) {?>
                        <?php $link = get_category_link($cat->term_id);?>
                        <li><a href="<?php echo $link;?>"><?php echo $cat->name;?></a></li>
                    <?php } ?>
                    </ul>
                </div>          
                <!-- Theme standard row Start for Blog -->
                <div class="adam-standard-row pt-40 pb-80">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-9 col-md-8 col-sm-12">
                                <div class="row">
                                    <div class="blog-masonry">
                                        <div class="row">
                                            <div class="col-md-12  mb-20">
                                                <h3 class="blog_type blog_popular text-center">～人気の記事～</h3>
                                            </div>
                                            <?php
                                                $post_ids = get_posts(array(
                                                    'posts_per_page'=> -1,
                                                    'fields'        => 'ids',
                                                ));
                                                foreach($post_ids as $post_id) {
                                                    setPostViews($post_id);
                                                }
                                                $args = array(
                                                    'meta_key' => 'post_views_count',
                                                    'orderby' => 'meta_value_num',
                                                    'order' => 'DESC',
                                                    'posts_per_page' => 1 
                                                );
                                                $query = new WP_Query($args);
                                                if ($query->have_posts()) :
                                                    while ($query->have_posts()) :
                                                        $query->the_post();
                                            ?>
                                            <div class="col-md-12 blog_popular_artticle">
                                                <article class="blog-post">
                                                    <div class="post-thumbnail">
                                                        <a href="<?php the_permalink();?>"><?php the_post_thumbnail(array(900, 540));?></a>
                                                    </div>
                                                    <div class="post-content">
                                                        <div class="post-content-inner">
                                                            <h3><a href="<?php the_permalink();?>"><?php the_title(); ?></a></h3>
                                                            <ul class="meta-info">
                                                                <li><a href="<?php the_permalink();?>"><?php the_time('Y年m月d日');?> </a></li>
                                                            </ul>
                                                            <p class="post-content-subtitle">これなに？</p>
                                                            <p><?php echo get_post_meta($post->ID, 'これなに', true);?></p>
                                                        </div>
                                                        <div class="post-footer-meta clearfix">
                                                            <div class="read-more-wrapper">
                                                                <a href="<?php the_permalink();?>" class="read-more">記事を読む</a>
                                                            </div>
                                                        </div>                                        
                                                    </div>
                                                </article>
                                            </div>
                                            <?php
                                                    endwhile;
                                                endif;
                                                wp_reset_postdata();
                                            ?>
                                        </div>
                                        <div class="row mt-50">
                                            <div class="col-md-12  mb-20">
                                                <h3 class="blog_type blog_new text-center">～新着記事～</h3>
                                            </div>
                                            <?php
                                                $args = array(
                                                    'posts_per_page' => 6 // 表示件数の指定
                                                );
                                                $posts = get_posts( $args );
                                                foreach ( $posts as $post ): // ループの開始
                                                setup_postdata( $post ); // 記事データの取得
                                                ?>
                                                <div class="col-md-4 col-sm-6 mb-30">
                                                <article class="blog-post">
                                                    <div class="post-thumbnail new-post-thumbnail">
                                                        <a href="<?php the_permalink();?>"><?php the_post_thumbnail(array(300, 300));?></a>
                                                    </div>
                                                    <div class="post-content new-post-content">
                                                        <div class="post-content-inner">
                                                            <h3><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
                                                            <ul class="meta-info">
                                                                <li><?php the_time('Y年m月d日');?> </li>
                                                            </ul>
                                                            <p class="post-content-subtitle">これなに？</p>
                                                            <p><?php echo get_post_meta($post->ID, 'これなに', true);?></p>
                                                        </div>
                                                        <div class="post-footer-meta clearfix">
                                                            <div class="read-more-wrapper">
                                                                <a href="<?php the_permalink();?>" class="read-more">記事を読む</a>
                                                            </div>
                                                        </div>                                        
                                                    </div>
                                                </article>
                                            </div>
                                                <?php
                                                endforeach; // ループの終了
                                                wp_reset_postdata(); // 直前のクエリを復元する
                                                ?>
                                        </div>
                                        <div class="row mt-50">
                                            <div class="col-md-12  mb-20">
                                                <h3 class="blog_type blog_recommend text-center">～おすすめ記事～</h3>
                                            </div>
                                            <?php
                                                $cat_posts = get_posts(array(
                                                    'post_type' => 'post', // 投稿タイプ
                                                    'posts_per_page' => 4, // 表示件数
                                                    'orderby' => 'date', // 表示順の基準
                                                    'order' => 'DESC', // 昇順・降順
                                                    'tag' => 'recommend'
                                                ));
                                                global $post;
                                                if($cat_posts): foreach($cat_posts as $post): setup_postdata($post); ?>
                                                <div class="col-md-3 col-sm-6 mb-30 blog_recommend_wrap">
                                                <article class="blog-post">
                                                    <div class="post-thumbnail recommend-img">
                                                        <a href="<?php the_permalink();?>"><?php the_post_thumbnail(array(200, 150));?></a>
                                                    </div>
                                                    <div class="post-content">
                                                        <div class="post-content-inner">
                                                            <h3><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
                                                            <ul class="meta-info">
                                                                <li><?php the_time('Y年m月d日');?></li>
                                                            </ul>
                                                            <p class="post-content-subtitle">これなに？</p>
                                                            <p><?php echo get_post_meta($post->ID, 'これなに', true);?></p>
                                                        </div>
                                                        <div class="post-footer-meta clearfix">
                                                            <div class="read-more-wrapper">
                                                                <a href="<?php the_permalink();?>" class="read-more">記事を読む</a>
                                                            </div>
                                                        </div>                                        
                                                    </div>
                                                </article>
                                            </div>
                                                
                                            <?php endforeach; endif; wp_reset_postdata(); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-4 col-sm-12 sp_mt-50 sidebar-wrap">
                                <?php get_sidebar('archive');?>
                            </div>
                        </div>
                    </div>
                </div>               
                <!-- Theme standard row End for Blog -->               
            </div>
            <?php get_footer();?>
