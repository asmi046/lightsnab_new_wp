<header class="header" >
<div class = "logo_main_blk_svg"></div>
<div class="header-descr">ДИЗАЙНЕРСКОЕ ОСВЕЩЕНИЕ <br/>НА ЛЮБОЙ ВКУС</div>	
<div class="header-top">
		<div class="container">
			<div class="hamburger" id = "hamburger"></div>
			<div class="header__contacts">
				<a href="tel:<?echo preg_replace('![^0-9]+!', '', SITE_PHONE)?>" class="header-phone"><?echo SITE_PHONE;?></a> 
				<a href="#callback" class="header__popup-link callback _popup-link">ЗАКАЗАТЬ ЗВОНОК</a> 
			</div>
			<div class="header-icons__wrap">
				<a href="<?echo get_the_permalink(399);?>" class="header-icons header-icons__search"></a>
				<a href="<?echo get_the_permalink(79);?>" class="header-icons header-icons__cart">
					<span class = "cart_count_input">0</span>
				</a>
			</div>
		</div>
	</div>
>
</header> 