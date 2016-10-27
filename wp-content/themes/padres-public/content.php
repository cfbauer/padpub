<?php
/**
 * @package Padres Public
 * @since Padres Public 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="all-meta">
		<header class="entry-header">
			<h1 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'padres_public' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h1>


			<div class="entry-meta">
				<?php padres_public_posted_on(); ?>
			</div><!-- .entry-meta -->

		</header><!-- .entry-header -->

		<footer class="entry-meta">
			<?php
				/* translators: used between list items, there is a space after the comma */
				$categories_list = get_the_category_list( __( '&nbsp;', 'padres_public' ) );
				if ( $categories_list && padres_public_categorized_blog() ) :
			?>
			<span class="cat-links">
				<?php printf( __( '%1$s', 'padres_public' ), $categories_list ); ?>
			</span>
			<?php endif; // End if categories ?>

			<?php
				/* translators: used between list items, there is a space after the comma */
				$tags_list = get_the_tag_list( '', __( ', ', 'padres_public' ) );
				if ( $tags_list && !is_front_page() ) :
			?>
			<br/>
			<span class="tags-links">
				<?php printf( __( 'Tagged %1$s', 'padres_public' ), $tags_list ); ?>
			</span>
			<?php endif; // End if $tags_list ?>

			<?php if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) : ?>
			<br/>
			<span class="comments-link"><?php comments_popup_link( __( 'Leave a comment', 'padres_public' ), __( '1', 'padres_public' ), __( '%', 'padres_public' ) ); ?></span>
			<?php endif; ?>

			<?php edit_post_link( __( 'Edit', 'padres_public' ), '<br/><span class="edit-link">', '</span>' ); ?>
		</footer><!-- .entry-meta -->

	</div>

	<?php if ( is_search() ) : // Only display Excerpts for Search ?>
		<div class="entry-summary">
			<?php the_excerpt(); ?>
		</div><!-- .entry-summary -->
		<?php else : ?>
		<div class="entry-content">
			<?php the_content('Read More...'); ?>
			<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'padres_public' ), 'after' => '</div>' ) ); ?>
		</div><!-- .entry-content -->
	<?php endif; ?>
</article><!-- #post-<?php the_ID(); ?> -->
