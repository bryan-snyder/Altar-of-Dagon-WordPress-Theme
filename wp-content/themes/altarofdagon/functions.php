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

//WP Helpers
show_admin_bar(false);
