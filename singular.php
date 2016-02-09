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

      <header class="article-header entry-header">
        <h1 class="entry-title single-title"><?php the_title(); ?></h1>
      </header>

      <section class="entry-content">
        <?php the_content(); ?>
      </section>

    </article> <?php // end article ?>

  <?php endwhile; ?>

<?php get_template_part( 'library/templates/the-footer' );
