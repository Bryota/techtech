<?php get_header();?>
<div class="intelligent-header-space "></div>
            <div class="content ">
                <!-- Breadcrumb area start -->
                <div class="breadcrumb-area breadcrumb-style-3 gray-bg ptb-100">
                    <div class="container">
                        <div class="row">
                            <div class="col-xs-12 text-center">
                                <div class="breadcrumb-content">
                                    <h2 class="page-cat"><?php the_search_query(); ?> の検索結果</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Breadcrumb area end -->
                <div class="adam-standard-row  pt-40 pb-80">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-9 col-md-8 col-sm-12">
                                <div class="row">
                                    <div class="blog-masonry">
                                        <div class="row">
                                        <?php
                                            if (have_posts() && get_search_query()) : 
                                                while (have_posts()) :
                                                    the_post();
                                        ?>
                                            <div class="col-md-4 col-sm-6 mb-30">
                                                <article class="blog-post">
                                                    <div class="post-thumbnail">
                                                        <a href="#"><img src="http://localhost/wordpress/wp-content/uploads/2020/12/4.jpg" alt=""></a>
                                                    </div>
                                                    <div class="post-content">
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
                                                endwhile;
                                            ?>
                                            <?php else : ?>
                                                <p>検索キーワードに該当する記事がありませんでした。</p>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-4 col-sm-12 sp_mt-50">
                                <?php get_sidebar('archive');?>
                            </div>
                        </div>
                    </div>
                </div>               
                <!-- Theme standard row End for Blog -->               
            </div>

<?php get_footer();?>
