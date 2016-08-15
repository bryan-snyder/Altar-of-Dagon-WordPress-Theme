<?php get_header(); ?>
<section id="readTheFuckingContent" data-speed="5" data-type="background">
  <div class="container">
    <br /><br /><br />
        <div class="col-md-12 well aod-well">
          <h1>News Archive</h1>
          <br />
          <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
            <div class="col-md-2">
              <br />
                <a href='<?php the_permalink() ?>' rel='bookmark' title='<?php the_title(); ?>'><?php the_post_thumbnail( 'full', array( 'class' => 'center-block img-thumbnail' ) ); ?></a>
                <p class="text-center"><small class="muted"><time><?php the_time('m/d/Y') ?></time></small><br /><small>by: <?php echo get_the_author(); ?></small><br /></p>
            </div>
            <div class="col-md-10">
              <h2><a style='color:#fff;' href='<?php the_permalink() ?>' rel='bookmark' title='<?php the_title(); ?>'><?php the_title(); ?></a></h2>
                <p><?php the_excerpt(); ?></p>
              <hr>
            </div>
            <?php endwhile; else: ?>
              <p><?php _e('Sorry, this page does not exist.' , 'altarofdagon' ); ?></p>
            <?php endif; ?>
            <br />
          <?php echo band_pagination(); ?>
        </div>
  </div>
<br /><br />
<br /><br />
</section>
<?php get_footer(); ?>
