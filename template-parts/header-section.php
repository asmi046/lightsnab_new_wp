<header class="header" style="background-image: url(<?php echo get_template_directory_uri();?>/img/Light_snab_ban_1.jpg);">
<div class = "logo_main_blk_svg"></div>
<div class="header-descr">ДИЗАЙНЕРСКОЕ ОСВЕЩЕНИЕ <br/>НА ЛЮБОЙ ВКУС</div>	
<div class="header-top">
		<div class="container">
			<div class="hamburger"></div>
			<a href="tel:<?echo preg_replace('![^0-9]+!', '', SITE_PHONE)?>" class="header-phone"><?echo SITE_PHONE;?></a>
			<div class="header-icons__wrap">
				<a href="#" class="header-icons header-icons__search"></a>
				<a href="<?echo get_the_permalink(79);?>" class="header-icons header-icons__cart">
					<span class = "cart_count_input">0</span>
				</a>
			</div>
		</div>
	</div>
>
</header> 