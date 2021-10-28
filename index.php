<?php get_header(); ?>

	<?php get_template_part('template-parts/block-menu');?>

	<?php get_template_part('template-parts/header-section');?>

	<?php get_template_part('template-parts/about-section');?>

	<!-- <?php get_template_part('template-parts/collection');?> -->

	<?php get_template_part('template-parts/products-section-novinki');?>

	<?php get_template_part('template-parts/collection-classic-section');?>

	<?php get_template_part('template-parts/products-two-section');?>

	<section class = "main_text_section"> 
		<div class = "container">   
			<?
				echo apply_filters( 'the_content', carbon_get_theme_option( "main_fulltext" ) );
			?>
		</div>
	</section>

<?php get_footer(); ?>