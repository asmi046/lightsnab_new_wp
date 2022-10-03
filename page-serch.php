<?php 

/*
Template Name: Страница Расширенный поиск
Template Post Type: page
*/

get_header(); ?>

<?php get_template_part('template-parts/block-menu');?> 
<?php get_template_part('template-parts/header-category');?>


<section class="search-sec">
	<div class="container">
		<h1>Поиск расширенный</h1>

		<form action="" method="get" class="search-sec__form">
		<div class="search-sec__inputs d-flex">
			<input class="se-input se-50" id="id_q" maxlength="100" name="q" placeholder=" Что ищем " type="text" value = "<?echo (!empty($_REQUEST["q"]))?$_REQUEST["q"]:"" ?>" />
			<input class="se-input se-25" id="id_price_from" name="price_from" placeholder=" Цена от " type="number" value = "<?echo (!empty($_REQUEST["price_from"]))?$_REQUEST["price_from"]:""?>" />
			<input class="se-input se-25" id="id_price_to" name="price_to" placeholder=" Цена до " type="number" value = "<?echo (!empty($_REQUEST["price_to"]))?$_REQUEST["price_to"]:""?>" />
		</div>

		<div class="search-sec__column d-flex">
			<div class="search-sec__option search-sec__option_l">
				<select id="id_prod_type" name="prod_type">
					<option value = "">- Тип продукции -</option>
					<?
						global $wpdb;

						$mainCat =  $wpdb->get_results('SELECT `lshop_term_taxonomy`.*,  `lshop_terms`.`name`  FROM `lshop_term_taxonomy` LEFT JOIN `lshop_terms` ON `lshop_terms`.`term_id`=`lshop_term_taxonomy`.`term_id` WHERE `lshop_term_taxonomy`.`parent` = 0 AND `lshop_term_taxonomy`.`taxonomy` = "lightcat"');

						foreach ( $mainCat as $catM ) {
							?>
										<option <? echo ($_REQUEST["prod_type"] === $catM->term_id)?"selected":""; ?> value = "<?echo $catM->term_id?>"><?echo $catM->name?></option>
							<?
						}
					?>
				</select>
			</div>
						
			<div class="search-sec__option search-sec__option_r">
				<select class="chained" id="id_sub_type" name="sub_type">
					<option value = "">- Подтип -</option>
					<?
						if (!empty($_REQUEST["sub_type"])){
							global $wpdb;

							$mainCat =  $wpdb->get_results('SELECT `lshop_term_taxonomy`.*,  `lshop_terms`.`name`  FROM `lshop_term_taxonomy` LEFT JOIN `lshop_terms` ON `lshop_terms`.`term_id`=`lshop_term_taxonomy`.`term_id` WHERE `lshop_term_taxonomy`.`parent` = '.$_REQUEST["prod_type"].' AND `lshop_term_taxonomy`.`taxonomy` = "lightcat" ');

							foreach ( $mainCat as $catM ) {
								$sel = ($_REQUEST["sub_type"] === $catM->term_id)?"selected":"";
								echo '<option '.$sel.' value = "'.$catM->term_id.'">'. $catM->name.'</option>';
								
							}
						}
					?>
				</select>
			</div>
		</div> 

		<div class="search-sec__column d-flex">
			<div class="search-sec__option search-sec__option_l">
				<select  id="id_cap" name="cap">
					<option value="0">- Тип светильника -</option>
					<option <? echo ($_REQUEST["cap"] === "Светодиодный (LED)")?"selected":""; ?> value="Светодиодный (LED)">Светодиодный (LED)</option>
					<option <? echo ($_REQUEST["cap"] === "Цокольный (Со сменными лампами)")?"selected":""; ?> value="Цокольный (Со сменными лампами)">Цокольный (Со сменными лампами)</option>
				</select>
			</div>

			<div class="search-sec__option search-sec__option_r">
				<select id="id_sort" name="sort">
					<option value="DESC" selected="selected">Сначала дорогие</option>
					<option value="ASC">Сначала дешёвые</option>
				</select>
			</div>
		</div> 

			<div class="search-sec__box">
				<button type="submit" value=" Искать" name = "do_search" class="search-sec__btn">Искать</button>
				<!-- <input type="submit" value=" Искать " class="search-sec__btn"> -->
			</div>

		</form>

		<? if (empty($_REQUEST["do_search"])) {?>
			<div class="search-sec__link">
				<h3>Примеры поиска</h3>
				<ul>
					<li><a href="<?the_permalink()?>?q=Лампа&price_from=&price_to=700&prod_type=&sub_type=&cap=0&sort=DESC&do_search=+Искать">
						Лампа до 700 рублей</a>
					</li>
					<li><a href="<?the_permalink()?>?q=&price_from=&price_to=30000&prod_type=17&sub_type=&cap=0&sort=DESC&do_search=+Искать">
						Торшеры от 30 000 рублей</a>
					</li>
					<li><a href="<?the_permalink()?>?q=&price_from=&price_to=&prod_type=11&sub_type=&cap=0&sort=DESC&do_search=+Искать" >
						Люстры дорогие</a>
					</li>
					<li><a href="<?the_permalink()?>?q=Кристал&price_from=&price_to=&prod_type=23&sub_type=&cap=0&sort=DESC&do_search=+Искать" >
						Лампа Эдисона кристалл</a>
					</li>
					<li><a href="<?the_permalink()?>?q=&price_from=&price_to=50000&prod_type=11&sub_type=&cap=0&sort=DESC&do_search=+Искать" >
						Люстры до 50 000</a>
					</li>
				</ul>
			</div>
		<?
			} else {
			
			// global $query_string;
			// parse_str($query_string, $args);

			$startPrice = empty($_REQUEST["price_from"])?"0":$_REQUEST["price_from"];
			$endPrice = empty($_REQUEST["price_to"])?PHP_INT_MAX:$_REQUEST["price_to"];

			$metaquery = array(
				'relation' => 'AND',
				
				'priceStart' => array (
					'key'     => '_offer_price',
					'value' => $startPrice,
					'compare' => '>=',
					'type'    => 'NUMERIC',
				),
				
				'priceEnd' => array (
					'key'     => '_offer_price',
					'value' => $endPrice,
					'compare' => '<=',
					'type'    => 'NUMERIC',
				)
			);

			if (!empty($_REQUEST["cap"]))
				$metaquery["capType"] = array(
					'key'     => '_offer_type',
					'value' => $_REQUEST["cap"],
					'compare' => '=',
					'type'    => 'CHAR',
				); 

			if (!empty($_REQUEST["q"]))
				$metaquery["textQery"] = array(

					'relation' => 'OR',
					'tqDescr' => array(
						'key'     => '_offer_smile_descr',
						'value' => $_REQUEST["q"],
						'compare' => 'LIKE',
						'type'    => 'CHAR',
					),

					'tqTitle' => array(
						'key'     => '_offer_name',
						'value' => $_REQUEST["q"],
						'compare' => 'LIKE',
						'type'    => 'CHAR',
					),

					'tqAllSerch' => array(
						'key'     => '_offer_allSearch',
						'value' => $_REQUEST["q"],
						'compare' => 'LIKE',
						'type'    => 'CHAR',
					)
				); 


			$taxquery = [];

			if (!empty($_REQUEST["sub_type"]))
			{
					$taxquery = array(
					'relation' => "AND",
					[
						'taxonomy' => 'lightcat',
						'field'    => 'id',
						'terms'    => array( $_REQUEST["sub_type"] ),
					]
				);
			} 
				else
			if (!empty($_REQUEST["prod_type"]))
			{
					$taxquery = array(
					'relation' => "AND",
					[
						'taxonomy' => 'lightcat',
						'field'    => 'id',
						'terms'    => array( $_REQUEST["prod_type"] ),
					]
				);
			}

			$args = array(
				'posts_per_page' => -1, 
				'post_type' => "light",
				'tax_query' => $taxquery,
				'meta_query' => $metaquery,
				'orderby' => 'priceStart',
				'order'   => $_REQUEST["sort"],
			);

			// $search_term = empty($_REQUEST["q"])?"%":$_REQUEST["q"];	
				
			
			// add_filter( 'posts_where', 'title_like_posts_where', 10, 2 );
			// function title_like_posts_where( $where, $wp_query ) {
			// 	global $wpdb;
			// 	if ( $post_title_like = $wp_query->get( 'post_title_like' ) ) {
			// 		$argument = explode(" ", $post_title_like);
			// 		for ($i =0; $i<count($argument); $i++)
			// 			$where .= ' AND ' . $wpdb->posts . '.post_title LIKE \'%' . trim($argument[$i]) . '%\'';	
			// 	}
			// 	return $where;
			// }

			// $args['post_title_like'] = $search_term;
			
			// query_posts( $args );
			
			$query = new WP_Query( $args );
			//  echo "<pre>";
			//  print_r($query);
			//  echo "</pre>";
		?>
			<div class = "products-wrapper">
				<?php if ( $query->have_posts() ) : ?>
					<?php  while ( $query->have_posts() ) : $query->the_post(); ?>
							<?php get_template_part('template-parts/product-elem');?>
					<?php endwhile;?>
				<?php else: ?>
					<h2>По Вашему запросу ничего не найдено.</h2>
				<?php endif; ?>

			</div>
		<?
			}
		?>

	</div>

</section>

<section class = "pagination">
  <div class="container">
    <?php 
    the_posts_pagination( array(
      'mid_size' => 2,
      'prev_next'    => false,
      'screen_reader_text' => "11",
    ) ); 
    ?>
  </div>
</section>

<?php get_footer(); ?> 