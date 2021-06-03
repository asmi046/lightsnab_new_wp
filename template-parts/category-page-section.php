<?
$categoryID = get_queried_object()->term_id;
$ancestors = get_ancestors( $categoryID, 'lightcat' );
?>
<section class="category-page">
    <div class="container">
      <h1 class="category-title"><?echo single_cat_title();?></h1>
	  	<?php
			if ( function_exists('yoast_breadcrumb') ) {
				yoast_breadcrumb( '<p id="breadcrumbs">','</p>' );
			}
		?> 
	  
      <ul class="category-menu category-menu-2 ul-clean">
            <?
				$sparam =  [
					'taxonomy'     => 'lightcat',
					'orderby'      => 'name',
					'order'        => 'ASC',
					'hide_empty'   => 0,
					'hierarchical' => 1,
					'parent' => $categoryID
				];

				$categories = get_categories($sparam);

				if (empty($categories)) {
					$sparam["parent"] = $ancestors[0];
					$categories = get_categories( $sparam );
				}	

				$options = "<option selected disabled >-Выберите подкатегорию-</option>";

				if( $categories ){
					foreach( $categories as $cat ){
						if ($categoryID == $cat->term_id)
							$options .= "<option selected value = '".get_category_link($cat->term_id)."'>".$cat->name."</option>";
						else 	
							$options .= "<option value = '".get_category_link($cat->term_id)."'>".$cat->name."</option>";
						?>
							<li><a class = "<?echo ($categoryID == $cat->term_id)?"selected":"";?>" href = "<?echo get_category_link($cat->term_id); ?>"><? echo $cat->name;?></a></li>
						<?
					}
				}
		    ?>
    </ul>

	<select id = "mobile_type_selector" class = "mobile_selectors mobile_type_selector">			
		<? echo $options; ?>
	</select>
			
</div>
</section>