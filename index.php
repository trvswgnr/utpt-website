<?php
/**
 * Index Template
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
				<a href="<?php the_permalink(); ?>"><h2><?php the_title(); ?></h2></a>
				<?php
				the_post();
				the_excerpt();
			endwhile;
		endif;
		?>
	</article>
</main>

<?php
get_footer();
