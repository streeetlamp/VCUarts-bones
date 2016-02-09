<?php
/**
 * Author: VCUarts
 * URL: http://arts.vcu.edu
 *
 * @package VCUarts_Bones_WP
 */

get_template_part( 'library/templates/the-header' );

	if ( ! have_posts() ) :
		get_template_part( 'library/templates/not-found' );
	endif;

	while ( have_posts() ) : the_post(); ?>

		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

			<header class="article-header">
				<h2 class="entry-title"><a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
			</header>

			<section class="entry-content">
				<?php the_content(); ?>
			</section>

		</article>

	<?php endwhile; ?>

	<?php bones_page_navi(); ?>

<?php get_template_part( 'library/templates/the-footer' );
