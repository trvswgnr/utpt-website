<?php
/**
 * The template for displaying Category pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */

get_header(); ?>

<main>
<?php
// get category information.
$category      = get_category( get_query_var( 'cat' ) );
$category_slug = $category->slug;
$category_name = $category->name;
?>
<h1><?php echo esc_html( $category_name ); ?></h1>
<?php
$args = array(
	'post_type'     => 'portfolio',
	'post_status'   => 'publish',
	'category_name' => $category_name,
);

$query = new WP_Query( $args );
if ( $query->have_posts() ) :
	?>
	<h2>Projects:</h2>
	<div class="gallery">
	<?php
	while ( $query->have_posts() ) :
		$query->the_post();
		?>
		<a href="<?php the_permalink(); ?>" class="gallery__item" style="background-image: url(<?php the_post_thumbnail_url( 'large' ); ?>);"><span class="gallery__title"><?php the_title(); ?></span></a>
		<?php
	endwhile;
	wp_reset_postdata();
	?>
	</div>
	<?php
endif;

$args = array(
	'post_type'     => 'post',
	'post_status'   => 'publish',
	'category_name' => $category_name,
);

$query = new WP_Query( $args );
if ( $query->have_posts() ) :
	?>
	<section>
		<h2>Articles:</h2>
		<?php
		while ( $query->have_posts() ) :
			$query->the_post();
			?>
			<a href="<?php the_permalink(); ?>"><h4><?php the_title(); ?></h4></a>
			<?php
		endwhile;
		wp_reset_postdata();
		?>
	</section>
	<?php
endif;
?>

</main>

<?php
get_footer();
