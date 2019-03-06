<?php
/**
 * Single Porfolio/Project Template
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
	<?php
	$gallery = get_field( 'project_photos' );

	if ( $gallery ) :
		?>
		<div class="gallery gallery--home">
			<?php foreach ( $gallery as $item ) : ?>
				<a href="<?php echo esc_url( $item['url'] ); ?>" class="gallery__item" style="background-image: url(<?php echo esc_url( $item['sizes']['large'] ); ?>);"></a>
			<?php endforeach; ?>
		</div>
	<?php endif; ?>
</main>

<?php get_footer(); ?>
