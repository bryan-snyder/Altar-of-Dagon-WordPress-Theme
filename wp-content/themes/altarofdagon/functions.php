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
add_filter( 'clean_url', 'band_async_scripts',11,1);

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

//Custom Widget Areas
register_sidebar(array(
  'name' => __( 'Top Event Bar Widget Area' , 'altarofdagon' ),
  'id' => 'event_bar_top',
  'description' => __( 'Info for next event that shows up at the top of every page - Text Widget Area Only' , 'altarofdagon' ),
  'before_widget' => '',
  'after_widget'  => '',
  'before_title' => '',
  'after_title' => ''
));

//WooCommerce Support
add_action( 'after_setup_theme', 'woocommerce_support' );
function woocommerce_support() {
    add_theme_support( 'woocommerce' );
}
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
add_filter( 'the_content','bootstrap_responsive_images',10);
add_filter( 'post_thumbnail_html', 'bootstrap_responsive_images',10);
//End Responsive Imagery

// Register Custom Navigation Walker
require_once('wp_bootstrap_navwalker.php');
register_nav_menus( array(
	'primary' => __( 'Altar of Navigation', 'altarofdagon' ),
));

//Responsive URL Video Embeds. Any copied/pasted or other media URL will be automatically made responsive.
//Currently set to 16:9 aspect ratio.
add_filter( 'embed_oembed_html', 'custom_oembed_filter',10,4);

function custom_oembed_filter($html, $url, $attr, $post_ID) {
    $return = '<div class="embed-responsive embed-responsive-16by9">'.$html.'</div><br />';
    return $return;
}
// add tag support to pages
function tags_support_all() {
	register_taxonomy_for_object_type('post_tag', 'page');
}

// ensure all tags are included in queries
function tags_support_query($wp_query) {
	if ($wp_query->get('tag')) $wp_query->set('post_type', 'any');
}

// tag hooks
add_action('init', 'tags_support_all');
add_action('pre_get_posts', 'tags_support_query');

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
add_action( 'customize_register', 'band_theme_customize_register',20);

//begin blog page read more button
function excerpt_read_more_link($output) {
global $post;
return $output . '<a class="btn btn-default" href="?p='. get_the_ID($post->ID) . '">Read more <i class="fa fa-angle-double-right fa-fw" aria-hidden="true"></i></a>';
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
          background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/img/altar_of_dagon_trans_logo.png) !important; /*Artist Specific Image*/
          background-size: 320px !important;
          width: 320px !important;
          height: 180px !important
        }
        @media (max-width: 768px) {
        .login h1 a {
          background-size: 300px !important;
          width: 300px !important;
          height: 160px !important
        }}
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
        @media (max-width: 768px) {
        .login form {
          width: 230px;
          margin-left: 19px !important
        }}
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
    return 'Return to altarofdagon.com'; //Artist specific
}
add_filter( 'login_headertitle', 'band_login_logo_url_title' );

//LOAD SCRIPTS ON LOGIN PAGE
function band_enqueue_script() {
	wp_enqueue_script( 'retina-js' , get_template_directory_uri() . '/js/retina.min.js', false, null, true);
  wp_enqueue_script( 'font-awesome-dashboard', '//use.fontawesome.com/27505604f5.js', false, null, true);
}
add_action( 'login_enqueue_scripts', 'band_enqueue_script',1);


//ADMIN SECTION FAVICON ITEMS TO <head> SECTION
function bandFavicon() {
 echo '<link rel="Icon" type="image/x-icon" href="http://localhost/~adminsimac/altarofdagon/wp-content/themes/altarofdagon/img/favicon-32x32.png" />
 <link rel="Shortcut Icon" type="image/x-icon" href="http://localhost/~adminsimac/altarofdagon/wp-content/themes/altarofdagon/img/favicon-32x32.png" />';
 }
 add_action( 'login_head', 'bandFavicon' );
 add_action( 'admin_head', 'bandFavicon' );

//Change annoying "Howdy..." greeting
add_action( 'admin_bar_menu', 'wp_admin_bar_my_custom_account_menu',11);

function wp_admin_bar_my_custom_account_menu( $wp_admin_bar ) {
  $user_id = get_current_user_id();
  $current_user = wp_get_current_user();
  $profile_url = get_edit_profile_url( $user_id );

if ( 0 != $user_id ) {
  $avatar = get_avatar( $user_id, 28 );
  $howdy = sprintf( __('%1$s, welcome back bro!'), $current_user->display_name ); //Artist specific
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

// disable default dashboard widgets
function disable_default_dashboard_widgets() {
	//remove_meta_box('dashboard_right_now', 'dashboard', 'core');
	remove_meta_box('dashboard_activity', 'dashboard', 'core');
	remove_meta_box('dashboard_recent_comments', 'dashboard', 'core');
	remove_meta_box('dashboard_incoming_links', 'dashboard', 'core');
	remove_meta_box('dashboard_plugins', 'dashboard', 'core');
	remove_meta_box('dashboard_quick_press', 'dashboard', 'core');
	remove_meta_box('dashboard_recent_drafts', 'dashboard', 'core');
	remove_meta_box('dashboard_primary', 'dashboard', 'core');
	remove_meta_box('dashboard_secondary', 'dashboard', 'core');
}
add_action('admin_menu', 'disable_default_dashboard_widgets');

//WP Helpers
show_admin_bar(false);
add_theme_support( 'post-thumbnails' );


/**
 * Display template for comments and pingbacks.
 *
 */
if (!function_exists('altarofdagon_comment')) :
    function altarofdagon_comment($comment, $args, $depth)
    {
        $GLOBALS['comment'] = $comment;
        switch ($comment->comment_type) :
            case 'pingback' :
            case 'trackback' : ?>

                <span id="comment-<?php comment_ID(); ?>">
                    <div class="panel panel-warning">
                        <div class="panel-heading">
                            <h4 class="text-center"><?php _e('<i class="fa fa-share-alt-square fa-fw fa-lg"></i>&nbsp;Pingback:', 'altarofdagon'); ?></h4>
                        </div>
                        <div class="panel-body">
                            <p><?php comment_author_link(); ?><p>
                        </div>
                    </div>
                <?php
                break;
            default :
                // Proceed with normal comments.
                global $post; ?>
                <p id="li-comment-<?php comment_ID(); ?>">
                    <div itemprop="comment">
                        <div class="panel panel-success">
                        	<div class="panel-heading">
                        		<?php echo get_avatar($comment, 64); ?>
                        		<h4><?php
                                printf('<p class="text-uppercase">%1$s %2$s</p>',
                                    get_comment_author_link(),
                                    // If current post author is also comment author, make it known visually.
                                    ($comment->user_id === $post->post_author) ? '<br /><span class="label label-danger"><i class="fa fa-pencil-square-o fa-lg" aria-hidden="true"></i></i> ' . __(
                                        'Post author',
                                        'altarofdagon'
                                    ) . '</span> ' : ''); ?>
                            	</h4>
                        	</div>
                            <div class="panel-body">
                            <p><small>
                                	<?php printf('<a href="%1$s"><time datetime="%2$s">%3$s</time></a>',
                                           	 	esc_url(get_comment_link($comment->comment_ID)),
                                            	get_comment_time('c'),
                                            	sprintf(
                                                	__('%1$s at %2$s', 'altarofdagon'),
                                                	get_comment_date(),
                                                	get_comment_time()
                                            	)
                                    ); ?>
                            </small></p>
                            <?php if ('0' == $comment->comment_approved) : ?>
                                <p class="alert alert-danger"><?php _e(
                                    'Your comment is awaiting moderation.',
                                    'altarofdagon'
                                ); ?></p>
                            <?php endif; ?>
                            <?php comment_text(); ?>
                            <p>
                                <?php comment_reply_link( array_merge($args, array(
                                            'reply_text' => __('<button class="btn btn-primary btn-sm"><i class="fa fa-comments-o fa-lg" aria-hidden="true"></i>&nbsp;Reply</button>', 'altarofdagon'),
                                            'depth'      => $depth,
                                            'max_depth'  => $args['max_depth']
                                        )
                                    )); ?>
                            </p>
                        </div>
                    </div>
                </div>
                <?php
                break;
        endswitch;
    }
endif;

//begin url link for comments override
add_filter('comment_form_default_fields', 'url_filtered');
function url_filtered($fields)
{
if(isset($fields['url']))
unset($fields['url']);
return $fields;
}
//end url link comment override

add_filter( 'comment_form_defaults', 'twentyelevenchild_modify_comment_fields' );

function twentyelevenchild_modify_comment_fields( $fields ) {
$user = wp_get_current_user();
$user_identity = $user->exists() ? $user->display_name : '';
$fields['logged_in_as'] = '<p class="logged-in-as">' . sprintf( __( 'Logged in as <a href="%1$s">%2$s</a><br /><a style="margin-top:10px;" class="btn btn-danger btn-sm" href="%3$s" title="Log out of this account">Log out <i class="fa fa-sign-out fa-fw fa-lg" aria-hidden="true"></i></a>' ), admin_url( 'profile.php' ), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink( ) ) ) ) . '</p>';

return $fields;
}
add_filter( 'comment_form_defaults', 'bootstrap3_comment_form' );
function bootstrap3_comment_form( $args ) {
    $args['comment_field'] = '<div class="form-group comment-form-comment">
            <label for="comment">' . _x( '<span class="altarGreen">Talk some shit!</span>', 'noun' ) . '</label>
            <textarea class="form-control" id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea>
        </div>';
    $args['class_submit'] = 'btn btn-success';

    return $args;
}

add_filter( 'comment_form_default_fields', 'bootstrap3_comment_form_fields' );
function bootstrap3_comment_form_fields( $fields ) {
    $commenter = wp_get_current_commenter();

    $req      = get_option( 'require_name_email' );
    $aria_req = ( $req ? " aria-required='true'" : '' );
    $html5    = current_theme_supports( 'html5', 'comment-form' ) ? 1 : 0;

    $fields   =  array(
        'author' => '<div class="form-group comment-form-author">' . '<label for="author">' . __( 'Name' ) . ( $req ? ' <span class="required">*</span>' : '' ) . '</label> ' .
                    '<input class="form-control" id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' /></div>',
        'email'  => '<div class="form-group comment-form-email"><label for="email">' . __( 'Email' ) . ( $req ? ' <span class="required">*</span>' : '' ) . '</label> ' .
                    '<input class="form-control" id="email" name="email" ' . ( $html5 ? 'type="email"' : 'type="text"' ) . ' value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' /></div>',
    );

    return $fields;
}
