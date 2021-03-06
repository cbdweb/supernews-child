<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Acme Themes
 * @subpackage SuperNews
 */
get_header(); ?>
	<div id="primary" class="content-area">
		<main id="main" class="site-main">

			<section class="not-found error-404">
				<header class="page-header">
					<h1 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'supernews' ); ?></h1>
				</header><!-- .page-header -->

				<div class="page-content">
					<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'supernews' ); ?></p>

					<?php get_search_form(); ?>

                    <p>Members can login to see private content: use the login form on the right, below the Facebook feed.</p>

                </div><!-- .page-content -->
			</section><!-- .error-404 -->

		</main><!-- #main -->
	</div><!-- #primary -->
<?php 
get_sidebar( 'left' );
get_sidebar();
get_footer();