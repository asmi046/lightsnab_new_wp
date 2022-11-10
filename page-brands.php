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

        <div class="brand_area">
            <?php
                $term = get_terms( [
                    'taxonomy' => 'lightbrand', 
                    'hide_empty'    => false,
                    'hierarchical'  => true,
                    'parent' => 0,
                ]);
                foreach ( $term as $item ) {
            ?>
                <a class="brand_blk" href="<?php echo get_term_link($item->slug, 'lightbrand')?>">
                    <img src="<?php echo bloginfo("template_url")?>/img/brands/<? echo $item->slug; ?>.jpg" alt="">
                    <h2><? echo $item->name; ?></h2>
                </a>
            <?php 
                }
            ?>
        </div>
    </div>
</section>

<?php get_footer(); 