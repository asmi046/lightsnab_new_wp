<a href="<?echo get_the_permalink(get_the_ID());?>" class="products-loop">
    <? 
    $label = carbon_get_post_meta(get_the_ID(),"offer_label");
    if (!empty($label)) {?>
        <div class = "tov_label"><?echo $label;?></div>
    <?}?>

    <img class="products-loop__img" src="<?php  $imgTm = get_the_post_thumbnail_url( get_the_ID(), "tominiatyre" ); echo empty($imgTm)?get_bloginfo("template_url")."/img/no-photo.jpg":$imgTm; ?>" alt="<? the_title();?>">
    <div class="products-loop__content">
        <div class="products-loop__title"><? the_title();?></div>
        <? 
            global $wpdb;
            $base_price = $wpdb->get_results("SELECT * FROM `lshop_loadprice` WHERE `sku` = '".carbon_get_post_meta(get_the_ID(),"offer_sku")."'"); 
            
        ?>
        <? if (empty($base_price[0]->count)) {?>
            <div class="products-loop__price">Цена по запросу</div>
        <?} else {?>
            <div class="products-loop__price"><span class = "price_formator"><? echo $base_price[0]->price ?></span> P</div>
        <?}?>  
    </div>
    <div class="products-loop__btn">Подробнее...</div>
</a>  