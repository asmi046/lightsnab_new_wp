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

<section class="opt-backg" style="background-image: url(<?php echo get_template_directory_uri();?>/img/opt-bg-1.jpg);">
</section>

<section class="opt-text">
	<div class="container">
		<div class="opt-text__column d-flex">
			<div class="opt-text__row opt-text__row_bt">
				<p>Если Вы дизайнер интерьеров или у вас свой оптовый или розничный магазин или 
					Вы просто занимаетесь подбором и комплектацией дизайнерского освещения под большие проекты — то Вам крупно повезло! 
					Ведь именно для Вас мы приготовили самые интересные условия работы!
				</p>
			</div>
			<div class="opt-text__row opt-text__row_tp">
				<h2>
					Особые условия для вашего <br> бизнеса!
				</h2>
			</div>
		</div>
	</div>
</section>

<section class="argument">
	<div class="container">
		<div class="argument__column d-flex">
			<div class="argument__row">
				<h3 class="model-icon">Более 5000 моделей!</h3>
				<p>Самый большой каталог новинок и популярных моделей дизайнерского освещения.</p>
			</div>
			<div class="argument__row">
				<h3 class="range-icon">Ассортимент не как у всех!</h3>
				<p>Собственный уникальный ассортимент, который вы можете найти только у нас.</p>
			</div>
			<div class="argument__row">
				<h3 class="new-model-icon">Новые модели каждый день!</h3>
				<p>Среди всех поставщиков освещения у нас новые люстры появляются первыми.</p>
			</div>
		</div>
		<div class="argument__column argument__column_bottom d-flex">
			<div class="argument__row">
				<h3 class="brand-icon">Мы — бренд!</h3>
				<p>Наш каталог — самый динамично развивающийся проект на рынке дизайнерского освещения!</p>
			</div>
			<div class="argument__row">
				<h3 class="vip-icon">Доверие статусных клиентов!</h3>
				<p>Нам доверяют свои проекты уже более 300 дизайнеров и дизайн студий по всей России.</p>
			</div>
		</div>
	</div>
</section>

<?php get_template_part('template-parts/products-section-novinki');?>

<section class="partner-title partner-title__top">
	<div class="container">
		<h2>
			БОЛЕЕ 1000 РЕАЛИЗОВАННЫХ ПРОЕКТОВ ОТ ДИЗАЙНЕРОВ <br> И НАШИХ ПАРТНЕРОВ ПО ВСЕЙ РОССИИ И СТРАНАМ СНГ!  
		</h2>
	</div>
</section>

<section class="opt-backg-bottom" style="background-image: url(<?php echo get_template_directory_uri();?>/img/opt-bg-2.jpg);">
</section>

<section class="partner-title">
	<div class="container">
		<h2>
			ЛУЧШИЙ МОМЕНТ, ЧТОБЫ НАЧАТЬ ЗАРАБАТЫВАТЬ!  
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
					<li><label class="label__radio"><input tabindex="1" checked type="radio" name="who" value="designer">Дизайнер</label></li>
					<li><label class="label__radio"><input tabindex="1" type="radio" name="who" value="distributor">Дистрибьютор</label></li>
					<li><label class="label__radio"><input tabindex="1" type="radio" name="who" value="person">Частное лицо</label></li>
				</ul>
			</div>

			<div class = "form-line">
				<label for = "id_fio">Имя, Фамилия*</label>
				<div class="form-item">    
					<input id="id_fio" maxlength="255" name="fio" v-model="name" type="text">
					<div class="form-help-text">Например, Алина.</div>
				</div>
			</div>

			<div class="form-line">
				<label for="id_email" id="p_id_email" class="form-label">Эл. почта *</label>
				<div class="form-item">    
					<input id="id_email" maxlength="255" name="email" v-model="mail"  type="email">
					<div class="form-help-text">alina-ivanova@gmail.com</div>  
				</div>
			</div>

			<div class="form-line">
				<label for="id_phone" id="p_id_phone" class="form-label">Телефон*</label>
				<div class="form-item">    
					<input id="id_phone" maxlength="255" name="phone" v-model="phone" type="text">
					<div class="form-help-text">+7-916-329-23-71</div>
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
				<button type = "button" class = "all-link opt-btn">Отправить заявку</button>
				<!-- <div v-show = "formNoValid" class = "no_feild">
					Заполните все обязательные поля помеченные <span style = "color:#d3820f;">"*"</span>
				</div> -->
			</div>

		</form>

	</div>
</section>

<?php get_footer(); ?>  