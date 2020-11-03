<?php 

/*
Template Name: Страница Расширенный поиск
Template Post Type: page
*/

get_header(); ?>

<?php get_template_part('template-parts/block-menu');?> 
<?php get_template_part('template-parts/header-category');?>


<section class="box text_page_title">
	<div class="container">
		<h1>Поиск расширенный</h1>
		<div class="prod-cat-desc"></div>

		<form action="/cat/search/" method="get" class="se-box">

			<input class="se-input se-50" id="id_q" maxlength="100" name="q" placeholder=" Что ищем " type="text" />
			<input class="se-input se-25" id="id_price_from" name="price_from" placeholder=" Цена от " type="number" />
			<input class="se-input se-25" id="id_price_to" name="price_to" placeholder=" Цена до " type="number" />

			<div class="se-style2">
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

			<div class="se-style2 se-style21"><select class="chained" id="id_sub_type" name="sub_type">
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
			</select></div>

			<div class="se-style2  "><select id="id_cap" name="cap">
				<option value="0">- Тип светильника -</option>
				<option value="3">Светодиодный (LED)</option>
				<option value="8">Цокольный (Со сменными лампами)</option>
			</select></div>
			<div class="se-style2 se-style21 "><select id="id_sort" name="sort">
				<option value="p_desc" selected="selected">Сначала дорогие</option>
				<option value="p_asc">Сначала дешёвые</option>
			</select></div>

			<br>

			<div class="se-sub-box">
				<input type="submit" value=" Искать " class="button-order1">
			</div>
			<br><br>

		</form>

		<div class="se-help ul-nice">
			<h3>Примеры поиска</h3>
			<ul>
				<li><a href="/cat/search/?q=&price_from=20000&price_to=30000&prod_type=12&sort=p_desc">Детские люстры от 20&nbsp;000 до 30&nbsp;000</a></li>
				<li><a href="/cat/search/?q=бронза&price_from=&price_to=30000&prod_type=9&sort=p_asc">Светильник бронза до 30&nbsp;000</a></li>
				<li><a href="/cat/search/?q=led&price_from=50000&price_to=&prod_type=9&sort=p_desc" >Дорогие люстры LED</a></li>

				<li><a href="/cat/search/?q=бра&price_from=&price_to=10000&prod_type=0&sort=p_asc" >Бра до 10 тыс. рублей</a></li>

				<li><a href="/cat/search/?q=дерево&price_from=&price_to=25000&prod_type=0&sort=p_desc" >Светильники с отделкой из дерева до 25&nbsp;000</a></li>

			</ul>
		</div>

	</div>

</section>


<?php get_footer(); ?> 