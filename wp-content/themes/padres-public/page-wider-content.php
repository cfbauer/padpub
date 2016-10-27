<?php
/*
Template Name: Wider Content Area
*/
?>

<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package Padres Public
 * @since Padres Public 1.0
 */

get_header(); ?>

		<?php get_sidebar(); ?>

		<div id="primary" class="content-area">
			<div id="content" class="site-content" role="main">

				<?php while ( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'content', 'page' ); ?>

					<?php comments_template( '', true ); ?>

				<?php endwhile; // end of the loop. ?>

				<?php  if ( is_page('prospect-stalker') ) { ?>
					<p class="page-footer">Statistics courtesy milb.com.<br/>Calculated and formatted for Padres Public, solely for the enjoyment of their audience, by David F. Marver.</p>
				<?php } ?>

			</div><!-- #content .site-content -->
		</div><!-- #primary .content-area -->


<?php get_footer(); ?>