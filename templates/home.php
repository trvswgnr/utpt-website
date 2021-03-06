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
			<?php
			foreach ( $gallery as $item ) :
				$item_url = $item['link']['url'] ?: $item['image']['url'];
				?>
				<a href="<?php echo esc_url( $item_url ); ?>" class="gallery__item" style="background-image: url(<?php echo esc_url( $item['image']['sizes']['large'] ); ?>);">
					<?php if ( $item['link']['title'] ) : ?>
						<span class="gallery__title"><?php echo esc_html( $item['link']['title'] ); ?></span>
					<?php endif; ?>
				</a>
			<?php endforeach; ?>
				<a href="<?php echo esc_url( site_url() . '/portfolio' ); ?>" class="gallery__item gallery__view-more" ><span>View More</span></a>
		</div>
	<?php endif; ?>
</main>

<?php
get_footer();
