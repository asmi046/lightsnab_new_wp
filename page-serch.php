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
			<input class="se-input se-50" id="id_q" maxlength="100" name="q" placeholder=" Что ищем " type="text" value = "<?echo $_REQUEST["q"]?>" />
			<input class="se-input se-25" id="id_price_from" name="price_from" placeholder=" Цена от " type="number" value = "<?echo $_REQUEST["price_from"]?>" />
			<input class="se-input se-25" id="id_price_to" name="price_to" placeholder=" Цена до " type="number" value = "<?echo $_REQUEST["price_to"]?>" />
		</div>

		<div class="search-sec__column d-flex">
			<div class="search-sec__option search-sec__option_l">
				<select id="id_prod_type" name="prod_type">
					<option value = "">- Тип продукции -</option>
					<?
						$categories = get_categories( [
							'taxonomy'     => 'lightcat',
							'orderby'      => 'name',
							'order'        => 'ASC',
							'hide_empty'   => 0,
							'hierarchical' => 1
						] );

						if( $categories ){
							foreach( $categories as $cat ){
						?>
							<option value="<?echo $cat->term_id?>"><?echo $cat->name?></option>
						<?
							}
						}
					?>
				</select>
			</div>

			<div class="search-sec__option search-sec__option_r">
				<select class="chained" id="id_sub_type" name="sub_type">
				<option value = "">- Стиль -</option>
					<?
						$categories = get_categories( [
								'taxonomy'     => 'lightstyle',
								'orderby'      => 'name',
								'order'        => 'ASC',
								'hide_empty'   => 0,
								'hierarchical' => 1
							] );

							
							if( $categories ){
								foreach( $categories as $cat ){				
						?>
										<li><a href = "<?echo $cat->term_id?>"><? echo $cat->name;?></a></li>
						<?
								}
							}
		    			?>
				
				</select>
			</div>
		</div> 

		<div class="search-sec__column d-flex">
			<div class="search-sec__option search-sec__option_l">
				<select id="id_cap" name="cap">
					<option value="0">- Тип светильника -</option>
					<option value="3">Светодиодный (LED)</option>
					<option value="8">Цокольный (Со сменными лампами)</option>
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
					<li><a href="#">
						Детские люстры от 20 000 до 30 000</a>
					</li>
					<li><a href="#">
						Светильник бронза до 30 000</a>
					</li>
					<li><a href="#" >
						Дорогие люстры LED</a>
					</li>
					<li><a href="#" >
						Бра до 10 тыс. рублей</a>
					</li>
					<li><a href="#" >
						Светильники с отделкой из дерева до 25 000</a>
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

			$taxquery = [];

			if (!empty($_REQUEST["prod_type"]))
				$taxquery = array(
					'relation' => "AND",
					[
						'taxonomy' => 'lightcat',
						'field'    => 'id',
						'terms'    => array( $_REQUEST["prod_type"] ),
					]
				);

			$args = array( 
				'post_type' => "light",
				'tax_query' => $taxquery,
				'meta_query' => $metaquery,
				'orderby' => 'priceStart',
				'order'   => $_REQUEST["sort"],
			);

			$search_term = empty($_REQUEST["q"])?"%":$_REQUEST["q"];	
				
			
			add_filter( 'posts_where', 'title_like_posts_where', 10, 2 );
			function title_like_posts_where( $where, $wp_query ) {
				global $wpdb;
				if ( $post_title_like = $wp_query->get( 'post_title_like' ) ) {
					$argument = explode(" ", $post_title_like);
					for ($i =0; $i<count($argument); $i++)
						$where .= ' AND ' . $wpdb->posts . '.post_title LIKE \'%' . trim($argument[$i]) . '%\'';	
				}
				return $where;
			}

			$args['post_title_like'] = $search_term;
			
			// query_posts( $args );
			
			$query = new WP_Query( $args );
			 echo "<pre>";
			 print_r($query);
			 echo "</pre>";
		?>
			<div class = "products-wrapper">
				<?php if ( $query->have_posts() ) : ?>
					<?php  while ( $query->have_posts() ) : $query->the_post(); ?>
							<?php get_template_part('template-parts/product-elem');?>
					<?php endwhile;?>
				<?php endif; ?>
			</div>
		<?
			}
		?>

	</div>

</section>


<?php get_footer(); ?> 