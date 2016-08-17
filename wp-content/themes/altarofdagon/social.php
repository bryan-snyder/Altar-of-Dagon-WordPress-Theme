<?php
/**
 * Template Name: Social Media Page
 *
 * @package WordPress
 * @subpackage altarofdagon
 *
 */
get_header(); ?>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.7&appId=189708607762706";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<div id="altarOfLoading"></div>
<section id="readTheFuckingContent" data-speed="5" data-type="background">
  <div class="container">
    <br /><br /><br />
        <div class="col-md-12 well aod-well">
          <h1 style="color:white;">AOD Social Media Outlets</h1>
            <div class="row">
              <div class="col-md-6">
                <h2 class="altarGreen"><i class="fa fa-facebook-square fa-fw" aria-hidden="true"></i> FaceBook</h2>
                <div class="fb-page" data-href="https://www.facebook.com/altarofdagon/" data-tabs="timeline" data-width="500px" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/altarofdagon/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/altarofdagon/">Altar of Dagon</a></blockquote></div>
              </div>
              <div class="col-md-6">
                <h2 class="altarGreen"><i class="fa fa-twitter-square fa-fw" aria-hidden="true"></i> Twitter</h2>
                <a class="twitter-timeline" data-lang="en" data-height="500" href="https://twitter.com/AltarofDagon">Tweets by AltarofDagon</a> <script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>
              </div>
              <div class="col-md-6">
                <h2 class="altarGreen"><i class="fa fa-youtube-square fa-fw" aria-hidden="true"></i> YouTube</h2>
                  <div class="embed-responsive embed-responsive-4by3">
                    <iframe class="embed-responsive-item" src="http://www.youtube.com/embed/?listType=user_uploads&list=AltarofDagonmusic"></iframe>
                  </div>
              </div>
              <div class="col-md-6">
                <h2 class="altarGreen"><i class="fa fa-instagram fa-fw" aria-hidden="true"></i> Instagram</h2>
                <script src="//lightwidget.com/widgets/lightwidget.js"></script>
                <iframe src="//lightwidget.com/widgets/424f98e34430a3a720abc03882b73c051938795c.html" id="lightwidget_424f98e344" name="lightwidget_424f98e344" scrolling="no" allowtransparency="true" class="lightwidget-widget" style="width: 100%; border: 0; overflow: hidden;"></iframe>
              </div>
            </div>
        </div>
  </div>
  <br /><br />
  <br /><br />
</section>
<?php get_footer(); ?>
