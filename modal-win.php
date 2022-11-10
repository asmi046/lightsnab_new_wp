<!-- В этом файле описываем все  всплывающие окна -->

<!-- Popup-Form-JS -->
<!-- Заказать звонок -->
<div class="popup popup-callback popup_callback">
	<div class="popup__content">
		<div class="popup__body">
			<div class="popup__close"></div>
			<div class="popup__item d-flex">
				<img src="<?php echo get_template_directory_uri();?>/img/popup-img.jpg" alt="">
				<div class="popup__form-block">
					<h2>Заявка на обратный звонок</h2>  
					<div class="SendetMsg" style="display:none;">
						Ваше сообщение успешно отправлено.
					</div>
					<div class="headen_form_blk">	
						<p>Оставьте заявку и мы свяжемся с вами в течении 15 минут</p>
						<form action="#" class="popup__form">
							<input type="text" name="name" placeholder="Имя" id="form-callback-name" class="popup__form-input input">
							<input type="tel" name="tel" placeholder="Телефон*" id="form-callback-tel" class="popup__form-input input">
							<input type="text" name="email" placeholder="Email" id="form-callback-email" class="popup__form-input input">
							<p>Заполняя данную форму вы соглашаетесь с <a href="<?php echo get_permalink(3);?>">политикой конфиденциальности</a></p>
							<button class="popup__form-btn callbackBtn btn">Отправить заявку</button> <div class="loaderMain"></div>
						</form> 
					</div> 
				</div>
			</div>
		</div>
	</div>
</div>
<!-- ===================================================================================================================== -->

<!-- Отправить проект на расчет -->
<div class="popup popup-project popup_project">
	<div class="popup__content">
		<div class="popup__body">
			<div class="popup__close"></div>
			<div class="popup__item d-flex">
				<img src="<?php echo get_template_directory_uri();?>/img/popup-img.jpg" alt="">
				<div class="popup__form-block">
					<h2>Отправить проект на расчет</h2>  
					<div class="SendetMsg" style="display:none;">
						Ваше сообщение успешно отправлено.
					</div>
					<div class="headen_form_blk">	
						<p>Отправьте проект нашим специалистам и мы предложим оптимальную смету на освещение</p>
						<form action="#" class="popup__form" enctype="multipart/form-data">
							<input type="text" name="name" placeholder="Имя" id="form-project-name" class="popup__form-input input">
							<input type="tel" name="tel" placeholder="Телефон*" id="form-project-tel" class="popup__form-input input">
							<div class="popup__form-input input">
								<input type="file" name="file" onchange = 'fileloadname(this)' data-lbame = "file-path-name1" multiple="multiple" accept=".txt,image/*" id="input__file" class="popup__input-file popup__input-file_hiden"> 
								<label for="input__file" class="popup__input-file-button">
									<span class="popup__input-file-text" id = "file-path-name1">Загрузите проект</span>
								</label>
							</div>
							<input name = "filleserv" type="hidden" id="file-path-serv" value = "">
							<p>Заполняя данную форму вы соглашаетесь с <a href="<?php echo get_permalink(3);?>">политикой конфиденциальности</a></p> 
							<button class="popup__form-btn projectBtn btn">Отправить заявку</button> <div class="loaderMain"></div>
						</form>
					</div> 
				</div>
			</div>
		</div>
	</div>
</div>
<!-- ===================================================================================================================== -->

<!-- Поиск товара по фотографии -->
<div class="popup popup-search-photo popup_search-photo">
	<div class="popup__content">
		<div class="popup__body">
			<div class="popup__close"></div>
			<div class="popup__item d-flex">
				<img src="<?php echo get_template_directory_uri();?>/img/popup-img.jpg" alt="">
				<div class="popup__form-block">
					<h2>Поиск товара по фотографии</h2>  
					<div class="SendetMsg" style="display:none;">
						Ваше сообщение успешно отправлено. 
					</div>
					<div class="headen_form_blk">	
						<p>Отправьте проект нашим специалистам и мы предложим оптимальную смету на освещение</p>
						<form action="#" class="popup__form" enctype="multipart/form-data">
							<input type="text" name="name" placeholder="Имя" id="form-search-photo-name" class="popup__form-input input">
							<input type="tel" name="tel" placeholder="Телефон*" id="form-search-photo-tel" class="popup__form-input input">
							<div class="popup__form-input input">
								<input type="file" name="file" onchange = 'fileloadname(this)' data-lbame = "file-path-name2" multiple="multiple" accept=".txt,image/*" id="input__file-search-photo" class="popup__input-file popup__input-file_hiden"> 
								<label for="input__file-search-photo" class="popup__input-file-button">
									<span class="popup__input-file-text" id = "file-path-name2">Загрузите фото</span>
								</label>
							</div>
							<input name = "filleserv" type="hidden" id="file-path-serv" value = "">
							<p>Заполняя данную форму вы соглашаетесь с <a href="<?php echo get_permalink(3);?>">политикой конфиденциальности</a></p> 
							<button class="popup__form-btn photoBtn btn">Отправить заявку</button> <div class="loaderMain"></div>
						</form>
					</div>
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