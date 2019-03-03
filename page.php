<?php
/**
 * Default Page Template
 *
 * @package utpt
 */

?>

<?php get_header(); ?>

<main>
	<article>
	<?php
	if ( have_posts() ) :
		while ( have_posts() ) :
			?>
			<h1><?php the_title(); ?></h1>
			<?php
			the_post();
			the_content();
		endwhile;
	endif;
	?>
	</article>
</main>

<?php get_footer(); ?>
