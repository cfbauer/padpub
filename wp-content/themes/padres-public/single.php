<?php
/**
 * The Template for displaying all single posts.
 *
 * @package Padres Public
 * @since Padres Public 1.0
 */

get_header(); ?>
		<?php get_sidebar(); ?>

		<div id="primary" class="content-area">
			<div id="content" class="site-content" role="main">

			<?php while ( have_posts() ) : the_post(); ?>

				<?php // padres_public_content_nav( 'nav-above' ); ?>

				<?php get_template_part( 'content', 'single' ); ?>

				<?php padres_public_content_nav( 'nav-below' ); ?>

				<?php if ( comments_open() ) { ?>
					<p class="comment-instructions">You are encouraged to comment using an exisitng Twitter, Facebook, or Google account. Upvote comments you find helpful, and only downvote comments that do not belong. The downvote is not a 'disagree' button.</p>

				<?php } ?>


				<?php
					// If comments are open or we have at least one comment, load up the comment template
					if ( comments_open() || '0' != get_comments_number() )
						comments_template( '', true );
				?>

			<?php endwhile; // end of the loop. ?>

			</div><!-- #content .site-content -->
		</div><!-- #primary .content-area -->

<?php get_footer(); ?>