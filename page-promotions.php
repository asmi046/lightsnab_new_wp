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
      <?	$pict = carbon_get_theme_option('promo_complex');
			  if($pict) {
			  	$pictIndex = 0;
					  foreach($pict as $item) {
	    ?>
        <div class="promotions__item"> 
          <div class="promotions__item-img">
            <img src ="<?php echo wp_get_attachment_image_src($item['promo_img'], 'large')[0];?>" />
          </div> 
          <p><? echo $item['promo_text']; ?></p> 
        </div>
	    <?
	      $pictIndex++; 
	      	}
  	    }
	    ?>
    </div>
			
</div>
</section>

<?php get_footer(); 