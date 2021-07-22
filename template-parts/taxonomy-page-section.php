<?
$categoryID = get_queried_object()->term_id;
$ancestors = get_ancestors( $categoryID, 'lightcat' );
?>
<section class="category-page">
    <div class="container">
      <h1 class="category-title">Все товары</h1>
	  	<?php
			if ( function_exists('yoast_breadcrumb') ) {
				yoast_breadcrumb( '<p id="breadcrumbs">','</p>' ); 
			}
		?> 

	<select id = "mobile_type_selector" class = "mobile_selectors mobile_type_selector">			
		<? echo $options; ?>
	</select>
			
</div>
</section>