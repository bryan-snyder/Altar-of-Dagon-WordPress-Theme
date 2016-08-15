<?php get_header(); ?>
<div id="altarOfLoading"></div>
  <section id="homeOfDagon" data-speed="4" data-type="background">
    <div class="container">
      <div id="altarOfbandPics">
        <img src="<?php echo get_template_directory_uri(); ?>/img/altar-of-dagon-members.png" alt="Altar of Dagon lineup 2016" class="img-responsive" />
      </div>
      <div class="col-md-12 well aod-well">
        <h1>Altar of Dagon <small>Newark, Delaware</small></h1>
          <p>When you listen to Altar of Dagon: Be prepared for a voyage to places that exist only in your darkest nightmares and fantasy realms. Heavy guitar riffs, thunderous bass and drums and eerie, clean vocals, primal screams, and backing abyssal gutturals give you an idea of what Altar of Dagon is all about!</p>
          <p><a class="btn btn-success" href="<?php echo get_site_url(); ?>/biography/">Read More <i class="fa fa-angle-double-right fa-fw fa-lg" aria-hidden="true"></i></a></p>
      </div>
    </div>
  </section>
  <section id="buyTheGodDamnedAlbum" data-speed="2" data-type="background">
    <div class="container">
      <div class="page-header">
        <h1>Buy the Album: <small><span class="altarGreen">"Nacht Der Untoten"</span> is available now!</small></h1>
      </div>
      <div class="row">
        <div class="col-md-4">
          <img src="<?php echo get_template_directory_uri(); ?>/img/nacht-der-untoten-cover.png" alt="Altar of Dagon - Nacht Der Untoten" class="img-responsive center-block" />
        </div>
        <div class="col-md-4">
          <h2>Track List <br /><small class="text-muted">Released: 07/04/2016</small></h2>
            <ol>
              <li>Nacht Der Untoten <small class="text-muted">[5:55]</small></li>
              <li>Tag Danach <small class="text-muted">[4:14]</small></li>
              <li>Dealbreaker <small class="text-muted">[4:01]</small></li>
              <li>Dagonian Death Rider <small class="text-muted">[4:00]</small></li>
              <li>Cthulhu Calling <small class="text-muted">[3:15]</small></li>
              <li>Space Metal Juggernaut <small class="text-muted">[7:15]</small></li>
              <li>Seer of Six <small class="text-muted">[8:40]</small></li>
              <li>Ahnruk Skullsplitter <small class="text-muted">[5:57]</small></li>
              <li>Darsha and Molivan <small class="text-muted">[5:50]</small></li>
              <li>The Runner <small class="text-muted">[4:35]</small></li>
            </ol>
        </div>
          <span class="visible-xs"><br /></span>
        <div class="col-md-4">
          <iframe src="//tools.applemusic.com/embed/v1/album/1131912268?country=us" height="425" width="100%"></iframe>
        </div>
      </div>
      <br />
      <br />
      <p class="text-center">Buy now from these online stores:</p>
      <br />
      <div class="row">
        <div class="col-md-3">
          <a class="btn btn-success btn-lg btn-block" target="_blank" href="https://itunes.apple.com/us/album/nacht-der-untoten/id1131912268?app=music&ign-mpt=uo%3D4"><i class="fa fa-apple fa-fw fa-lg" aria-hidden="true"></i> iTunes Store</a>
        </div>
        <span class="visible-xs visible-sm"><br /></span>
        <div class="col-md-3">
          <a class="btn btn-success btn-lg btn-block" target="_blank" href="https://www.amazon.com/Nacht-Untoten.../dp/B01I2DRYR8"><i class="fa fa-amazon fa-fw fa-lg" aria-hidden="true"></i> Amazon</a>
        </div>
        <span class="visible-xs visible-sm"><br /></span>
        <div class="col-md-3">
          <a class="btn btn-success btn-lg btn-block" target="_blank" href="https://play.google.com/store/music/album/Altar_of_Dagon_Nacht_Der_Untoten?id=Bitxr3qw5uhm47mdxwgbg7uvwpi"><i class="fa fa-google fa-fw fa-lg" aria-hidden="true"></i> Google Play</a>
        </div>
        <span class="visible-xs visible-sm"><br /></span>
        <div class="col-md-3">
          <a class="btn btn-success btn-lg btn-block" target="_blank" href="https://altarofdagon.bandcamp.com/album/nacht-der-untoten"><img style="margin-top:-5px;" src="<?php echo get_template_directory_uri(); ?>/img/bandcamp.png" alt="BandCamp" width="60" />&nbsp;&nbsp;BandCamp</a>
        </div>
      </div>
    </div>
  </section>
  <section id="preFooterOfDagon" data-speed="8" data-type="background">
    <div class="container">
      <div class="col-md-12 well aod-well">
        <h1 class="altarGreen"><u>Latest News</u>:</h1>
        <br />
          <?php $my_query = new WP_Query( 'category=altar-of-dagon&posts_per_page=2' );
            while ( $my_query->have_posts() ) : $my_query->the_post();
              $do_not_duplicate[] = $post->ID; ?>
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
            <?php endwhile; ?>
          <div class="clearfix"></div>
          <br />
        <a class="btn btn-success btn-lg btn-block" href="<?php echo get_site_url(); ?>/news/">News Archive <i class="fa fa-angle-double-right fa-fw fa-lg" aria-hidden="true"></i></a>
        <br />
      </div>
    </div>
  </section>
<?php get_footer(); ?>
