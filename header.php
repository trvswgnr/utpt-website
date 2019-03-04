<?php
/**
 * Theme Header
 *
 * @package utpt
 */

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> style="margin-top: 0 !important;">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
	<div id="page">
		<div id="wrapper">
			<header>
				<div class="logo">
					<img src="<?php image( 'logo.png' ); ?>" alt="Unicorns Take Photos Too Logo">
				</div>
				<?php
				$args = array(
					'theme_location' => 'primary',
					'container'      => 'nav',
				);
				wp_nav_menu( $args );
				?>
			</header>
