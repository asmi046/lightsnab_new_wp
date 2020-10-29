<section class="single-product">
  <div class="container">
    <h1 class="category-title"><?the_title();?></h1>
    <div class="product-wrapper">
      <div class="product-slider">
        <div class="slider-for">
          <div class="slider-for__item" style="background-image: url(<?php echo get_template_directory_uri()?>/img/product-1.png)"></div>
          <div class="slider-for__item" style="background-image: url(<?php echo get_template_directory_uri()?>/img/product-2.png)"></div>
          <div class="slider-for__item" style="background-image: url(<?php echo get_template_directory_uri()?>/img/product-3.png)"></div>
          <div class="slider-for__item" style="background-image: url(<?php echo get_template_directory_uri()?>/img/product-4.png)"></div>
          <div class="slider-for__item" style="background-image: url(<?php echo get_template_directory_uri()?>/img/product-1.png)"></div>
        </div>
        <div class="slider-nav">
          <div class="slider-nav__item" style="background-image: url(<?php echo get_template_directory_uri()?>/img/product-1.png)"></div>
          <div class="slider-nav__item" style="background-image: url(<?php echo get_template_directory_uri()?>/img/product-2.png)"></div>
          <div class="slider-nav__item" style="background-image: url(<?php echo get_template_directory_uri()?>/img/product-3.png)"></div>
          <div class="slider-nav__item" style="background-image: url(<?php echo get_template_directory_uri()?>/img/product-4.png)"></div>
          <div class="slider-nav__item" style="background-image: url(<?php echo get_template_directory_uri()?>/img/product-1.png)"></div>
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
        <div class="product-sku">Артикул: <span><?echo carbon_get_post_meta(get_the_ID(),"offer_sku"); ?></span></div>
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
        <div class="product-single__price"><span class = "price_formator">14600</span> P</div>
        <a href="#" class="product-single__opt">Узнать оптовую цену</a>
        <div class="product-single__choice-wrap">
          <div class="product-single__choice-title">Выберите комлектацию:</div>
          <select class="product-single__choice">
            <option value="розовый">1 плафон. Цвет розовый</option>
            <option value="розовый">2 плафона. Цвет розовый</option>
            <option value="розовый">3 плафона. Цвет розовый</option>
          </select>
        </div>
        <button class="product-single__add-to-cart">Добавить в корзину</button>
      </div>
    </div>
  </div>
</section>