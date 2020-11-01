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

				$options = "<option selected disabled >-Выберите тип светильника-</option>";

				if( $categories ){
					foreach( $categories as $cat ){
						$options .= "<option value = '".get_category_link($cat->term_id)."'>".$cat->name."</option>";
			?>
							<li><a href = "<?echo get_category_link($cat->term_id); ?>"><? echo $cat->name;?></a></li>
			<?
					}
				}
		    ?>
    </ul>

	<select id = "mobile_type_selector" class = "mobile_selectors mobile_type_selector">			
		<? echo $options; ?>
	</select>			
	
    <ul class="category-menu category-menu-2 ul-clean">
      <?
        $categories = get_categories( [
					'taxonomy'     => 'lightstyle',
					'orderby'      => 'name',
					'order'        => 'ASC',
					'hide_empty'   => 0,
					'hierarchical' => 1
				] );

				$options = "<option selected disabled >-Выберите стиль-</option>";

				if( $categories ){
					foreach( $categories as $cat ){
						$options .= "<option value = '".get_category_link($cat->term_id)."'>".$cat->name."</option>";
			?>
							<li><a href = "<?echo get_category_link($cat->term_id); ?>"><? echo $cat->name;?></a></li>
			<?
					}
				}
		    ?>
    </ul>

	<select id = "mobile_style_selector" class = "mobile_selectors mobile_style_selector">			
		<? echo $options; ?>
	</select>
</div>
</section>