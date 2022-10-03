<?php 

/*
Template Name: Страница Бренды
Template Post Type: page
*/

get_header(); ?>

<?php get_template_part('template-parts/block-menu');?>
<?php get_template_part('template-parts/header-category');?>

<section class="contacts content">
    <div class="container">

        <?php
                if ( function_exists('yoast_breadcrumb') ) {
                    yoast_breadcrumb( '<p id="breadcrumbs">','</p>' );  
                }
        ?> 

        <h1><? the_title();?></h1> 
    </div>
</section>

<?php get_footer(); 
