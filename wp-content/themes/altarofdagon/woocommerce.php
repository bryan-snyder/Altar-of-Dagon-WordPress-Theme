<?php get_header(); ?>
<section id="readTheFuckingContent" data-speed="5" data-type="background">
  <div class="container">
    <br /><br /><br />
        <div class="col-md-12 well aod-well">
          <?php woocommerce_content(); ?>
          <h1 style="color:white;"><?php the_title(); ?></h1>
          <br />
          <?php the_post_thumbnail( 'full', array( 'class' => 'img-responsive' ) ); ?>
          <br />
          <?php the_content(); ?>
          <br />
          <br />
            <?php the_tags('<span class="label label-default">Topics:</span>&nbsp;&nbsp;'); ?>
        </div>
  </div>
<br /><br />
<br /><br />
</section>
<?php get_footer(); ?>
