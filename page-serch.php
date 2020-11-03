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
			<input class="se-input se-50" id="id_q" maxlength="100" name="q" placeholder=" Что ищем " type="text" />
			<input class="se-input se-25" id="id_price_from" name="price_from" placeholder=" Цена от " type="number" />
			<input class="se-input se-25" id="id_price_to" name="price_to" placeholder=" Цена до " type="number" />
		</div>

		<div class="search-sec__column d-flex">
			<div class="search-sec__option search-sec__option_l">
				<select id="id_prod_type" name="prod_type">
					<option value="0">- Тип продукции -</option>
					<option value="9">Люстры и Дизайнерские светильники</option>
					<option value="11">Конструктор освещения</option>
					<option value="10">Люстра Паук</option>
					<option value="7">Патроны</option>
					<option value="2">Лампы Эдисона</option>
					<option value="3">Лампы Эдисона LED</option>
					<option value="8">XXL лампа</option>
					<option value="5">Декоративные лампы</option>
					<option value="12">Детский свет</option>
					<option value="14">Магнитная трековая система</option>
					<option value="15">Мебель и предметы интерьера</option>
				</select>
			</div>

			<div class="search-sec__option search-sec__option_r">
				<select class="chained" id="id_sub_type" name="sub_type">
					<option value="0">- Подтип -</option>
					<option value="29">Серия Винтаж</option>
					<option value="33">Люстры</option>
					<option value="50">Готовые комбинации светильников</option>
					<option value="31">Серия Design</option>
					<option value="27">Тип Soft LED</option>
					<option value="28">Серия ЭКО</option>
					<option value="12">Тип T</option>
					<option value="16">G125</option>
					<option value="17">G95</option>
					<option value="18">G80</option>
					<option value="19">Тип ST</option>
					<option value="20">A60</option>
					<option value="21">T45</option>
					<option value="22">Тип Т</option>
					<option value="23">Тип С</option>
					<option value="24">Точечные LED</option>
					<option value="25">Силиконовые подвесы</option>
					<option value="52">Потолочные люстры</option>
					<option value="53">Люстры</option>
					<option value="54">Бра</option>
					<option value="55">Торшеры</option>
					<option value="56">Потолочные светильники</option>
					<option value="26">Бетон и мрамор</option>
					<option value="42">Потолочные светильники</option>
					<option value="13">Тип C</option>
					<option value="35">Бра и настенные светильники</option>
					<option value="60">Споты</option>
					<option value="39">Торшеры</option>
					<option value="41">Реечные и рядные светильники и люстры</option>
					<option value="37">Точечный свет</option>
					<option value="15">Design</option>
					<option value="38">Настольные лампы</option>
					<option value="61">Подвесной свет</option>
					<option value="11">T45</option>
					<option value="62">Треки</option>
					<option value="10">A60</option>
					<option value="63">Аксессуары</option>
					<option value="9">ST64</option>
					<option value="8">G80</option>
					<option value="14">D80</option>
					<option value="7">G95</option>
					<option value="6">G125</option>
					<option value="51">Аксессуары</option>
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
					<option value="p_desc" selected="selected">Сначала дорогие</option>
					<option value="p_asc">Сначала дешёвые</option>
				</select>
			</div>
		</div> 

			<div class="search-sec__box">
				<button type="submit" value=" Искать " class="search-sec__btn">Искать</button>
				<!-- <input type="submit" value=" Искать " class="search-sec__btn"> -->
			</div>

		</form>

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

	</div>

</section>


<?php get_footer(); ?> 