<?php get_header(); ?>

			<div class="content">
				<div class="inner-content">
					<main class="main" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">

							<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

							<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> role="article">
								<header class="entry-header article-header">

									<h3 class="h2 entry-title">
                    <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
                  </h3>

									<p class="byline entry-meta vcard">
                    <time class="updated entry-time" datetime="<?php get_the_time('Y-m-d'); ?>" itemprop="datePublished">
                      <?php get_the_time('Y-m-d'); ?>
                    </time>
									</p>

								</header>

								<section class="entry-content">

									<?php the_post_thumbnail( 'bones-thumb-300' ); ?>
									<?php the_excerpt(); ?>

								</section>

							</article>

							<?php endwhile; ?>

									<?php bones_page_navi(); ?>

							<?php else : ?>

									<article id="post-not-found" class="hentry">
										<h2>Post not found.</h2>
									</article>

							<?php endif; ?>

						</main>

				</div>
			</div>

<?php get_footer(); ?>
