<div class="block-menu" id = "block_menu">
	<div class="container">
		<div class="block-menu__header header-white header-transparent">
			<div class="close-menu" id = "close_menu"></div>
			<div class="logo logo-black" ></div>
			<div class="header-icons__wrap">
				<a href="<?echo get_the_permalink(79);?>" class="header-icons header-icons__cart">
					<span class = "cart_count_input">0</span>
				</a>
			</div>
		</div>
		<form role="search" method="get" id="searchform" action="<?php echo home_url( '/' ) ?>">
			<input type="text" value="" name="s" id="s" />
			<input type="submit" id="searchsubmit" value="" />
		</form>
		<div class="block-menu__full-search">
			<a href="#">Расширенный поиск</a>
		</div>
		<div class="block-menu__menu">  
			
 
				<ul class = "ul-clean">
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
				<!-- Меню -->
 			
		
				<?php wp_nav_menu( array('theme_location' => 'menu-2','menu_class' => 'ul-clean',
					'container_class' => 'ul-clean','container' => false )); ?>

				<?php wp_nav_menu( array('theme_location' => 'menu-3','menu_class' => 'ul-clean',
					'container_class' => 'ul-clean','container' => false )); ?>

			
			<div class="block-menu__contacts">
				<div class="">
					<a href="tel:<?echo preg_replace('![^0-9]+!', '', SITE_PHONE)?>"><?echo SITE_PHONE;?></a>
					<a href="mailto:<?echo SITE_MAIL;?>"><?echo SITE_MAIL;?></a>
				</div>
				<div class="soc-block">
					<a class = "soc_btn_insta" href="<?echo INSTA_LNK;?>"></a>
					<a class = "soc_btn_fb" href="<?echo FB_LNK;?>"></a>
				</div>
			</div>
		</div>
	</div>
</div>