<?php global $mosacademy_options; ?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="keywords" content="">
  <meta name="description" content="">
  <meta name="author" content="Md. Mostak Shahid">
<!--   <link rel="stylesheet" href="css/bootstrap.min.css">

  <link rel="stylesheet" href="plugins/owlcarousel/assets/owl.carousel.min.css">
  <link rel="stylesheet" href="plugins/owlcarousel/assets/owl.theme.default.min.css">

  <link rel="stylesheet" href="css/main.css">
  <script src="js/jquery.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="plugins/owlcarousel/owl.carousel.min.js"></script>
  <script src="plugins/jquery.flip.min.js"></script>
  <script src="js/main.js"></script> -->
  <!--[if lt IE 9]>
  <script src="js/html5shiv.js"></script>
  <script src="js/respond.min.js"></script>
<![endif]-->
<!-- Favicons -->
<!-- <link rel="apple-touch-icon" href="<?php echo get_template_directory_uri(); ?>/images/favicon/apple-touch-icon.png" sizes="180x180">
<link rel="icon" href="<?php echo get_template_directory_uri(); ?>/images/favicon/favicon-32x32.png" sizes="32x32" type="image/png">
<link rel="icon" href="<?php echo get_template_directory_uri(); ?>/images/favicon/favicon-16x16.png" sizes="16x16" type="image/png">
<link rel="mask-icon" href="<?php echo get_template_directory_uri(); ?>/images/favicon/safari-pinned-tab.svg" color="#563d7c">
<link rel="icon" href="<?php echo get_template_directory_uri(); ?>/images/favicon/favicon.ico"> -->
<?php wp_head(); ?>
</head>
<body>
  <header id="main-header">
    <nav class="navbar navbar-expand-md fixed-top navbar-light navbar-custom-bg">
      <a class="navbar-brand" href="<?php echo home_url( '/' ); ?>">
      <?php if ($mosacademy_options['logo-option'] = 'logo') : ?>
        <img src="<?php echo $mosacademy_options['logo']['url']?>" alt="Logo">
      <?php else : ?>
        <?php echo bloginfo( 'name' ); ?>
      <?php endif; ?>
      </a>
       <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar" aria-controls="collapsibleNavbar" aria-expanded="false" aria-label="Toggle navigation">
         <span class="navbar-toggler-icon"></span>
       </button>
       <?php
       wp_nav_menu([
         'menu'            => 'mainmenu',
         'theme_location'  => 'mainmenu',
         'container'       => 'div',
         'container_id'    => 'collapsibleNavbar',
         'container_class' => 'collapse navbar-collapse',
         'menu_id'         => false,
         'menu_class'      => 'navbar-nav ml-auto',
         'depth'           => 2,
         'fallback_cb'     => 'bs4navwalker::fallback',
         'walker'          => new bs4navwalker()
       ]);
       ?>
    </nav>
  </header>
  <?php if (!is_front_page()) : ?>
  <section id="page-title">
    <div class="content-wrap">
      <div class="container">
        <?php 
        if (is_home()) :
          $page_for_posts = get_option( 'page_for_posts' );
          $title = get_the_title($page_for_posts);
        elseif (is_404()) :
          $title = '404 Page';
        else :
          $title = get_the_title();
        endif; 
        ?>
        <span class="heading"><?php echo $title ?></span>
      </div>
    </div>
  </section>
  <?php endif ?>