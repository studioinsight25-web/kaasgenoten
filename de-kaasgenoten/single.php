<?php
/**
 * Single post template.
 *
 * @package De_Kaasgenoten
 */

get_header();
?>
<main id="primary" class="dkg-main dkg-content-page">
	<div class="dkg-container dkg-content-wrap">
		<?php
		while ( have_posts() ) :
			the_post();
			?>
			<article <?php post_class(); ?>>
				<p class="dkg-eyebrow"><?php echo esc_html( get_the_date() ); ?></p>
				<h1><?php the_title(); ?></h1>
				<?php if ( has_post_thumbnail() ) : ?>
					<div class="dkg-featured-image"><?php the_post_thumbnail( 'large' ); ?></div>
				<?php endif; ?>
				<div class="dkg-entry-content">
					<?php the_content(); ?>
				</div>
			</article>
		<?php endwhile; ?>
	</div>
</main>
<?php
get_footer();
