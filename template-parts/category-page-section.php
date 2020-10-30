<section class="category-page">
    <div class="container">
      <h1 class="category-title"><?echo single_cat_title();?></h1>
      <div class="category-descr"><?echo category_description();?></div>
      <ul class="category-menu category-menu-2 ul-clean bb">
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
							<li><a href = "<?echo get_category_link($cat->term_id); ?>"><? echo $cat->name;?></a></li>
			<?
					}
				}
		    ?>
    </ul>
    <ul class="category-menu category-menu-2 ul-clean">
        <li><a href="#">НОВИНКИ</a></li>
        <li><a href="#">Лофт</a></li>
        <li><a href="#">Скандинавский стиль</a></li>
        <li><a href="#">Модерн</a></li>
        <li><a href="#">Классический стиль</a></li>
        <li><a href="#">Ар-Деко</a></li>
        <li><a href="#">Детское освещение</a></li>
        <li><a href="#">Низкий потолок</a></li>
        <li><a href="#">Хром</a></li>
        <li><a href="#">Дерево</a></li>
        <li><a href="#">Мрамор, камень и цемент</a></li>
        <li><a href="#">Текстильный абажур</a></li>
        <li><a href="#">Шарообразные плафоны</a></li>
        <li><a href="#">Кольцевые люстры</a></li>
        <li><a href="#">Купольная форма</a></li>
        <li><a href="#">Удлиненная форма</a></li>
        <li><a href="#">Молекулярная форма</a></li>
        <li><a href="#">Светильники со светодиодами <span>(LED)</span></a></li>
        <li><a href="#">Серия <span>SCHEME</span></a></li>
        <li><a href="#">Светильники по параметрам заказчика</a></li>
        <li><a href="#">Серия LINES</a></li>
        <li><a href="#">Ручная работа</a></li>
        <li><a href="#">Серия <span>AGATE</span></a></li>
    </ul>
</div>
</section>