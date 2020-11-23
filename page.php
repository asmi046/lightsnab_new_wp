<?php get_header(); ?>
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

	
<?php get_footer(); ?>