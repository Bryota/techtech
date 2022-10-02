            <?php get_header(); ?>
            <div class="intelligent-header-space"></div>
            <main class="content">
                <!-- Breadcrumb area start -->
                <div class="breadcrumb-area breadcrumb-style-3 gray-bg ptb-100">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-8 col-xs-12">
                                <?php
                                if (have_posts()) :
                                    while (have_posts()) : the_post();
                                        $category = get_the_category();
                                        $cat = $category[0];
                                        $cat_name = $cat->name;
                                        $cat_id = $cat->cat_ID;
                                        $prev_post = get_previous_post();
                                        $next_post = get_next_post(); // 次の投稿を取得
                                ?>
                                        <div class="breadcrumb-content">
                                            <h1 class="page-cat"><?php the_title(); ?></h1>
                                            <ul class="breadcrumb-list">
                                                <li><a href="<?php echo home_url(); ?>">トップページ</a></li>
                                                <li><a href="<?php echo get_category_link($cat_id); ?>"><?php echo $cat_name; ?></a></li>
                                                <li><?php the_title(); ?></li>
                                            </ul>
                                        </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Breadcrumb area end -->
                <!-- Theme standard row Start for Blog -->
                <div class="adam-standard-row ptb-80">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-9 col-md-8">
                                <article class="single-post single-blog-post-area" id="post-<?php the_ID(); ?>">
                                    <?php the_post_thumbnail('large'); ?>
                                    <div class="post-content">
                                        <header>
                                            <h2 class="blog-post-title single-post-title"><?php the_title(); ?></h2>
                                            <div class="post-meta">
                                                <span class="post-time"><?php the_time('Y年m月d日'); ?></span>
                                            </div>
                                        </header>
                                        <section>
                                            <?php the_content(); ?>
                                            <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-8039290321071206" crossorigin="anonymous"></script>
                                            <ins class="adsbygoogle" style="display:block; text-align:center;" data-ad-layout="in-article" data-ad-format="fluid" data-ad-client="ca-pub-8039290321071206" data-ad-slot="1433813359"></ins>
                                            <script>
                                                (adsbygoogle = window.adsbygoogle || []).push({});
                                            </script>
                                        </section>
                                    </div>
                                </article>
                                <div class="post-navigation-wrapper">
                                    <a href="<?php echo get_permalink($prev_post->ID); ?>" class="post-navigation previous-post"><i class="fas fa-arrow-left"></i>前へ</a>
                                    <a href="<?php echo get_permalink($next_post->ID); ?>" class="post-navigation next-post">次へ<i class="fas fa-arrow-right"></i></a>
                                </div>
                        <?php
                                    endwhile;
                                endif;
                        ?>
                            </div>
                            <div class="col-lg-3 col-md-4">
                                <?php get_sidebar('single'); ?>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Theme standard row End for Blog -->
            </main>
            <?php get_footer(); ?>
