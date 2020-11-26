<a href="<?echo get_the_permalink(get_the_ID());?>" class="products-loop">
    <img class="products-loop__img" src="<?php  $imgTm = get_the_post_thumbnail_url( get_the_ID(), "tominiatyre" ); echo empty($imgTm)?get_bloginfo("template_url")."/img/no-photo.jpg":$imgTm; ?>" alt="<? the_title();?>">
    <div class="products-loop__content">
        <div class="products-loop__title"><? the_title();?></div>
        <div class="products-loop__price"><?echo carbon_get_post_meta(get_the_ID(),"offer_price"); ?> P</div>
    </div>
</a> 