<?
  $categoryID = get_queried_object()->term_id;
  $category = get_the_category(); 
?>
<section class="single-product">
  <div class="container">
    <h1 class="category-title" id = "tovar_title"><?the_title();?></h1>
    <?php
			if ( function_exists('yoast_breadcrumb') ) {
				yoast_breadcrumb( '<p id="breadcrumbs">','</p>' );
			}
		?> 
    <div class="product-wrapper">
      <div class="product-slider">
        <div class="slider-for">
        <?
            $pict = carbon_get_the_post_meta('offer_picture');
            if($pict) {
              $pictIndex = 0;
              foreach($pict as $item) {
          ?>
              <picture>
                <img 
                  class="slider-for__item"
                  id = "pict-<? echo empty($item['gal_img_sku'])?$pictIndex:$item['gal_img_sku']; ?>" 
                  alt = "<? echo $item['gal_img_alt']; ?>"
                  title = "<? echo $item['gal_img_alt']; ?>"
                  src = "<?php echo wp_get_attachment_image_src($item['gal_img'], 'full')[0];?>" />
              </picture>
          <?
                $pictIndex++;
              }
            }
          ?>
        </div>
        <div class="slider-nav">
        <?
            $pict = carbon_get_the_post_meta('offer_picture');
            if($pict) {
              $i = 0;
              foreach($pict as $item) {
          ?>
              <picture>
                <img 
                  class="slider-nav__item"
                  data-indexelem = "<?echo $i;?>"
                  id = "<? echo $item['gal_img_sku']; ?>" 
                  alt = "<? echo $item['gal_img_alt']; ?>"
                  title = "<? echo $item['gal_img_alt']; ?>"
                  src = "<?php echo wp_get_attachment_image_src($item['gal_img'], 'thumbnail')[0];?>" />
              </picture>
          <?
          $i++;
              }
            }
          ?>  
        </div>
        <div class="uppsells">
          <h2 class="uppsells-title">Так же обратите внимание на эти товары</h2>
          <div class="uppsells-wrapper">
            
            <?
              $posts = get_posts( array(
                'numberposts' => 4,
                'category'    =>  $category[0]->term_id,
                'post_type'   => 'light',
                'orderby' => "rand" 
              ));

              foreach ($posts as $mp) {
                setup_postdata($mp);
            ?>
              <a href="<?echo get_the_permalink($mp->ID);?>" class="uppsells-item">
                <img class="uppsells-item__img" src="<?php  $imgTm = get_the_post_thumbnail_url( $mp->ID, "tominiatyre" ); echo empty($imgTm)?get_bloginfo("template_url")."/img/no-photo.jpg":$imgTm; ?>" alt="<? echo $mp->post_title;?>">
                <div class="uppsells-item__title"><? echo $mp->post_title;?></div>
              </a>
            <?
              }
            ?>
            
          </div>
        </div>
      </div>
      <div class="product-info">
        <div class="product-descr"><?echo carbon_get_post_meta(get_the_ID(),"offer_smile_descr"); ?></div>
        <div class="product-sku">Артикул: <span id = "product_current_sku"><?echo carbon_get_post_meta(get_the_ID(),"offer_sku"); ?></span></div>
        <div class="product-stock">Наличие: <span><?echo carbon_get_post_meta(get_the_ID(),"offer_nal"); ?></span></div>
        <div class="product-attrs">
          <?
            $cerecter = carbon_get_the_post_meta('offer_cherecter');
            if($cerecter) {
              foreach($cerecter as $item) {
          ?>
                <div class="product-attrs__item">
                  <div class="product-attrs__item-name"><? echo $item["c_name"];?></div>
                  <div class="product-attrs__item-val"><? echo $item["c_val"];?></div>
                </div>
          <?
              }
            }
          ?>
        </div>
        <div class="product-single__price"><span data-real-price = "<?echo carbon_get_post_meta(get_the_ID(),"offer_price"); ?>" class = "price_formator" id = "product_current_price"><?echo carbon_get_post_meta(get_the_ID(),"offer_price"); ?></span> P</div>
        <a href="<? echo get_the_permalink(447); ?>" class="product-single__opt">Узнать оптовую цену</a>
        <?
           $modif = carbon_get_the_post_meta('offer_modification');
          
        ?>
            <div class="product-single__choice-wrap">
              <div class="product-single__choice-title">Выберите комлектацию:</div>
              <select class="product-single__choice" id = "mod_product_selector">
              <?
              
                if($modif) {
                  foreach($modif as $item) {
              ?>  
                    <option 
                      data-sku = "<?echo $item["mod_sku"];?>" 
                      data-price = "<?echo $item["mod_price"];?>" 
                      data-oldprice = "<?echo $item["mod_old_price"];?>" 
                      data-pictureid = "<?echo empty($item["mod_picture_id"])?"pict-0":$item["mod_picture_id"];?>" 
                      value="<?echo $item["mod_name"];?>"><?echo $item["mod_name"];?></option>
                <?
                  }
                } else {
                  ?>
                    <option 
                      selected
                      data-sku = "<?echo carbon_get_post_meta(get_the_ID(),"offer_sku"); ?>" 
                      data-price = "<?echo carbon_get_post_meta(get_the_ID(),"offer_price"); ?>" 
                      data-oldprice = "" 
                      data-pictureid = "pict-0" 
                      value="<?the_title();?>"><?the_title();?></option>
                    
                  <?
                }
              ?>
              </select>
            </div>

        <button id = "add_to_cart" class="product-single__add-to-cart">Добавить в корзину</button>
        <div class = "to_bascet_msg" id = "to_bascet_msg">
          Товар добавлен в корзину. В принципе, можно <a href = "<?echo get_the_permalink(79);?>">оформить заказ</a>.
        </div>    

      </div>
    </div>
  </div>
</section>