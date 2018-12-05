<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Popperscores
 */

?>
<?php global $first_post; ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
	<?php if (has_post_thumbnail()) { ?>
		<figure class="featured-image">
		<?php if ($first_post == true) { ?>
			<a href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark">
				<?php the_post_thumbnail(); ?>
			</a>
		<?php } else {
				the_post_thumbnail();
			}
		 ?>
		</figure>
	<?php } ?>

		<?php
		if ($first_post == true) {
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		} else {
			if ( is_singular() ) :
				the_title( '<h1 class="entry-title">', '</h1>' );
			else :
				the_title( '<h2 class="entry-title index-excerpt"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
			endif;
		}

		
		if ( 'post' === get_post_type() ) :
			?>

			<?php 
				if ( has_excerpt($post->ID)) {
					echo '<div class="deck">';
					echo '<p>' . get_the_excerpt() . '</p>';
					echo '</div><!--deck-->';
				}
			 ?>

			<div class="index-entry-meta">
				<?php
				popperscores_posted_by();
				popperscores_index_posted_on();
				?>
			</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->

	<?php popperscores_post_thumbnail(); ?>

	<div class="entry-content index-excerpt">
		<?php
		the_excerpt();

		

		?>
	</div><!-- .entry-content -->

	<div class="continue-reading">
		<a href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark">
			<?php 
				printf(
					wp_kses(
						__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'popperscores' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					get_the_title()
				);
			?>
		</a>
	</div>
</article><!-- #post-<?php the_ID(); ?> -->
