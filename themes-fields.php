<?

// Описание полей для Carbon_Fields производим только в этом файле
// 1. В начале идет описание полей - Настройки темы  далее категорий (если необходимо) в конце аблонов страниц и записей
// 2. Префиксы проставляем каждый раз новые осмысленно по имени проекта 
// 3. Для Полей которые входят в состав составново схема именования следующая <Общий префикс>_<название составного поля>_<имя поля>
// 4. Название секций Так же придумываем осмысленные на русском языке чтобы небыло сплошных Доп. полей
// 5. Каждый блок комментируем


use Carbon_Fields\Container;
use Carbon_Fields\Field;

Container::make( 'theme_options', __( 'Настройки темы', 'crb' ) )
		->add_fields( array(
			Field::make( 'text', 'mail_to_send', 'E-mail для отправки' )->set_width(50),
			Field::make( 'checkbox', 'load_rew', 'Принимать отзывы' )->set_option_value('no')->set_width(50),
			Field::make('rich_text', 'main_fulltext_top', 'Текст для главной страницы (Верхний)')->set_width(100),
			Field::make('rich_text', 'main_fulltext', 'Текст для главной страницы (SEO)')->set_width(100),
			Field::make('rich_text', 'obmen_fulltext', 'Текст в раздел обмен возврат')->set_width(100),
		) );
		
Container::make('post_meta', 'light_product_cr', 'Характеристики товара')
		->show_on_post_type(array( 'light'))
		  ->add_fields(array(   
			Field::make('textarea', 'offer_smile_descr', 'Краткое описание')->set_width(100),
			Field::make('text', 'offer_name', 'Название товара')->set_width(30),
			Field::make('text', 'offer_label', 'Метка на товаре')->set_width(30),
			Field::make('text', 'offer_allsearch', 'Все артикулы для поиска')->set_width(100),
			Field::make('text', 'offer_siries', 'Серия (для сопутствующих)')->set_width(30),
			Field::make('select', 'offer_type', 'Тип светильника')->add_options( array(
				'0' => 'Не задано',
				'Светодиодный (LED)' => 'Светодиодный (LED)',
				'Цокольный (Со сменными лампами)' => 'Цокольный (Со сменными лампами)'
			) )->set_width(100),

			 Field::make('text', 'offer_sku', 'Артикул (Базовый)')->set_width(50),
			Field::make('text', 'offer_nal', 'Наличие на складе')->set_default_value( 'В наличии')->set_width(50),
			
			Field::make( 'complex', 'offer_cherecter', "Характеристики товара" )
			->add_fields( array(
				Field::make( 'text', 'c_name', 'Наименование параметра' )->set_width(50),
				Field::make( 'text', 'c_val',  'Значение' )->set_width(50),
			) ),

			Field::make('text', 'offer_price', 'Цена (Базовая)')->set_width(50),
			Field::make('text', 'offer_old_price', 'Старая цена (Базовая)')->set_width(50),
			
			Field::make( 'complex', 'offer_modification', "Модификация товара" )
			->add_fields( array(
				Field::make('text', 'mod_name', 'Наименование модификации' )->set_width(20),
				Field::make('text', 'mod_sku', 'Артикул модификации')->set_width(20),
				Field::make('text', 'mod_price', 'Цена модификации')->set_width(20),
				Field::make('text', 'mod_old_price', 'Старая цена модификации')->set_width(20),
				Field::make('text', 'mod_picture_id', 'Изображения модификации')->set_width(20),
			) ),
			  
			Field::make( 'complex', 'offer_picture', "Галерея товара" )
			->add_fields( array(
				Field::make('image', 'gal_img', 'Изображение' )->set_width(30),
				Field::make('text', 'gal_img_sku', 'ID для модификации')->set_width(30),
				Field::make('text', 'gal_img_alt', 'alt и title')->set_width(30)				
			) ),

			Field::make('rich_text', 'offer_fulltext', 'Полное описание (SEO)')->set_width(50),

			Field::make( 'complex', 'offer_rev', "Отзывы о товаре" )
			->add_fields( array(
				Field::make('text', 'rev_name', 'Имя' )->set_width(20),
				Field::make('text', 'rev_mail', 'e-mail' )->set_width(20),
				Field::make('date', 'rev_date', 'Дата отзыва' )->set_width(20),
				Field::make('select', 'rev_reiting', 'Оценка' )->add_options( array(
					'1' => '1',
					'2' => '2',
					'3' => '3',
					'4' => '4',
					'5' => '5'
				) )->set_width(20),
				Field::make('rich_text', 'rev_text', 'Текст отзыва')->set_width(100),
				Field::make('rich_text', 'rev_otv', 'Ответ')->set_width(100)				
			) ),
			
			
			
		  ));

		  
?>