<section class="single-product">
  <div class="container">
    <h1 class="category-title"><?the_title();?></h1>
    <div class="product-wrapper">
      <div class="product-slider">
        <div class="slider-for">
        <?
            $pict = carbon_get_the_post_meta('offer_picture');
            if($pict) {
              foreach($pict as $item) {
          ?>
              <picture>
                <img 
                  class="slider-for__item"
                  id = "pict-<? echo $item['gal_img_sku']; ?>" 
                  alt = "<? echo $item['gal_img_alt']; ?>"
                  title = "<? echo $item['gal_img_alt']; ?>"
                  src = "<?php echo wp_get_attachment_image_src($item['gal_img'], 'full')[0];?>" />
              </picture>
          <?
              }
            }
          ?>
        </div>
        <div class="slider-nav">
        <?
            $pict = carbon_get_the_post_meta('offer_picture');
            if($pict) {
              foreach($pict as $item) {
          ?>
              <picture>
                <img 
                  class="slider-nav__item"
                  id = "pict-<? echo $item['gal_img_sku']; ?>" 
                  alt = "<? echo $item['gal_img_alt']; ?>"
                  title = "<? echo $item['gal_img_alt']; ?>"
                  src = "<?php echo wp_get_attachment_image_src($item['gal_img'], 'thumbnail')[0];?>" />
              </picture>
          <?
              }
            }
          ?>  
        </div>
        <div class="uppsells">
          <h2 class="uppsells-title">С этим товаром покупают</h2>
          <div class="uppsells-wrapper">
            <a href="#" class="uppsells-item">
              <img class="uppsells-item__img" src="<?php echo get_template_directory_uri();?>/img/p-1.png" alt="">
              <div class="uppsells-item__title">ALFEY</div>
            </a>
            <a href="#" class="uppsells-item">
              <img class="uppsells-item__img" src="<?php echo get_template_directory_uri();?>/img/p-2.png" alt="">
              <div class="uppsells-item__title">ALFEY</div>
            </a>
            <a href="#" class="uppsells-item">
              <img class="uppsells-item__img" src="<?php echo get_template_directory_uri();?>/img/p-3.png" alt="">
              <div class="uppsells-item__title">ALFEY</div>
            </a>
            <a href="#" class="uppsells-item">
              <img class="uppsells-item__img" src="<?php echo get_template_directory_uri();?>/img/p-4.png" alt="">
              <div class="uppsells-item__title">ALFEY</div>
            </a>
            <a href="#" class="uppsells-item">
              <img class="uppsells-item__img" src="<?php echo get_template_directory_uri();?>/img/p-5.png" alt="">
              <div class="uppsells-item__title">ALFEY</div>
            </a>
            <a href="#" class="uppsells-item">
              <img class="uppsells-item__img" src="<?php echo get_template_directory_uri();?>/img/p-4.png" alt="">
              <div class="uppsells-item__title">ALFEY</div>
            </a>
            <a href="#" class="uppsells-item">
              <img class="uppsells-item__img" src="<?php echo get_template_directory_uri();?>/img/p-2.png" alt="">
              <div class="uppsells-item__title">ALFEY</div>
            </a>
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
        <div class="product-single__price"><span class = "price_formator" id = "product_current_price">14600</span> P</div>
        <a href="#" class="product-single__opt">Узнать оптовую цену</a>
        <div class="product-single__choice-wrap">
          <div class="product-single__choice-title">Выберите комлектацию:</div>
          <select class="product-single__choice" id = "mod_product_selector">
          <?
            $modif = carbon_get_the_post_meta('offer_modification');
            if($modif) {
              foreach($modif as $item) {
          ?>  
                <option 
                  data-sku = "<?echo $item["mod_sku"];?>" 
                  data-price = "<?echo $item["mod_price"];?>" 
                  data-oldprice = "<?echo $item["mod_old_price"];?>" 
                  data-pictureid = "<?echo $item["mod_picture_id"];?>" 
                  value="<?echo $item["mod_name"];?>"><?echo $item["mod_name"];?></option>
            <?
              }
            }
          ?>
          </select>
        </div>
        <button class="product-single__add-to-cart">Добавить в корзину</button>
      </div>
    </div>
  </div>
</section>