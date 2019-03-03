<?php
/**
 * Template Name: Home
 *
 * @package utpt
 */

?>

<?php get_header(); ?>

<main>
	<?php
	$gallery = get_field( 'home_gallery' );

	if ( $gallery ) :
		?>
		<div class="gallery gallery--home">
			<?php foreach ( $gallery as $item ) : ?>
				<a href="<?php echo esc_url( $item['link']['url'] ) ?: esc_url( $item['image']['url'] ); ?>" class="gallery__item" style="background-image: url(<?php echo esc_url( $item['image']['sizes']['medium'] ); ?>);"></a>
			<?php endforeach; ?>
		</div>
	<?php endif; ?>
	</div>
</main>

<?php
get_footer();
