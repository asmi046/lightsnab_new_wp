<?php
require_once("csvClass.php");

add_action('admin_menu', function(){	
	add_menu_page(
		"Управление магазином",
		"Магазин",
		"manage_options",
		"upravlenie-magazinom",
		"magaz_managment",
		"dashicons-visibility",
		100
	);
});

?>

<?php 
	$errors = "";
	
	function add_one_elem($addetData) {
		$data["name"] = $addetData["name"];
		$data["code"] = $addetData["code"];
		$data["code01"] = empty($addetData["code01"])?"":$addetData["code01"];
		$data["code02"] = empty($addetData["code02"])?"":$addetData["code02"];
		$data["code2"] = $addetData["code2"];
		$data["count"] = $addetData["count"];
		$data["price"] = $addetData["price"];
		
		
			global $wpdb;
			$addrez = $wpdb->insert('am_nal',$data, array("%s", "%s", "%s", "%s", "%s", "%d", "%f"));
		
		return $addrez;
	}

	
?>

<?php
function magaz_managment() {
	
	// добавление элемента
	if (isset($_POST["addElem"]))
	{
		if ((!empty($_POST["code"]))||(!empty($_POST["count"]))||(!empty($_POST["price"])))
		{
			if (add_one_elem($_POST)) 
				$errors .= "<span class = 'rezEl rezOk'>Позиция добавленна</span>";
			else
				$errors .= "<span class = 'rezEl rezErr'>Позиция НЕ добавленна!</span>";
		} else {
			$errors .= "<span class = 'rezEl rezErr'>Поля 'Артикул', 'Колличество', 'Цена' должны быть заполнены.</span>";
		}
	}
	// добавление файла
	if (isset($_POST["addFile"]))
	{
		if ($_POST["erize"] == true) {
			global $wpdb;
			$addrez = $wpdb->query('TRUNCATE am_nal');
		}
	
		$newFn = get_template_directory()."/upload/".basename($_FILES['fileLoad']['name']);
		
		if (move_uploaded_file($_FILES['fileLoad']['tmp_name'], $newFn)) {
			$csvPars = new CSV($newFn);
			$elems = $csvPars->getCSV();
			
			$allCount = 0;
			$loaded = 0;
			
			foreach($elems as &$Row) 
			{
				$data = array();
				
				$data["name"] = trim(mb_ucfirst(iconv("cp1251", "utf8",$Row[0])));
				$data["code"] = clearArticle(iconv("cp1251", "utf8",$Row[1]));
				
				$realCodes = explode("=",$data["code"]);
				
				if (count($realCodes)>1) {
					$data["code"] = $realCodes[0];
					$data["code01"] = $realCodes[1];
					$data["code02"] = $realCodes[2];
				}
				
				
				$data["code2"] = clearArticle(iconv("cp1251", "utf8",$Row[2]));
				$data["count"] = trim(iconv("cp1251", "utf8",$Row[3]));
				$data["price"] = trim(iconv("cp1251", "utf8",$Row[4]));
				
				if (add_one_elem($data)) $loaded++;
					
				$allCount++;
			}
			
			
			$errors .= "<span class = 'rezEl rezOk'>Файл загружен</span>";
			$errors .= "<span class = 'rezEl rezOk'>Всего записей ".$allCount." Добавлено ".$loaded."</span>";
		} else {
			$errors .= "<span class = 'rezEl rezErr'>Файл не загружен. ".get_template_directory()."/upload/".basename($_FILES['fileLoad']['name'])."</span>";
		}
	}
	//редактирование записи
	
	if (isset($_POST["nalSave"]))
	{
		global $wpdb;
		$updateRez = $wpdb->update( 'am_nal',
			array( 'count' => $_POST['count'], 'price' => $_POST['price'] ),
			array( 'id' => $_POST['id'] ),
			array( '%d', '%f' ),
			array( '%d')
		);
		
		if ($updateRez) {
			$errors .= "<span class = 'rezEl rezOk'>Запись изменена</span>";
		} else {
			if ($updateRez == 0)
				$errors .= "<span class = 'rezEl rezErr'>Данные не изменены но ошибок нет!</span>";
			else 
				$errors .= "<span class = 'rezEl rezErr'>Ошибка изменения данных</span>";
		}
	}
	
	if (isset($_POST["nalDelete"]))
	{
		global $wpdb;
		$rez = $wpdb->delete('am_nal', array( 'id' => $_POST['id'] ), array( '%d' ) );
		
		if (empty($rez))
			$errors .= "<span class = 'rezEl rezErr'>Данные не удалены!</span>";
		else 
			$errors .= "<span class = 'rezEl rezOk'>Удалено ".$rez." позиций</span>";
	}
?>
	<div id = "wpbody-content" class="wrapEr">
		<h1>Управление магазином</h1>
		<div class = "pages">
			<a href = "?page=upravlenie-magazinom">Собственное наличие</a>
			<a href = "?page=magaz_zakz_managment">Заказы</a>
		</div>
		
		<div class = "errElems">
			<?php 
				echo $errors;
			?>
		</div>
		<div class = "searchString">
			<form method = "post">
				<input type = "text" id = "searchStr" name = "searchStr" value = "<?php echo $_POST["searchStr"];?>" placeholder = "Отбор по наименованию или артикулу"> <input type = "submit" name = "searchElem" value = "Найти"><br/>
			</form>
		</div>
		
		<div class = "tableWriper">
			<table class = "magaz-table">
				<thead>
					<tr>
						<th>Наименование</th>
						<th>Артикул</th>
						<th>Артикул 1</th>
						<th>Артикул 2</th>
						<th>Замена</th>
						<th>Колличество</th>
						<th>Цена</th>
						<th>Действие</th>
					</tr>
				</thead>
				<tbody>
					<?php
						global $wpdb;
						
						$searchStr = empty ($_POST["searchStr"])?"%":("%".$_POST["searchStr"]."%");
						
						$positions = $wpdb->get_results('SELECT * FROM  `am_nal` WHERE (`am_nal`.`name` LIKE "'.$searchStr.'" OR `am_nal`.`code` LIKE "'.$searchStr.'"  OR `am_nal`.`code01` LIKE "'.$searchStr.'"  OR `am_nal`.`code02` LIKE "'.$searchStr.'" OR `am_nal`.`code2` LIKE "'.$searchStr.'") AND `am_nal`.`count` > 0');
						//echo 'SELECT * FROM  `am_nal` WHERE (`am_nal`.`name` LIKE "'.$searchStr.'" OR `am_nal`.`code` LIKE "'.$searchStr.'") AND `am_nal`.`count` > 0';
						foreach ($positions as $position) {
						?>
							<tr>		
								<form method = "post" >
									<td><?php echo $position->name; ?></td>
									<td><?php echo $position->code; ?></td>
									<td><?php echo $position->code01; ?></td>
									<td><?php echo $position->code02; ?></td>
									<td><?php echo $position->code2; ?></td>
									<td><input type = "text" name = "count" value = "<?php echo $position->count; ?>"></td>
									<td><input type = "text" name = "price" value = "<?php echo $position->price; ?>"></td>
									<td>
											<input type = "hidden" name = "id" value = "<?php echo $position->id; ?>" >
											<input type = "hidden" name = "name" value = "<?php echo $position->name; ?>" >
											<input type = "hidden" name = "code" value = "<?php echo $position->code; ?>" >
											<input type = "hidden" name = "code2" value = "<?php echo $position->code2; ?>" >
											
											<button id = "nalSave" name = "nalSave" type = "submit" title = "Сохранить данные" ><span class="dashicons dashicons-yes"></span></button>
											<button id = "nalDelete" name = "nalDelete" type = "submit" title = "Удалить данные"><span class="dashicons dashicons-no"></span></button>
									</td>
								</form>
							</tr>		
						<?php
						}
					?>
				</tbody>
			</table>
		</div>
		
		
		<form id = "addForm" method = "post">
			<h2>Добавить элемент</h2>
			
			<input type = "hidden" name = "page" value = "upravlenie-magazinom" ><br/>
			
			<input type = "text" name = "name" value = "" placeholder = "Наименование детали"><br/>
			<input type = "text" name = "code" value = "" placeholder = "Артикул"><br/>
			<input type = "text" name = "code01" value = "" placeholder = "Артикул 1"><br/>
			<input type = "text" name = "code02" value = "" placeholder = "Артикул 2"><br/>
			<input type = "text" name = "code2" value = "" placeholder = "Замена"><br/>
			<input type = "text" name = "count" value = "" placeholder = "Колличество"><br/>
			<input type = "text" name = "price" value = "" placeholder = "Цена"><br/><br/>
			<input type = "submit" name = "addElem" value = "Добавить"><br/>
		</form>
		
		<form enctype="multipart/form-data" id = "addFileForm" method = "post">
			<h2>Добавить из файла</h2>
			<input type="file" id="fileLoad" name="fileLoad" ><br/><br/>
			<input type = "checkbox" name = "erize" id = "erize"><label for = "erize">Очистить таблицу</label><br/><br/>
			<input type = "submit" name = "addFile" value = "Загрузить файл"><br/>
		</form>
	</div>
<?php
}
?>