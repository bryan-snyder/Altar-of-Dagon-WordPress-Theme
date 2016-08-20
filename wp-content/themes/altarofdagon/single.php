<?php get_header(); ?>
<section id="readTheFuckingContent" data-speed="5" data-type="background">
  <div class="container">
    <br /><br /><br />
      <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
        <div class="col-md-12 well aod-well">
          <h1 style="color:white;"><?php the_title(); ?></h1>
            <div class="row">
              <div class="col-lg-1">
                <?php echo get_avatar( get_the_author_meta( 'ID' ), 80 ); ?>
              </div>
              <div class="col-lg-11">
                <small class="muted"><time><?php the_time('m/d/Y') ?></time></small>
                <br /><small>by: <?php echo get_the_author(); ?></small>
              </div>
            </div>
          <br />
          <?php the_post_thumbnail( 'full', array( 'class' => 'img-responsive' ) ); ?>
            <br /><br />
              <?php the_content(); ?>
            <br /><br />
              <?php the_tags('<span class="label label-default">Topics:</span>&nbsp;&nbsp;'); ?>
            <hr>
          <?php endwhile; else: ?>
            <p><?php _e('Sorry, this page does not exist.' , 'altarofdagon' ); ?></p>
          <?php endif; ?>
          <?php comments_template(); ?>
        </div>
  </div>
<br /><br />
<br /><br />
</section>
<?php get_footer(); ?>
