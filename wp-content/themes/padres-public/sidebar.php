<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package Padres Public
 * @since Padres Public 1.0
 */
?>
		<div id="secondary" class="widget-area" role="complementary">
			<?php do_action( 'before_sidebar' ); ?>
			<?php if ( ! dynamic_sidebar( 'sidebar-1' ) ) : ?>

				<aside id="search" class="widget widget_search">
					<?php get_search_form(); ?>
				</aside>
				<aside id="archives" class="widget">
					<h1 class="widget-title"><?php _e( 'Archives', 'padres_public' ); ?></h1>
					<ul>
						<?php wp_get_archives( array( 'type' => 'monthly' ) ); ?>
					</ul>
				</aside>
				<aside id="meta" class="widget">
					<h1 class="widget-title"><?php _e( 'Meta', 'padres_public' ); ?></h1>
					<ul>
						<?php wp_register(); ?>
						<li><?php wp_loginout(); ?></li>
						<?php wp_meta(); ?>
					</ul>
				</aside>

			<?php endif; // end sidebar widget area ?>

			<?php dynamic_sidebar( 'top-sidebar' ) ?>

			<div class="blog-cards">
				<div class="blog-card sacrifice-bunt">
					<a href="<?php get_bloginfo( 'url' ); ?>/sacrifice-bunt">
						<h3>The Sacrifice Bunt</h3>
						<img src="<?php bloginfo( 'template_url' ); ?>/images/icon_sacrifice-bunt.png" alt="The Sacrifice Bunt" height="70" width="70" />
					</a>
				</div>
				<div class="blog-card rjs-fro">
					<a href="<?php get_bloginfo( 'url' ); ?>/rjs-fro">
						<h3>RJ's Fro</h3>
						<img src="<?php bloginfo( 'template_url' ); ?>/images/icon_rjs-fro.png" alt="RJ's Fro" height="70" width="70" />
					</a>
				</div>
				<div class="blog-card avenging-jack-murphy">
					<a href="<?php get_bloginfo( 'url' ); ?>/avenging-jack-murphy">
						<h3 class="long-name">Avenging Jack Murphy</h3>
						<img src="<?php bloginfo( 'template_url' ); ?>/images/icon_avenging-jack-murphy.png" alt="Avenging Jack Murphy" height="70" width="70" />
					</a>
				</div>
				<div class="blog-card ghost-of-ray-kroc">
					<a href="<?php get_bloginfo( 'url' ); ?>/ghost-of-ray-kroc">
						<h3>Ghost of Ray Kroc</h3>
						<img src="<?php bloginfo( 'template_url' ); ?>/images/icon_ghost-of-ray-kroc.png" alt="Ghost of Ray Kroc" height="70" width="70" />
					</a>
				</div>
				<div class="blog-card vocal-minority">
					<a href="<?php get_bloginfo( 'url' ); ?>/vocal-minority">
						<h3>Vocal Minority</h3>
						<img src="<?php bloginfo( 'template_url' ); ?>/images/icon_vocal-minority.png" alt="Vocal Minority" height="70" width="70" />
					</a>
				</div>
				<div class="blog-card padres-pints">
					<a href="<?php get_bloginfo( 'url' ); ?>/padres-and-pints/">
						<h3>Padres and Pints</h3>
						<img src="<?php bloginfo( 'template_url' ); ?>/images/icon_padres-and-pints.png" alt="Padres and Pints" height="70" width="70" />
					</a>
				</div>
				<div class="blog-card son-of-a-duck first">
					<a href="/son-of-a-duck">
						<h3>Son Of A Duck</h3>
						<img src="<?php bloginfo( 'template_url' ); ?>/images/icon_son-of-a-duck.png" alt="Son Of A Duck" height="70" width="70" />
					</a>
				</div>
				<div class="blog-card left-coast-bias">
					<a href="/left-coast-bias">
						<h3>Left Coast Bias</h3>
						<img src="<?php bloginfo( 'template_url' ); ?>/images/icon_left-coast-bias.png" alt="Left Coast Bias" height="70" width="70" />
					</a>
				</div>
				<div class="blog-card four-hundred">
					<a href="<?php get_bloginfo( 'url' ); ?>/400-in-94">
						<h3>.400 In '94</h3>
						<img src="<?php bloginfo( 'template_url' ); ?>/images/icon_400-in-94.png" alt="400 in 94" height="70" width="70" />
					</a>
				</div>
				<div class="blog-card padres-trail">
					<a href="<?php get_bloginfo( 'url' ); ?>/padres-trail">
						<h3>Padres Trail</h3>
						<img src="<?php bloginfo( 'template_url' ); ?>/images/icon_padres-trail.png" alt="Padres Trail" height="70" width="70" />
					</a>
				</div>
				<div class="blog-card woe-doctor">
					<a href="<?php get_bloginfo( 'url' ); ?>/woe-doctor">
						<h3>Woe, Doctor!</h3>
						<img src="<?php bloginfo( 'template_url' ); ?>/images/icon_woe-doctor.png" alt="Woe, Doctor!" height="70" width="70" />
					</a>
				</div>
				<div class="blog-card padres-prospects">
					<a href="<?php get_bloginfo( 'url' ); ?>/padres-prospects">
						<h3>Padres Prospects</h3>
						<img src="<?php bloginfo( 'template_url' ); ?>/images/icon_padres-prospects.png" alt="Padres Prospects" height="70" width="70" />
					</a>
				</div>

			</div><!-- blog-cards -->

			<?php dynamic_sidebar( 'bottom-sidebar' ) ?>

		</div><!-- #secondary .widget-area -->
