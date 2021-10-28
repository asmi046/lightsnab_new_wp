<?php 

/*
Template Name: Страница Опт
Template Post Type: page
*/

get_header(); ?>

<?php get_template_part('template-parts/block-menu');?>
<?php get_template_part('template-parts/header-category');?>

<section class = "opt-title">
	<div class = "container" >
		<h1 class="category-title">Станьте нашим партнером или оптовым <br> покупателем!</h1>
	</div>
</section>


<section class="opt-text">
	<div class="container">
		<div class="opt-text__column d-flex">
			<div class="opt-text__row opt-text__row_bt">
				<p>
					В нашем интернет-магазине можно купить светильники оптом и в розницу. В каталоге представлены осветительные изделия для дома, офиса, коммерческих заведений и предприятий. Мы предлагаем приборы освещения разной мощности и дизайна
				</p>
			</div>
			<div class="opt-text__row opt-text__row_tp">
				<h2>
					Самые выгодные условия для вашего <br> бизнеса!
				</h2>
			</div>
		</div>
		<h2>Люстры и светильники оптом по доступным ценам </h2> 
		<p>Интернет-магазинам и розничным торговым точкам мы предлагаем огромную товарную базу, которая регулярно обновляется и пополняется новыми товарами. У нас есть осветительные приборы разных ценовых категорий и стилей оформления.</p>
		<p>Мы приглашаем к сотрудничеству дизайн-студии и архитектурные бюро. В нашем каталоге представлены приборы освещения для домашнего интерьера, для офисных помещений и предприятий. У нас можно купить светодиодные светильники оптом для оформления приусадебных участков, парковых зон, территорий коммерческих и общественных объектов. </p>
		<p>С нами выгодно сотрудничать:</p>
		<ul>
<li>Для оптовых покупателей мы разрабатываем индивидуальные торговые предложения.</li>
<li>Наш ассортимент регулярно пополняется трендовыми новинками и товарами известных брендов.</li>
<li>Мы предлагаем все типы технического и декоративного освещения.</li> 
<li>У нас можно заказать светильники оптом по доступным ценам.</li>
</ul>
<h2>Розничная торговля</h2> 
<p>Мы сотрудничаем и с розничными покупателями. У нас можно заказать люстры, светильники, бра, настольные лампы и приборы уличного освещения для оформления частного дома или квартиры. </p>
<p>Если вам нужна помощь в выборе осветительного изделия, звоните нам по телефону 8 (800) 700-60-45. Наш менеджер поможет подобрать модель нужной вам мощности, подходящего дизайна и ценовой категории. </p>
<p>У нас можно заказать светильники оптом в Москве и Московской области с доставкой нашей курьерской службой. По регионам РФ мы доставляем заказы транспортными компаниями.</p>

	</div>
</section>

<section class="opt-backg" style="background-image: url(<?php echo get_template_directory_uri();?>/img/opt-bg-1.jpg);">
</section>

<?php get_template_part('template-parts/products-section-novinki');?>

<section class="argument">
	<div class="container">
		<div class="argument__column d-flex">
			<div class="argument__row">
				<h3 class="model-icon">Широкий ассортимент</h3>
				<p>Каталоге на 5000 + позиций. Все виды освещения в одном каталоге.</p>
			</div>
			<div class="argument__row">
				<h3 class="range-icon">Уникальный ассортимент</h3>
				<p>К нас Вы найдете эксклюзивные модели которых нет в других магазинах.</p>
			</div>
			<!-- <div class="argument__row">
				<h3 class="new-model-icon">Новые модели каждый день!</h3>
				<p>Среди всех поставщиков освещения у нас новые люстры появляются первыми.</p>
			</div> -->
		<!-- </div>
		<div class="argument__column argument__column_bottom d-flex"> -->
			<div class="argument__row">
				<h3 class="brand-icon">Уверенное развитие</h3>
				<p>Мы постоянно совершенствуем клиентский сервис и становимся удобней и доступней для клиента.</p>
			</div>
			<div class="argument__row">
				<h3 class="vip-icon">Доверие профессионалов</h3>
				<p>Нашей компании доверяют профессиональные дизайнеры интерьеров по всей России.</p>
			</div>
		</div>
	</div>
</section>



<!-- <section class="partner-title partner-title__top">
	<div class="container">
		<h2>
			БОЛЕЕ 1000 РЕАЛИЗОВАННЫХ ПРОЕКТОВ ОТ ДИЗАЙНЕРОВ <br> И НАШИХ ПАРТНЕРОВ ПО ВСЕЙ РОССИИ И СТРАНАМ СНГ!  
		</h2>
	</div>
</section>

<section class="opt-backg-bottom" style="background-image: url(<?php echo get_template_directory_uri();?>/img/opt-bg-2.jpg);">
</section> -->

<section class="partner-title">
	<div class="container">
		<h2>
			ОСТАВЬ ЗАЯВКУ НА ОФОРМЛЕНИЕ СОТРУДНИЧЕСТВА  
		</h2>
	</div>
</section>

<section class="opt-form">
	<div class="container">

		<div class="opt-line"></div>

		<form action="#" method="get" class="opt-form__form">

			<div class="opt-form__row d-flex">
				<label class="label__value">Кто вы *</label>
				<ul>
					<li><label class="label__radio"><input tabindex="1" checked type="radio" name="who" value="Дизайнер">Дизайнер</label></li>
					<li><label class="label__radio"><input tabindex="1" type="radio" name="who" value="Дистрибьютор">Дистрибьютор</label></li>
					<li><label class="label__radio"><input tabindex="1" type="radio" name="who" value="Частное лицо">Частное лицо</label></li>
				</ul>
			</div>

			<div class = "form-line">
				<label for = "id_fio">Имя, Фамилия*</label>
				<div class="form-item">    
					<input id="id_fio" class="form-line__input" placeholder="Например, Александр" maxlength="255" name="fio" v-model="name" type="text">
					<!-- <div class="form-help-text">Например, Алина</div> -->
				</div>
			</div>

			<div class="form-line">
				<label for="id_email" id="p_id_email" class="form-label">Эл. почта *</label>
				<div class="form-item">    
					<input id="id_email" class="form-line__input" placeholder="alex-ivanov@gmail.com" maxlength="255" name="email" v-model="mail"  type="email">
					<!-- <div class="form-help-text">alina-ivanova@gmail.com</div> -->
				</div>
			</div>

			<div class="form-line">
				<label for="id_phone" id="p_id_phone" class="form-label">Телефон*</label>
				<div class="form-item">    
					<input id="id_phone" class="form-line__input" placeholder="+7-991-441-48-43" maxlength="255" name="phone" id="opt_phone" type="text">
					<!-- <div class="form-help-text">+7-994-444-48-44</div> -->
				</div>
			</div>

			<div class="form-line">
				<label for="id_comment" id="p_id_comment" class="form-label">Комментарии</label>
				<div class="form-item opt-textarea">    
					<textarea cols="40" id="id_comment" name="comment" v-model="comment" rows="10"></textarea>
					<div class="form-help-text">Какие объёмы наиболее выгодные</div>  
				</div>
			</div>

			<div class="form-line">
				<label for="id_i_agree" id="p_id_i_agree" class="form-label">Я согласен (-на)</label>
				<div class="form-item form-item-policy">    
					<input checked v-model="checpolicy" id="id_i_agree" class="chek-agree" name="i_agree" type="checkbox">
					<div class="form-help-text">Ставя отметку, я даю своё согласие на обработку моих персональных данных в соответствии с законом №152-ФЗ "О персональных данных" от 27.07.2006 и <a href="/page/i-agree/">принимаю условия пользовательского соглашения и политики в области обработки персональных данных</a>.</div>
				</div>
			</div>

			<div class = "form_submit_line btn-wrapper">
				<button id = "opt_send_btn" type = "button" class = "all-link opt-btn">Отправить заявку</button>
				<div id = "opt_no_feild" class = "no_feild" style = "display:none;">
					Заполните все обязательные поля помеченные <span style = "color:#d3820f;">"*"</span>
				</div>
			</div>

		</form>

	</div>
</section>

<?php get_footer(); ?>  