<?
  $categoryID = get_queried_object()->term_id;
  $category = get_the_category(); 

  $cur_terms = get_the_terms( $post->ID, 'lightbrand' );
?>
<section class="single-product">
  <div class="container">
    <h1 class="category-title" id = "tovar_title"><?the_title();?></h1>
    <?php
			if (empty($cur_terms)) {
        if ( function_exists('yoast_breadcrumb') ) {
          yoast_breadcrumb( '<p id="breadcrumbs">','</p>' );
        }
      } else {
    ?>
    	  <p id="breadcrumbs">
            
            <a href="https://lightsnab.ru/">Главная</a> / 
            <span><a href="<?echo get_the_permalink(74434) ?>">Все бренды</a></span> / 
            <?
               foreach ($cur_terms as $elem) {
            ?>
              <span><a href="<?echo get_category_link($elem->term_id); ?>"><?echo $elem->name; ?></a></span> /
            <?
              }
            ?>
            <span class="breadcrumb_last" aria-current="page"><?the_title();?></span> 	
            
        </p>
    <?
      }
		?> 
    <div class="product-wrapper" itemscope itemtype="http://schema.org/Product">
      <p style = "display:none" itemprop="name"><?the_title();?></p>
      <div class="product-slider">
        <? 
          $label = carbon_get_post_meta(get_the_ID(),"offer_label");
          if (!empty($label)) {?>
            <div class = "tov_label"><?echo $label;?></div>
        <?  }?>

        <div class="slider-for">
        <?
            $pict = carbon_get_the_post_meta('offer_picture');
            if($pict) {
              $pictIndex = 0;
              foreach($pict as $item) {
          ?>
              <picture>
                <img 
                  <?
                    if ($pictIndex == 0) echo 'itemprop="image"';
                  ?>
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
          <?
            $series_prod = carbon_get_the_post_meta('offer_siries');
            if (empty($series_prod)) {
          ?>
          <h2 class="uppsells-title">Так же обратите внимание на эти товары</h2>
          <div class="uppsells-wrapper">
            
            <?
              $posts = get_posts( array(
                'numberposts' => 4,
                'category'    =>  isset($category[0]->term_id)?$category[0]->term_id:"",
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
          <?} else {
              $current_id = get_the_ID();
              $args = array(
                'post_type' => 'light',
                'post__not_in' => array($current_id),
                'meta_key' => '_offer_siries',
                'meta_value' => $series_prod,
              );
              ?>
                <h2 class="uppsells-title">Товары серии <? echo $series_prod?></h2>
                  <div class="uppsells-wrapper">

              <?
              $query = new WP_Query($args);
              if($query->have_posts()):
                while($query->have_posts()):
                  $query->the_post();
          ?>
              <a href="<?echo get_the_permalink(get_the_ID());?>" class="uppsells-item">
                <img class="uppsells-item__img" src="<?php  $imgTm = get_the_post_thumbnail_url( get_the_ID(), "tominiatyre" ); echo empty($imgTm)?get_bloginfo("template_url")."/img/no-photo.jpg":$imgTm; ?>" alt="<? echo $query->post_title;?>">
                <div class="uppsells-item__title"><? the_title();?></div>
              </a>
          <?
              endwhile;

              wp_reset_postdata();

            endif;
            ?>
              </div>
            <?
          }
        ?>
        </div>
          <div class = "s_text s_text_desc">
            <? echo apply_filters( 'the_content', carbon_get_the_post_meta('offer_fulltext')); ?>
          </div>


      </div>
      <div class="product-info">
        <div class="product-descr" itemprop="description"><?echo carbon_get_post_meta(get_the_ID(),"offer_smile_descr"); ?></div>
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

        <?
           $modif = carbon_get_the_post_meta('offer_modification');

           $mainPrice = carbon_get_post_meta(get_the_ID(),"offer_price");
           if (!empty($modif))
            $mainPrice = $modif[0]["mod_price"]; 
        ?>

        <div class="product-single__price" itemprop="offers" itemscope itemtype="http://schema.org/Offer">
          <span data-real-price = "<? echo $mainPrice; ?>" class = "price_formator" id = "product_current_price" itemprop="price">
          <?echo $mainPrice;  ?></span> P

          <span style = "display:none" itemprop="priceCurrency">RUB</span>
          <link style = "display:none" itemprop="availability" href="http://schema.org/InStock">
        </div>
        
        <a href="<? echo get_the_permalink(447); ?>" class="product-single__opt">Узнать оптовую цену</a>

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

        

        <noindex>
          <div class = "s_text s_text_mob">
              <? echo apply_filters( 'the_content', carbon_get_the_post_meta('offer_fulltext')); ?>
          </div>
        </noindex>

          

      </div>
    </div>

    <div class = "revSection">
                <h2>Отзывы о продукте</h2>
                <div class = "reviews">
                    <?
                      $rev = carbon_get_the_post_meta('offer_rev');
                      if($rev) 
                      $i = 0;
                        foreach($rev as $item) {
                    ?>
                        <div class = "rev">
                            <h3 class = "name"><? echo $item["rev_name"]; ?></h3>
                            <p class = "date"><? echo date("d.m.Y", strtotime($item["rev_date"])); ?></p>
                            <div class = "reiting">
                              <div class = "starReitingStatic">
                                <input type = "radio" name = "reiting<?echo $i;?>" id = "r5" <?if ($item["rev_reiting"] === 5) echo "checked"; ?> value = "5"/>
                                <label for="r5"></label>
                                <input type = "radio" name = "reiting<?echo $i;?>" id = "r4" <?if ($item["rev_reiting"] === 4) echo "checked"; ?> value = "4"/>
                                <label for="r4"></label>
                                <input type = "radio" name = "reiting<?echo $i;?>" id = "r3" <?if ($item["rev_reiting"] === 3) echo "checked"; ?> value = "3"/>
                                <label for="r3"></label>
                                <input type = "radio" name = "reiting<?echo $i;?>" id = "r2" <?if ($item["rev_reiting"] === 2) echo "checked"; ?> value = "2"/>
                                <label for="r2"></label>
                                <input type = "radio" name = "reiting<?echo $i;?>" id = "r1" <?if ($item["rev_reiting"] === 1) echo "checked"; ?> value = "1"/>
                                <label for="r1"></label>
                              </div>

                        </div>
                            <div class = "text">
                                <?
                                  echo apply_filters('the_content', $item["rev_text"]);
                                ?>
                            </div>

                            <? if (!empty($item["rev_otv"])) {?>
                              <div class = "otv">
                                  <p class = "otvZag">Ответ:</p>
                                  <?
                                    echo apply_filters('the_content', $item["rev_otv"]);
                                  ?>
                              </div>
                            <?}?>

                        </div> 
                    <?
                    $i++;  
                  }
                  ?>
                </div>

                <div class = "reviewsForm">
                  <form action="#" method="get" class="rev-form__form">
                    <input type = "hidden" name = "otz_tovid" id = "otz_tovid" value = "<?the_ID();?>">
                    <input type = "hidden" name = "otz_tovname" id = "otz_tovname" value = "<?the_title();?>">
                    <div class = "form-line">
                      <label for = "otz_fio">Имя, Фамилия*</label>
                      <div class="form-item">    
                        <input id="otz_fio" name="otz_fio" class="form-line__input" placeholder="Например, Александр" maxlength="255" type="text">
                      </div>
                    </div>

                    <div class="form-line">
                      <label for="otz_email" id="p_id_email" class="form-label">Эл. почта *</label>
                        <div class="form-item">    
                          <input id="otz_email" name="otz_email" class="form-line__input" placeholder="alex-ivanov@gmail.com" maxlength="255" type="email">
                        </div>
                    </div>

                    <div class="form-line">
                      <label for="id_phone" id="p_id_phone" class="form-label">Ваша оценка*</label>
                      <div class="form-item">    
                        <div class = "starReiting">
                          <input type = "radio" name = "reiting" id = "v5" value = "5"/>
                          <label for="v5" title="Оценка «5»"></label>
                          <input type = "radio" name = "reiting" id = "v4" value = "4"/>
                          <label for="v4" title="Оценка «4»"></label>
                          <input type = "radio" name = "reiting" id = "v3" value = "3"/>
                          <label for="v3" title="Оценка «3»"></label>
                          <input type = "radio" name = "reiting" id = "v2" value = "2"/>
                          <label for="v2" title="Оценка «2»"></label>
                          <input type = "radio" name = "reiting" id = "v1" value = "1"/>
                          <label for="v1" title="Оценка «1»"></label>
                        </div>
                      </div>
                    </div>

                    <div class="form-line">
                      <label for="otz_comment" id="p_id_comment" class="form-label">Комментарии*</label>
                      <div class="form-item opt-textarea">    
                        <textarea cols="40" id="otz_comment" name="otz_comment" rows="10"></textarea>
                        <div class="form-help-text">Напишите что вы думаете об этом продукте</div>  
                      </div>
                    </div>

                    <div class="form-line">
                      <label for="otz_i_agree" id="p_id_i_agree" class="form-label">Я согласен (-на)</label>
                      <div class="form-item form-item-policy">    
                        <input checked id="otz_i_agree" name="otz_i_agree" class="chek-agree" type="checkbox">
                        <div class="form-help-text">Ставя отметку, я даю своё согласие на обработку моих персональных данных в соответствии с законом №152-ФЗ "О персональных данных" от 27.07.2006 и <a href="/page/i-agree/">принимаю условия пользовательского соглашения и политики в области обработки персональных данных</a>.</div>
                      </div>
                    </div>

                    <div class = "form_submit_line btn-wrapper">
                      <button id = "otz_send_btn" type = "button" class = "all-link opt-btn">Оставить отзыв</button>
                      <div id = "otz_no_feild" class = "no_feild" style = "display:none;">
                        Заполните все обязательные поля помеченные <span style = "color:#d3820f;">"*"</span>
                      </div>
                    </div>

                    </form>
                </div>
          </div>      

  </div>
</section>