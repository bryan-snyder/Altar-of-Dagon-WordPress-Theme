<?php
// ASYNC LOAD JS FILES
function band_async_scripts($url)
{
    if ( strpos( $url, '#asyncload') === false )
        return $url;
    else if ( is_admin() )
        return str_replace( '#asyncload', '', $url );
    else
	return str_replace( '#asyncload', '', $url )."' async='async";
    }
add_filter( 'clean_url', 'band_async_scripts', 11, 1 );

//Load JS/CSS dependencies in header or footer
function enqueue_band_scripts() {
	wp_enqueue_script( 'bootstrap-js-cdn', '//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js#asyncload', array('jquery'), null, true);
	wp_enqueue_script( 'band-js' , get_template_directory_uri() . '/js/band.js', array('jquery'), null, true);
  wp_enqueue_script( 'retina-js' , get_template_directory_uri() . '/js/retina.min.js', array('jquery'), null, true);
	wp_enqueue_script( 'font-awesome-cdn', '//use.fontawesome.com/27505604f5.js#asyncload', false, null, true);
}
add_action('wp_enqueue_scripts', 'enqueue_band_scripts');

//Load CSS files
function enqueue_band_styles() {
  wp_enqueue_style( 'wp-styles', get_template_directory_uri() . '/style.css');
	wp_enqueue_style( 'bootstrap', '//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css' );
}
add_action('wp_enqueue_scripts', 'enqueue_band_styles');

//Add Bootstrap Responsive Image class to any uploaded image via dashboard.
function bootstrap_responsive_images( $html ){
  $classes = 'img-responsive'; // separated by spaces, e.g. 'img image-link'

  // check if there are already classes assigned to the anchor
  if ( preg_match('/<img.*? class="/', $html) ) {
    $html = preg_replace('/(<img.*? class=".*?)(".*?\/>)/', '$1 ' . $classes . ' $2', $html);
  } else {
    $html = preg_replace('/(<img.*?)(\/>)/', '$1 class="' . $classes . '" $2', $html);
  }
  // remove dimensions from images,, does not need it!
  $html = preg_replace( '/(width|height)=\"\d*\"\s/', "", $html );
  return $html;
}
add_filter( 'the_content','bootstrap_responsive_images',10 );
add_filter( 'post_thumbnail_html', 'bootstrap_responsive_images', 10 );
//End Responsive Imagery

//Responsive URL Video Embeds. Any copied/pasted or other media URL will be automatically made responsive.
//Currently set to 16:9 aspect ratio.
add_filter( 'embed_oembed_html', 'custom_oembed_filter', 10, 4 ) ;

function custom_oembed_filter($html, $url, $attr, $post_ID) {
    $return = '<div class="embed-responsive embed-responsive-16by9">'.$html.'</div><br />';
    return $return;
}

function band_theme_customize_register( $wp_customize ) {
 //=============================================================
 // Remove header image and widgets option from theme customizer
 //=============================================================
 $wp_customize->remove_control('header_image');
 $wp_customize->remove_panel('widgets');
 $wp_customize->remove_panel('nav_menus');
 //=============================================================
 // Remove Colors, Background image, and Static front page
 // option from theme customizer
 //=============================================================
 $wp_customize->remove_section('colors');
 $wp_customize->remove_section('background_image');
 $wp_customize->remove_section('static_front_page');
 $wp_customize->remove_section('title_tagline');
}
add_action( 'customize_register', 'band_theme_customize_register', 20 );

//begin blog page read more button
function excerpt_read_more_link($output) {
global $post;
return $output . '<a style="margin-bottom: 20px;" class="" href="?p='. get_the_ID($post->ID) . '"><button class="btn  btn-default">Read More...</button></a>';
}
add_filter('the_excerpt', 'excerpt_read_more_link');
//end blog page read more button

//begin pagination
function band_pagination($pages = '', $range = 2)
{
     $showitems = ($range * 2)+1;
     global $paged;
     if(empty($paged)) $paged = 1;
     if($pages == '')
     {
         global $wp_query;
         $pages = $wp_query->max_num_pages;
         if(!$pages)
         {
             $pages = 1;
         }
     }
     if(1 != $pages)
     {
         echo "<div class='pagination'>Page:&nbsp;";
         if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<a class='btn btn-default' href='".get_pagenum_link(1)."'><i class='fa fa-angle-double-left'></i></a>";
         if($paged > 1 && $showitems < $pages) echo "<a class='btn btn-default' href='".get_pagenum_link($paged - 1)."'><i class='fa fa-angle-left'></i></a>";
         for ($i=1; $i <= $pages; $i++)
         {
             if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
             {
                 echo ($paged == $i)? "<span class='btn btn-default '>".$i."</span>":"<a href='".get_pagenum_link($i)."' class='btn btn-default' >".$i."</a>";
             }
         }
         if ($paged < $pages && $showitems < $pages) echo "<a class='btn btn-default' href='".get_pagenum_link($paged + 1)."'><i class='fa fa-angle-right'></i></a>";
         if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<a class='btn btn-default' href='".get_pagenum_link($pages)."'><i class='fa fa-angle-double-right'></i></a>";
         global $wp_query;
         echo "&nbsp;of&nbsp;";
		 echo $wp_query->max_num_pages;
         echo "&nbsp;total pages</div>";
     }
}

//STYLE LOGIN SCREEN
function band_login_logo() { ?>
    <style type="text/css">
        .login h1 a {
          background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/img/altar_of_dagon_trans_logo.png) !important;
          background-size: 320px !important;
          width: 320px !important;
          height: 180px !important
        }
        body {
        	background: #070707 !important;
          background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/img/stressed_linen.png) !important;
          background-repeat: repeat
        }
        a:focus {
        	box-shadow: none;
        }
        .login #nav a {
          font-size: 14px !important;
          font-weight: bold !important;
        }
        .login #backtoblog a {
          font-size: 14px !important;
          font-weight: bold !important;
        }
        .login form {
        	background: #222 !important;
          background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/img/diagmonds.png) !important;
          border: 2px solid #ccc;
          border-radius: 5px;
          box-shadow: 0px 0px 20px #3dff3d,
          inset 0px 0px 2px #3dff3d !important;
        }
        .login form::before {
        	display: block;
        	content: "Website Admin Area";
        	margin-top: -20px;
        	padding-bottom: 20px;
        	font-size: 18px;
        	text-align: center;
          color: white !important;
        }
        .login label {
        	font-size: 16px !important;
        	font-weight: bold;
        	color: #3dff3d !important;
        }
        label[for=user_pass]:before {
        	content: "\f023 \2002";
        	font-family: FontAwesome;
        	color: #3dff3d;
        }
        label[for=user_login]:before {
        	content: "\f007 \2002";
        	font-family: FontAwesome;
        	color: #3dff3d;
        }
    </style>
<?php }
add_action( 'login_enqueue_scripts', 'band_login_logo' );

function band_login_logo_url() {
    return home_url();
}
add_filter( 'login_headerurl', 'band_login_logo_url' );

function band_login_logo_url_title() {
    return 'Altar of Dagon';
}
add_filter( 'login_headertitle', 'band_login_logo_url_title' );

//LOAD STYLES AND SCRIPTS ON LOGIN PAGE
function band_enqueue_style() {
	wp_enqueue_style( 'fontawesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css', false );
}
function band_enqueue_script() {
	wp_enqueue_script( 'retina-js' , get_template_directory_uri() . '/js/retina.min.js', false, null, true);
}
add_action( 'login_enqueue_scripts', 'band_enqueue_style', 10 );
add_action( 'login_enqueue_scripts', 'band_enqueue_script', 1 );


//ADMIN SECTION FAVICON ITEMS TO <head> SECTION
function bandFavicon() {
 echo '<link rel="Icon" type="image/x-icon" href="http://localhost/~adminsimac/altarofdagon/wp-content/themes/altarofdagon/img/favicon-32x32.png" />
 <link rel="Shortcut Icon" type="image/x-icon" href="http://localhost/~adminsimac/altarofdagon/wp-content/themes/altarofdagon/img/favicon-32x32.png" />';
 }
 add_action( 'login_head', 'bandFavicon' );
 add_action( 'admin_head', 'bandFavicon' );

//Change annoying "Howdy..." greeting
add_action( 'admin_bar_menu', 'wp_admin_bar_my_custom_account_menu', 11 );

function wp_admin_bar_my_custom_account_menu( $wp_admin_bar ) {
  $user_id = get_current_user_id();
  $current_user = wp_get_current_user();
  $profile_url = get_edit_profile_url( $user_id );

if ( 0 != $user_id ) {
  $avatar = get_avatar( $user_id, 28 );
  $howdy = sprintf( __('What it do %1$s?'), $current_user->display_name );
  $class = empty( $avatar ) ? '' : 'with-avatar';

$wp_admin_bar->add_menu( array(
  'id' => 'my-account',
  'parent' => 'top-secondary',
  'title' => $howdy . $avatar,
  'href' => $profile_url,
  'meta' => array(
  'class' => $class,
),
));
}}

//WP Helpers
show_admin_bar(false);
