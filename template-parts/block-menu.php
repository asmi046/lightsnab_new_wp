<div class="block-menu">
	<div class="container">
		<div class="block-menu__header">
			<div class="close-menu"></div>
			<div class="logo" style="background-image: url(<?php echo get_template_directory_uri();?>/img/logo-menu.svg);"></div>
			<div class="header-icons__wrap">
				<a href="#" class="header-icons header-icons__cart">
					<!--          <span>0</span>-->
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
			<!-- <ul class="ul-clean"> -->
				<!-- <li><a href="#">Новинки</a></li>
				<li><a href="<?php echo get_category_link(3);?>">Люстры</a></li>
				<li><a href="<?php echo get_category_link(4);?>">Светильники и подвесной свет</a></li>
				<li><a href="#">Люстры для низких потолков</a></li>
				<li><a href="#">Потолочные светильники</a></li>
				<li><a href="#">Реечные и рядные светильники и люстры</a></li>
				<li><a href="#">Бра и настенное освещение </a></li>
				<li><a href="#">Торшеры </a></li>
				<li><a href="#">Настольные лампы </a></li>
				<li><a href="#">Точечный свет </a></li>
				<li><a href="#">Магнитная трековая система LEVITY </a></li>
				<li><a href="#">Детский свет </a></li>
				<li><a href="#">Конструктор освещения </a></li>
				<li><a href="#">Патроны </a></li>
				<li><a href="#">Лампы Эдисона </a></li>
				<li><a href="#">Лампы Эдисона LED</a></li> -->
 
				<!-- Меню -->
 				<?php wp_nav_menu( array('theme_location' => 'menu-1','menu_class' => 'ul-clean',
					'container_class' => 'ul-clean','container' => false )); ?>

			<!-- </ul> -->
				<?php wp_nav_menu( array('theme_location' => 'menu-2','menu_class' => 'ul-clean',
					'container_class' => 'ul-clean','container' => false )); ?>

				<?php wp_nav_menu( array('theme_location' => 'menu-3','menu_class' => 'ul-clean',
					'container_class' => 'ul-clean','container' => false )); ?>

			<!-- <ul class="ul-clean">
				<li><a href="#">Сотрудничество</a></li>
				<li><a href="#">Оптовым покупателям</a></li>
			</ul> -->
			<!-- <ul class="ul-clean">
				<li><a href="#">Доставка и оплата </a></li>
				<li><a href="#">Возврат и обмен товара </a></li>
				<li><a href="#">Пользовательское соглашение</a></li>
			</ul> -->
			<div class="block-menu__contacts">
				<div class="">
					<a href="tel:42342">+7 (495) 740-80-33</a>
					<a href="mailto:info@lampatron.ru">info@lampatron.ru</a>
				</div>
				<div class="soc-block">
					<a href="#" style="background-image: url(<?php echo get_template_directory_uri();?>/img/insta.svg);"></a>
					<a href="#" style="background-image: url(<?php echo get_template_directory_uri();?>/img/face.svg);"></a>
				</div>
			</div>
		</div>
	</div>
</div>