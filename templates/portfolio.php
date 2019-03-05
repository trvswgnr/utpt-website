<?php
/**
 * Template Name: Portfolio
 *
 * @package utpt
 */

?>

<?php get_header(); ?>

<main>
	<h1><?php the_title(); ?></h1>
	<?php
	$args = array(
		'post_type' => 'portfolio',
	);

	$portfolio = new WP_Query( $args );
	if ( $portfolio->have_posts() ) :
		?>
		<div class="gallery gallery--home">
			<?php
			while ( $portfolio->have_posts() ) :
				$portfolio->the_post();
				?>
				<a href="<?php the_permalink(); ?>" class="gallery__item" style="background-image: url(<?php the_post_thumbnail_url( 'medium' ); ?>);"><span class="gallery__title"><?php the_title(); ?></span></a>
				<?php
			endwhile;
			?>
		</div>
	<?php endif; ?>
</main>

<?php
get_footer();
