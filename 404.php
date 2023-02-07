<?php
/**
 * The template for displaying 404 pages (Not Found)
 */

get_header(); ?>

<div class="site-content col-12" role="main">

	<header class="page-header">
		<h3 class="title"><?php //esc_html_e( 'Not Found', 'woodmart' ); ?></h3>
	</header>

	<div class="page-content">
		<h1>К сожалению, такой страницы не существует или она удалена. </h1>
		<p>Вы можете <a href="/">перейти на главную страницу сайта </a></p>

		<?php
			woodmart_search_form();
		?>
	</div><!-- .page-content -->

</div><!-- .site-content -->

<?php get_footer(); ?>