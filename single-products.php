<?php 

/*
Template Name: Шаблон страницы ТОВАРЫ
Template Post Type: post, page
*/

get_header(); ?>
 
	<?php get_template_part('template-parts/block-menu');?>

	<?php get_template_part('template-parts/header-category');?>

	<?php get_template_part('template-parts/single-product-section');?>

<?php get_footer(); ?>