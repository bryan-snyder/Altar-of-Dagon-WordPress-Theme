<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php wp_title(); ?><?php bloginfo('description'); ?></title>
      <!-- favicon and branding icons -->
      <link rel="apple-touch-icon" sizes="57x57" href="<?php echo get_template_directory_uri(); ?>/img/apple-icon-57x57.png">
      <link rel="apple-touch-icon" sizes="60x60" href="<?php echo get_template_directory_uri(); ?>/img/apple-icon-60x60.png">
      <link rel="apple-touch-icon" sizes="72x72" href="<?php echo get_template_directory_uri(); ?>/img/apple-icon-72x72.png">
      <link rel="apple-touch-icon" sizes="76x76" href="<?php echo get_template_directory_uri(); ?>/img/apple-icon-76x76.png">
      <link rel="apple-touch-icon" sizes="114x114" href="<?php echo get_template_directory_uri(); ?>/img/apple-icon-114x114.png">
      <link rel="apple-touch-icon" sizes="120x120" href="<?php echo get_template_directory_uri(); ?>/img/apple-icon-120x120.png">
      <link rel="apple-touch-icon" sizes="144x144" href="<?php echo get_template_directory_uri(); ?>/img/apple-icon-144x144.png">
      <link rel="apple-touch-icon" sizes="152x152" href="<?php echo get_template_directory_uri(); ?>/img/apple-icon-152x152.png">
      <link rel="apple-touch-icon" sizes="180x180" href="<?php echo get_template_directory_uri(); ?>/img/apple-icon-180x180.png">
      <link rel="icon" type="image/png" sizes="192x192"  href="<?php echo get_template_directory_uri(); ?>/img/android-icon-192x192.png">
      <link rel="icon" type="image/png" sizes="32x32" href="<?php echo get_template_directory_uri(); ?>/img/favicon-32x32.png">
      <link rel="icon" type="image/png" sizes="96x96" href="<?php echo get_template_directory_uri(); ?>/img/favicon-96x96.png">
      <link rel="icon" type="image/png" sizes="16x16" href="<?php echo get_template_directory_uri(); ?>/img/favicon-16x16.png">
      <link rel="manifest" href="<?php echo get_template_directory_uri(); ?>/img/manifest.json">
      <meta name="msapplication-TileColor" content="#ffffff">
      <meta name="msapplication-TileImage" content="<?php echo get_template_directory_uri(); ?>/img/ms-icon-144x144.png">
      <meta name="theme-color" content="#ffffff">
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    <?php wp_head(); ?>
    <script src='https://www.google.com/recaptcha/api.js'></script>
    <script>
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

      ga('create', 'UA-80760313-1', 'auto');
      ga('send', 'pageview');
    </script>
  </head>
  <body <?php body_class(); ?>>
      <header>
        <nav class="navbar navbar-inverse navbar-fixed-top">
          <div class="container">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand" href="/"><img src="<?php echo get_template_directory_uri(); ?>/img/altar_of_dagon_trans_logo.png" alt="Altar of Dagon" width="70" class="altarLogo"></a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
              <?php wp_nav_menu( array(
                  'menu'              => 'primary',
          				'theme_location'    => 'primary',
          				'depth'             => 2,
          				'container'         => 'div',
          				'container_class'   => 'text-uppercase',
          				'menu_class'        => 'nav navbar-nav',
          				'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
          				'walker'            => new wp_bootstrap_navwalker())
              ); ?>
              <ul id="altarOfNavigation" class="nav navbar-nav navbar-right">
                <li><a title="Altar of Dagon on FaceBook" href="https://www.facebook.com/altarofdagon/" target="_blank"><i class="fa fa-facebook-official fa-fw fa-2x" aria-hidden="true"></i></a></li>
                <li><a title="Altar of Dagon on YouTube" href="https://www.youtube.com/user/AltarofDagonmusic" target="_blank"><i class="fa fa-youtube-square fa-fw fa-2x" aria-hidden="true"></i></a></li>
                <li><a title="Altar of Dagon on Twitter" href="https://twitter.com/AltarofDagon" target="_blank"><i class="fa fa-twitter-square fa-fw fa-2x" aria-hidden="true"></i></a></li>
                <li><a title="Altar of Dagon on Instagram" href="https://www.instagram.com/altar_of_dagon/" target="_blank"><i class="fa fa-instagram fa-fw fa-2x" aria-hidden="true"></i></a></li>
                <li><a title="Altar of Dagon on Google Plus" href="https://plus.google.com/u/0/107650889883554005981/about" target="_blank"><i class="fa fa-google-plus-square fa-fw fa-2x" aria-hidden="true"></i></a></li>
              </ul>
            </div>
          </div>
        </nav>
      <div class="alert alert-of-dagon text-center alert-dismissible fade in" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true"><i class="fa fa-times" aria-hidden="true"></i></span>
        </button>
        <?php dynamic_sidebar( 'event_bar_top' ); ?>
      </div>
      <section id="headerOfDagon" data-speed="6" data-type="background">
        <div class="container">
          <img src="<?php echo get_template_directory_uri(); ?>/img/aod_logo_large.png" class="band-logo img-responsive center-block" alt="Altar of Dagon" />
        </div>
      </section>
    </header>
