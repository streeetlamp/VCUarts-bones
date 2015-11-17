<?php get_template_part('library/templates/the-header'); ?>

	<?php if (!have_posts()) :
		get_template_part('library/templates/not-found');
	endif; ?>

	<?php while (have_posts()) : the_post(); ?>

		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

			<header class="article-header">
				<h1 class="entry-title"><a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h1>
			</header>

			<section class="entry-content">
				<?php the_content(); ?>
			</section>

		</article>

	<?php endwhile; ?>

	<?php bones_page_navi(); ?>

<?php get_template_part('library/templates/the-footer'); ?>
