<!-- В этом файле описываем все  всплывающие окна -->

<!-- Popup-Form-JS -->
<div class="popup popup_callback">
	<div class="popup__content">
		<div class="popup__body">
			<div class="popup__close"></div>
			<div class="popup__item d-flex">
				<img src="<?php echo get_template_directory_uri();?>/img/popup-img.jpg" alt="">
				<div class="popup__form-block">
					<h2>Заявка на обратный звонок</h2>
					<p>Оставьте заявку и мы свяжемся с вами в течении 15 минут</p>
					<form action="#" class="popup__form">
						<input type="text" name="name" placeholder="Имя" class="popup__form-input input">
						<input type="tel" name="tel" placeholder="Телефон*" class="popup__form-input input">
						<input type="text" name="email" placeholder="Email" class="popup__form-input input">
						<p>Заполняя данную форму вы соглашаетесь с <a href="<?php echo get_permalink(452);?>">политикой конфиденциальности</a></p>
						<button class="popup__form-btn btn">Отправить заявку</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- ===================================================================================================================== -->

<div style="display: none;">
    <div class="box-modal" id="messgeModal">
        <div class="box-modal_close arcticmodal-close"><?_e("закрыть","rubex");?></div>
        
        <div class = "modalline" id = "lineIcon">
        </div>
    
        <div class = "modalline" id = "lineMsg">
        </div>
    </div>
</div>