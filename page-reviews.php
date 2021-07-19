<?php 

/*
Template Name: Страница Отзывы
Template Post Type: page
*/

get_header(); ?>

<?php get_template_part('template-parts/block-menu');?>
<?php get_template_part('template-parts/header-category');?>

<section class="category-page reviews">
    <div class="container">
      <h1><? the_title();?></h1>
	  	<?php
			if ( function_exists('yoast_breadcrumb') ) {
				yoast_breadcrumb( '<p id="breadcrumbs">','</p>' );
			}
		?> 
	  
    <div class="reviews__block">
		<?	$reviews = carbon_get_theme_option('reviews_complex');
			  if($reviews) {
			  	$reviewsIndex = 0;
					  foreach($reviews as $item) {
	    ?>
				<div class="reviews__body">
					<div class="reviews__img">
					<img src ="<?php echo wp_get_attachment_image_src($item['reviews_img'], 'large')[0];?>" />
					</div>
					<div class="reviews__content">
						<h4 class="reviews__initials"><? echo $item['reviews_fio']; ?></h4>
						<div class="reviews__date"><? echo $item['reviews_date']; ?></div>
						<p class="reviews__text"><? echo $item['reviews_text']; ?></p>
					</div>
				</div>
	    <?
	      $reviewsIndex++; 
	      	}
  	    }
	    ?>
    </div>
			
</div>
</section>

<?php get_footer(); 