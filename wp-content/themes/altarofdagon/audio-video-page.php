<?php
/**
 * Template Name: Audio Video Page
 *
 * @package WordPress
 * @subpackage altarofdagon
 *
 */
get_header(); ?>
<div id="altarOfLoading">
<p style="margin-top:39%" class="text-center text-success">(( Loading... ))</p>
</div>
<section id="readTheFuckingContent" data-speed="5" data-type="background">
  <div class="container">
    <br /><br /><br />
        <div class="col-md-12 well aod-well">
          <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
          <h1 style="color:white;"><?php the_title(); ?></h1>
          <br />
          <?php the_post_thumbnail( 'full', array( 'class' => 'img-responsive' ) ); ?>
          <br />
          <?php the_content(); ?>
          <br />
          <br />
            <?php the_tags('<span class="label label-default">Topics:</span>&nbsp;&nbsp;'); ?>
        </div>
      <?php endwhile; else: ?>
        <p><?php _e('Sorry, this page does not exist.' , 'altarofdagon' ); ?></p>
    <?php endif; ?>
  </div>
<br /><br />
<br /><br />
</section>
<?php get_footer(); ?>
