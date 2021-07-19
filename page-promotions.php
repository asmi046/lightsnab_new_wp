<?php 

/*
Template Name: Страница Акции
Template Post Type: page
*/

get_header(); ?>

<?php get_template_part('template-parts/block-menu');?>
<?php get_template_part('template-parts/header-category');?>

<section class="category-page promotions">
    <div class="container">
      <h1><? the_title();?></h1>
	  	<?php
			if ( function_exists('yoast_breadcrumb') ) {
				yoast_breadcrumb( '<p id="breadcrumbs">','</p>' );
			}
		?> 
	  
    <div class="promotions__row">

      <div class="promotions__item">
        <div class="promotions__item-img">
          <img src="<?php echo get_template_directory_uri();?>/img/opt-bg-2.jpg" alt="">
        </div> 
        <p>Скидка 15% на светильники</p>
      </div>

      <div class="promotions__item">
        <div class="promotions__item-img">
          <img src="<?php echo get_template_directory_uri();?>/img/opt-bg-2.jpg" alt="">
        </div> 
        <p>Скидка 15% на светильники</p>
      </div>

      <div class="promotions__item">
        <div class="promotions__item-img">
          <img src="<?php echo get_template_directory_uri();?>/img/opt-bg-2.jpg" alt="">
        </div> 
        <p>Скидка 15% на светильники</p>
      </div>

      <div class="promotions__item">
        <div class="promotions__item-img">
          <img src="<?php echo get_template_directory_uri();?>/img/opt-bg-2.jpg" alt="">
        </div> 
        <p>Скидка 15% на светильники</p>
      </div>


    </div>
			
</div>
</section>

<?php get_footer(); 