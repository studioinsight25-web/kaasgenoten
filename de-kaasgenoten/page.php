<?php
/**
 * Page template.
 *
 * @package De_Kaasgenoten
 */

get_header();

$content_classes = 'dkg-container dkg-content-wrap';

if ( function_exists( 'is_cart' ) && ( is_cart() || is_checkout() || is_account_page() ) ) {
	$content_classes .= ' dkg-content-wrap-wide dkg-woo-page-wrap';
}
?>
<main id="primary" class="dkg-main dkg-content-page">
	<div class="<?php echo esc_attr( $content_classes ); ?>">
		<?php
		while ( have_posts() ) :
			the_post();
			?>
			<article <?php post_class(); ?>>
				<h1><?php the_title(); ?></h1>
				<div class="dkg-entry-content">
					<?php the_content(); ?>
				</div>
			</article>
			<?php
		endwhile;
		?>
	</div>
</main>
<?php
get_footer();
