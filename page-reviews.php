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

			<div class="reviews__body">
				<div class="reviews__img">
					<img src="<?php echo get_template_directory_uri();?>/img/reviews-img.jpg" alt="">
				</div>
				<div class="reviews__content">
					<h4 class="reviews__initials">
						Владимир Николаевич Владимиров
					</h4>
					<div class="reviews__date">
						13.07.2021г.
					</div>
					<p class="reviews__text">
						Lorem ipsum dolor sit amet consectetur adipisicing elit. Culpa laboriosam, pariatur ea esse voluptates dignissimos voluptate eaque ducimus, 
						excepturi nihil consequatur nam. Iure at similique nesciunt rerum impedit nulla minus!
					</p>
				</div>
			</div>	

			<div class="reviews__body">
				<div class="reviews__img">
					<img src="<?php echo get_template_directory_uri();?>/img/reviews-img.jpg" alt="">
				</div>
				<div class="reviews__content">
					<h4 class="reviews__initials">
						Юрий Владимирович Владимиров
					</h4>
					<div class="reviews__date">
						10.07.2021г.
					</div>
					<p class="reviews__text">
						Lorem ipsum dolor sit amet consectetur adipisicing elit. Culpa laboriosam, pariatur ea esse voluptates dignissimos voluptate eaque ducimus, 
						excepturi nihil consequatur nam. Iure at similique nesciunt rerum impedit nulla minus!
					</p>
				</div>
			</div>	

    </div>
			
</div>
</section>

<?php get_footer(); 