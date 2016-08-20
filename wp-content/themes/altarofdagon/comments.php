<div>
  <?php if (have_comments()) : ?>
	<h4 class="altarGreen">This article currently has <?php comments_number( 'no coments', '1 comment', '% comments' ); ?>.</h4>
        <p><?php wp_list_comments(array('callback' => 'altarofdagon_comment')); ?><p>
        <?php if (get_comment_pages_count() > 1 && get_option('page_comments')) : ?>
            <nav>
                <div><?php previous_comments_link( _e('&larr; Older Comments', 'altarofdagon')); ?></div>
                <div><?php next_comments_link(_e('Newer Comments &rarr;', 'altarofdagon')); ?></div>
            </nav>
        <?php endif; // check for comment navigation ?>
        <?php elseif (!comments_open() && '0' != get_comments_number() && post_type_supports(get_post_type(), 'comments')) : ?>
            <p><?php _e('Comments are closed.', 'altarofdagon'); ?></p>
    <?php endif; ?>
	<?php comment_form(array(
      'title_reply'=>'Got Something To Say?',
      'label_submit'=> __( 'Post Comment' ),
    )); ?>
</div>
