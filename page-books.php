<?php
/*
Template Name: 100文字読書
*/
?>
<?php get_header();?>
<div class="intelligent-header-space"></div>
<main class="content">
    <!-- Breadcrumb area start -->
    <div class="breadcrumb-area breadcrumb-style-3 gray-bg ptb-100">
        <div class="container">
            <div class="row">
                <div class="col-sm-8 col-xs-12">
                <?php 
                    if(have_posts()):
                        while(have_posts()): the_post();
                        $category = get_the_category();
                        $cat = $category[0];
                        $cat_name = $cat->name;
                        $cat_id = $cat->cat_ID;
                        $prev_post = get_previous_post();
                        $next_post = get_next_post(); 
                        ?>
                    <div class="breadcrumb-content">
                        <h1 class="page-cat"><?php the_title(); ?></h1>
                        <ul class="breadcrumb-list">
                            <li><a href="<?php echo home_url(); ?>">トップページ</a></li>
                            <li><a href="/books">100文字読書</a></li>
                        </ul>
                    </div>
                <?php
                    endwhile;
                    endif;
                    wp_reset_postdata();
                    ?>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb area end -->     
    <!-- Theme standard row Start for Blog -->
    <div class="adam-standard-row ptb-80">
        <div class="container">                    
            <div class="row">
                <div class="col-lg-9 col-md-8 col-sm-12">
                    <div class="row">
                        <div class="col-md-12 mb-10">
                            <h3 class="blog_type blog_popular text-center">～100文字読書～</h3>
                        </div>
                    </div>
                    <div class="row mb-30">
                    <?php
                    $books = get_posts(array(
                        'post_type' => 'books',
                        'orderby' => 'date',
                        'order' => 'DESC',
                    ));
                    foreach($books as $book): setup_postdata($book); ?>
                        <div class="col-12 white-bg shadow-bg p-20 pb-10 pt-10 mb-20">
                            <p class="mb-0 text-center h3 mt-0"><a href="<?php echo get_post_meta($book->ID, 'url', true);?>"><?php echo get_the_title($book->ID);?></a></p>
                            <p class="mb-0 text-center h5 mt-1 mb-10"><?php echo get_the_date('Y年m月d日', $book->ID);?> </p>
                            <p><?php the_content();?></p>
                        </div>
                    <?php endforeach; wp_reset_postdata(); ?>
                    </div>
                </div>                       
                <div class="col-lg-3 col-md-4">
                    <?php get_sidebar('single');?>
                </div> 
            </div>
        </div>
    </div>               
    <!-- Theme standard row End for Blog -->               
</main>
<?php get_footer(); ?>
