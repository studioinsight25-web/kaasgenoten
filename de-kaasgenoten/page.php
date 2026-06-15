<?php
/**
 * Page template.
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
