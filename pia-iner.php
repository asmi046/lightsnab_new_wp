<?php
add_action('admin_menu', function(){	
	add_submenu_page(
		"upravlenie-magazinom",
		"Управление заказами",
		"Управление заказами",
		"manage_options",
		"magaz_zakz_managment",
		"magaz_zakz_managment",
		100
	);
});
?>

<?php
	function magaz_zakz_managment() {
?>
	<script>
		function detalstatus(idelem,values){
				console.log(values);
				
				var  jqXHR = jQuery.post(
				ajaxurl,
					{
						action: 'detal_update',
						did: idelem,
						values:	values
					}
				);
				
						
				jqXHR.done(function (responce) {
					
				});

				
				jqXHR.fail(function (responce) {
					console.log(responce);
				});
		}
	
		jQuery(document).ready(function() { 
			
			
			
			
			jQuery("#vStatus").change(function(){
				var tNum =jQuery(this).data("id");
				console.log(tNum);
				var  jqXHR = jQuery.post(
				ajaxurl,
					{
						action: 'zakaz_update',
						number: tNum,
						values:	jQuery("#vStatus option:selected").val()
					}
				);
				
						
				jqXHR.done(function (responce) {
					jQuery("#ztStatus"+tNum).html(jQuery("#vStatus option:selected").val());
					
				});

				
				jqXHR.fail(function (responce) {
					console.log(responce);
				});
				
			});
			
			jQuery(".tzRow").click(function(){
				jQuery(".tzRow").removeClass("tzRowSel");
				jQuery(this).addClass("tzRowSel");
	
				jQuery("#vNumber").html(jQuery(this).find(".ztNumber").html());
				jQuery("#vData").html(jQuery(this).find(".ztData").html());
				jQuery("#vFio").html(jQuery(this).find(".ztFio").html());
				jQuery("#vSumm").html(jQuery(this).find(".ztSumm").html());
				jQuery("#vEmail").html(jQuery(this).find(".ztEmail").html());
				jQuery("#vPhone").html(jQuery(this).find(".ztPhone").html());
				jQuery("#vComment").html(jQuery(this).find(".ztComment").html());
				jQuery("#vStatus").data("id",jQuery(this).data("id"));
				
				jQuery("#vStatus option").removeAttr("selected");
				jQuery("#vStatus").removeAttr("disabled");
				jQuery("#vStatus option[value='"+jQuery(this).find(".ztStatus").html()+"']").attr("selected","true");
				jQuery("#vOplata").html(jQuery(this).find(".ztOplata").html());
				
				jQuery("#vComment").html(jQuery(this).find(".ztComment").html());
				
				
				var  jqXHR = jQuery.post(
				ajaxurl,
					{
						action: 'zakaz_get',
						number: jQuery(this).find(".ztNumber").html(), 
					}
				);
				
						
				jqXHR.done(function (responce) {
					jQuery(".tz").html(responce);
				});

				
				jqXHR.fail(function (responce) {
					console.log(responce);
				});
				
				
			}); 
		});
	</script>

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
		
		<div class = "zakPageSide" id = "zakPageSideLeft">
			<div class = "tableWriper">
				<table class = "magaz-table">
					<thead>
						<tr>
							<th>Номер заказа</th>
							<th>Дата</th>
							<th>Ф.И.О.</th>
							<th>Сумма</th>
							<th>Статус</th>
							<th>Оплата</th>
						</tr>
					</thead>
					<tbody>
						<?php
							global $wpdb;
							$zakRez = $wpdb->get_results('SELECT * FROM  `am_zak` ORDER BY  `am_zak`.`data` DESC');
							foreach ($zakRez as $s) {
							?>
								<tr  class = "tzRow" data-id = "<?php echo $s->number; ?>" id = "tzRow<?php echo $s->number; ?>">
									<td class = "ztNumber"><?php echo $s->number; ?></td>
									<td class = "ztData"><?php echo $s->data; ?></td>
									<td class = "ztFio"><?php echo $s->fio; ?></td>
									<td class = "ztSumm"><?php echo $s->summ; ?></td>
									<td class = "ztNovisible ztEmail" ><?php echo $s->email; ?></td>
									<td class = "ztNovisible ztPhone"><?php echo $s->phone; ?></td>
									<td class = "ztNovisible ztComment"><?php echo $s->comment; ?></td>
									<td class = "ztStatus" id = "ztStatus<?php echo $s->number; ?>"><?php echo $s->status; ?></td>					
									<td class = "ztOplata"><?php echo ((empty($s->oplata))?"<span class = 'neoplahen'>Не оплачен</span>":"<span class = 'oplahen'>Оплачен</span>"); ?></td>					
								</tr>
							<?php
							}
						?>
					</tbody>
				</table>
			</div>
		</div>
		
		<div class = "zakPageSide" id = "zakPageSideRight">
			<h2>Детали заказа</h2>
			<table class = "zakDetalesTable">
				<tr><th>Номер закза:</th> <td><span id = "vNumber"></span><td></tr>
				<tr><th>Дата оформления закза:</th> <td> <span id = "vData"></span><td></tr>
				<tr><th>Ф.И.О. заказчика:</th> <td> <span id = "vFio"></span><td></tr>
				<tr><th>Сумма заказа:</th> <td> <span id = "vSumm"></span><td></tr>
				<tr><th>e-mail заказчика:</th> <td> <span id = "vEmail"></span><td></tr>
				<tr><th>Телефон заказчика:</th> <td> <span id = "vPhone"></span><td></tr>
				<tr><th>Оплата:</th> <td> <span id = "vOplata"></span><td></tr>
				<tr>
					<th>Статус закза:</th> 
					<td> 
						<select disabled  id = "vStatus" value = "vStatus" data-id = "<?php echo $s->number; ?>">
							<option value = "Принят">Принят</option>
							<option value = "Обработан">Обработан</option>
							<option value = "Частично готов">Частично готов</option>
							<option value = "Готов">Готов</option>
							<option value = "Архив">Архив</option>
						</select>
					<td>
				</tr>
			</table>
			<h2>Комментарий к заказу:</h2> 
			<span id = "vComment"></span><br/>
			<h2>Заказ:</h2> 
			<div class = "tz">
			
			</div>
		</div>
	</div>
<?php
	}
?>