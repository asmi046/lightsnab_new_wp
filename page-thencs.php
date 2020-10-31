<?php 

/*
Template Name: Страница благодарности
Template Post Type: page
*/

get_header(); ?>

    <?php get_template_part('template-parts/block-menu');?>
    <?php get_template_part('template-parts/header-category');?>

    

    <section class = "page_content">
        <div class = "container" >
            <h1 class="category-title">Ваш заказ оформлен!</h1>
            <div class = "thencsBlk">
                <p>СПАСИБО ЗА ВАШ ВЫБОР!</p>
                
                <p>МЫ СВЯЖЕМСЯ С ВАМИ В САМОЕ БЛИЖАЙШЕЕ ВРЕМЯ <br/>ДЛЯ УТОЧНЕНИЯ ДЕТАЛЕЙ.</p>
                
                <p>А ПОКА ВЫ МОЖЕТЕ ОЗНАКОМИТЬСЯ С НАШИМИ НОВИНКАМИ <br/>И АКТУАЛЬНЫМИ ПРЕДЛОЖЕНИЯМИ!</p>
            </div>
        </div>
    </section>
    
    <?php get_template_part('template-parts/collection');?>

    <?php get_template_part('template-parts/products-section-novinki');?>
    


<?php get_footer(); ?> 