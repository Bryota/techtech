<!doctype html>
<html class="no-js" lang="ja">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title><?php if(!is_home()){wp_title('-',true,'right');}?><?php bloginfo('name');?></title>
        <?php if(is_single()):?>
        <meta name="description" content="<?php echo get_post_meta($post->ID, 'これなに', true);?>">
        <?php else:?>
        <meta name="description" content="プログラミングやIT業界に関して、学んだことや感じたことをてくてくと綴っていくブログ">
        <?php endif;?>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Place favicon.ico in the root directory -->
        <link rel="icon" href="<?php echo get_template_directory_uri();?>/img/icons/favicon.png">

        <!-- Fonts -->
        <link href='https://fonts.googleapis.com/css?family=Oswald:400,300,700' rel='stylesheet' type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=Lato:400,400italic,100,300,700,900' rel='stylesheet' type='text/css'>
        <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
        <!-- All CSS FILES -->
        <link rel="stylesheet" href="<?php echo get_template_directory_uri();?>/css/bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo get_template_directory_uri();?>/css/font-awesome.min.css">    
        <link rel="stylesheet" href="<?php echo get_template_directory_uri();?>/css/et-line-iocn.css">    
        <link rel="stylesheet" href="<?php echo get_template_directory_uri();?>/css/elements.css">    
        <link rel="stylesheet" href="<?php echo get_template_directory_uri();?>/style.css">
        <link rel="stylesheet" href="<?php echo get_template_directory_uri();?>/css/responsive.css">
        <link rel="stylesheet" href="<?php echo get_template_directory_uri();?>/css/additional.css">
        <!-- GA -->
        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-163452531-1"></script>
        <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', 'UA-163452531-1');
        </script>
        <!-- MODERNIZE JS -->
        <script>
            window.dataLayer = window.dataLayer || []
            dataLayer.push({
            'transactionId': '1234',
            'transactionAffiliation': 'testgtm',
            'transactionTotal': 11.11,
            'transactionTax': 1.11,
            'transactionShipping': 1,
            'transactionProducts': [{
                'sku': 'oo11',
                'name': 'test1',
                'category': 'test',
                'price': 11.1,
                'quantity': 1
            },{
                'sku': 'oo22',
                'name': 'test2',
                'category': 'test',
                'price': 11.1,
                'quantity': 1
            }]
            });
        </script>
        <!-- Google Tag Manager -->
            <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
            new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
            j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
            'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
            })(window,document,'script','dataLayer','GTM-5D3FG85');</script>
        <!-- End Google Tag Manager -->
        <script src="<?php echo get_template_directory_uri();?>/js/vendor/modernizr-2.8.3.min.js"></script>
        <?php wp_head();?>
    </head>
    <body>
        <!-- Google Tag Manager (noscript) -->
        <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5D3FG85"
        height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
        <!-- End Google Tag Manager (noscript) -->
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
        <!--  THEME PRELOADER AREA -->
        <div id="preloader-wrapper">
            <div class="preloader-wave-effect"></div>
        </div>
        <!-- THEME PRELOADER AREA END -->
        <!-- Main wrapper start -->
        <div class="wrapper">
            <!-- HEADER AREA -->
            <header id="sticky-header" class="header-area transperant-header">
                <div class="header-middle-area">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-5  col-sm-12 ">
                                <div class="logo">
                                    <h3><a href="<?php echo home_url(); ?>">てっくTech</a><br class="sp_only"><span class="logo_text">てくてくと日々をつづるブログ</span></h3>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
            </header>
            <!-- END HEADER AREA -->
