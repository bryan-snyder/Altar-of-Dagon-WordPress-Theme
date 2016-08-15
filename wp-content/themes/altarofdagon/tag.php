<?php get_header(); ?>
<section id="readTheFuckingContent" data-speed="5" data-type="background">
  <div class="container">
    <br /><br />
    <br />
        <div class="col-md-12 well aod-well">
          <h1>Posts or Pages Tagged With <small class="altarGreen">"<?php single_tag_title(); ?>"</small></h1>
          <br />
          <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
            <h2><a style='color:#fff;' href='<?php the_permalink() ?>' rel='bookmark' title='<?php the_title(); ?>'><?php the_title(); ?></a></h2>
            <p><?php the_excerpt(); ?></p>
            <hr>
          <?php endwhile; else: ?>
            <p><?php _e('Sorry, this page does not exist.' , 'altarofdagon' ); ?></p>
          <?php endif; ?>
        </div>
      <br />
      <?php echo band_pagination(); ?>
  </div>
<br /><br />
<br /><br />
</section>
<?php get_footer(); ?>
