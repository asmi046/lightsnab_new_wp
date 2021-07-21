<?php get_header(); 

/*
Template Name: Страница О компании
Template Post Type: page
*/

?>

<?php get_template_part('template-parts/block-menu');?>

<?php get_template_part('template-parts/header-category');?>
	
<section class = "page_content">
  <div class = "container text_conteiner list-style">
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
		<h1 class="category-title"><?the_title();?></h1>
			<? the_content();?>
			<?php endwhile;?>
			<?php endif; ?>
  </div>
</section>

<section class="collection">
	<div class="container">
		<div class="collection-content">
			<h2>Все стили и направления <br/>в одном каталоге</h2>
			<p>Сфера освещения меняется как и все вокруг нас! Прогресс неумолимо движется вперед но не смотря на это классические слили дизайна все так же актуальны и востребованны</p>
			<p>Мы не концентрируемся только на Hi-Tech, в нашем каталоге Вы найдете освещение в таких стилях как Ар-Деко, Модерн, Классика </p>
		</div>
	</div>
</section> 

<?php get_template_part('template-parts/products-section-novinki');?>

<?php get_footer(); ?>  