<?php
/**
 * Archive template.
 *
 * @package De_Kaasgenoten
 */

get_header();
?>
<main id="primary" class="dkg-main dkg-content-page">
	<div class="dkg-container dkg-content-wrap">
		<header class="dkg-archive-header">
			<?php the_archive_title( '<h1>', '</h1>' ); ?>
			<?php the_archive_description( '<div class="dkg-archive-description">', '</div>' ); ?>
		</header>
		<div class="dkg-post-list">
			<?php if ( have_posts() ) : ?>
				<?php while ( have_posts() ) : the_post(); ?>
					<article <?php post_class( 'dkg-post-card' ); ?>>
						<?php if ( has_post_thumbnail() ) : ?>
							<a href="<?php the_permalink(); ?>" class="dkg-post-thumb"><?php the_post_thumbnail( 'medium_large' ); ?></a>
						<?php endif; ?>
						<div>
							<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
							<p><?php echo esc_html( wp_trim_words( get_the_excerpt(), 28 ) ); ?></p>
							<a class="dkg-read-more" href="<?php the_permalink(); ?>"><?php esc_html_e( 'Lees verder', 'de-kaasgenoten' ); ?> →</a>
						</div>
					</article>
				<?php endwhile; ?>
				<?php the_posts_pagination(); ?>
			<?php else : ?>
				<p><?php esc_html_e( 'Geen berichten gevonden.', 'de-kaasgenoten' ); ?></p>
			<?php endif; ?>
		</div>
	</div>
</main>
<?php
get_footer();
