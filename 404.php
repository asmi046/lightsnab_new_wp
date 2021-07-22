<?php get_header(); ?>
	<?php get_template_part('template-parts/block-menu');?>
	<?php get_template_part('template-parts/header-category');?>

	<section class="section_404">
		<div class="container">
				<h1 class = "h404">404</h1>
				<p>Запрашиваемая страница не была найдена</p>
				<a href="<?bloginfo("url")?>" class="all-link">Вернуться на главную</a>
			</div>
	</section>

	<?php get_template_part('template-parts/collection');?>
	<?php get_template_part('template-parts/products-section-novinki');?>

<?php get_footer(); ?>