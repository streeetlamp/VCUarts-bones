<?php
/**
 * Author: Cody Whitby
 * URL: https://github.com/streeetlamp/bare-wp
 *
 * @package Bare_WP_Theme
 */

?>

			<footer class="footer">

				<div class="inner-footer">
					<p class="source-org copyright">&copy; <?php echo esc_html( date( 'Y' ) ); ?> <?php bloginfo( 'name' ); ?>.</p>
          <p class="last-modified">Last modified: <?php the_modified_time( 'F j, Y' ); ?></p>
				</div>

			</footer>

		</div>

		<?php wp_footer(); ?>

	</body>

</html> <!-- end of site. what a ride! -->
