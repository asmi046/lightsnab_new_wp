<section class="category-page category-page-tags">
    <div class="container">			
	
    <ul class="category-menu category-menu-2 ul-clean bb">
      <?
        $categories = get_categories( [
					'taxonomy'     => 'lightstyle',
					'orderby'      => 'name',
					'order'        => 'ASC',
					'hide_empty'   => 0,
					'hierarchical' => 1,
					
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