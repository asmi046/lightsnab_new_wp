<?

define("BI_SERVICE_DB_NAME", "u0743099_lscrm");
define("BI_SERVICE_USER_NAME", "u0743099__lscrm");
define("BI_SERVICE_USER_PASS", "2V4o5H6o");
define("BI_SERVICE_DB_HOST", "localhost");

add_action( 'rest_api_init', function () {
register_rest_route( 'lscrm/v2', '/userautorization', array(
		'methods'  => 'GET',
		'callback' => 'user_autorization',
		'args' => array(
			'autinfo' => array(
				'default'           => null,
				'required'          => true,        		
			)
		),
) );
});

//https://lightsnab.ru/wp-json/lscrm/v2/userautorization?autinfo=null
//https://lightsnab.ru/wp-json/lscrm/v2/userautorization?autinfo[mail]=asmi046@gmail.com&autinfo[pass]=1111
function user_autorization( WP_REST_Request $request) {
	
	
	$autinfo = json_decode($request["autinfo"], true);
	
	if (empty($autinfo))
		$autinfo = $request["autinfo"];

	if (empty($autinfo)) return new WP_Error( 'no_user_data', 'Учетные данные не переданы.', [ 'status' => 403 ] );
	
	$mail = $autinfo["mail"];
	$password = $autinfo["pass"];
	$passwordSalt = md5($password."dssff3fxx");

	$token = rand(200000, 300000);

	$serviceBase = new wpdb(BI_SERVICE_USER_NAME, BI_SERVICE_USER_PASS, BI_SERVICE_DB_NAME, BI_SERVICE_DB_HOST);
	
	$user_feeld =  $serviceBase->get_results("SELECT * FROM `service_users` WHERE `mail` = '".$mail."' AND `pass` =  '".$passwordSalt."'");

		if (!empty($user_feeld)) {
			if (empty($user_feeld[0]->autorize))
			return new WP_Error( 'no_checed_user', 'Ваша учетная запись еще не активирована администартором.', [ 'status' => 403 ] );
			
			$updateRez = $serviceBase->update("service_users",
				array(
					"autorizeKey" => $token,
				), 
				array(
					"id" => $user_feeld[0]->id, 
				)
			 );   

			return array(
				"fio" => $user_feeld[0]->fio,
				"podrazdelenie" => $user_feeld[0]->podrazdelenie,
				"mail" => $user_feeld[0]->mail,
				"dolgnost" => $user_feeld[0]->dolgnost,
				"seans_length" => $user_feeld[0]->seans_length,
				"token" => $token
			);
			

		} else {
			return new WP_Error( 'no_user', 'Пользоватея с такими данными нет в системе.', [ 'status' => 403 ] );
		}
}

add_action( 'rest_api_init', function () {
register_rest_route( 'lscrm/v2', '/relogin', array(
	'methods'  => 'GET',
	'callback' => 'relogin',
	'args' => array(
		'mail' => array(
			'default'           => null,
			'required'          => true,        		
		)
	),
) );
});

//https://lightsnab.ru/wp-json/lscrm/v2/relogin?mail=asmi046@gmail.com
function relogin( WP_REST_Request $request) {
	$serviceBase = new wpdb(BI_SERVICE_USER_NAME, BI_SERVICE_USER_PASS, BI_SERVICE_DB_NAME, BI_SERVICE_DB_HOST);
	
	$updateRez = $serviceBase->update("service_users",
		array(
			"autorizeKey" => 0,
		), 
		array(
			"mail" => $request["mail"], 
		)
	);  
	if (!empty($updateRez))
		return array("dell"=> true);
	else 
	return new WP_Error( 'no_token', 'Токен не найден или пользователь уже разлогинен.', [ 'status' => 403 ] ); 

}

add_action( 'rest_api_init', function () {
	register_rest_route( 'lscrm/v2', '/passrec', array(
		'methods'  => 'GET',
		'callback' => 'pass_rec',
		'args' => array(
			'mail' => array(
				'default'           => null,
				'required'          => true,        		
			)
		),
	) );
});

//https://lightsnab.ru/wp-json/lscrm/v2/passrec?mail=asmi046@gmail.com
function pass_rec( WP_REST_Request $request) {
	$serviceBase = new wpdb(BI_SERVICE_USER_NAME, BI_SERVICE_USER_PASS, BI_SERVICE_DB_NAME, BI_SERVICE_DB_HOST);
	
	$user_feeld =  $serviceBase->get_results("SELECT * FROM `service_users` WHERE `mail` = '".$request["mail"]."'");

	if (empty($user_feeld)) return new WP_Error( 'no_user', 'Пользоватея с такими данными нет в системе.', [ 'status' => 403 ] );

	if (empty($user_feeld[0]->autorize)) return new WP_Error( 'no_checed_user', 'Ваша учетная запись еще не активирована администратором.', [ 'status' => 403 ] );

	$newPass = gen_password(4);
	$newPassHesh = md5($newPass."dssff3fxx");
	$updateRez = $serviceBase->update("service_users",
                                   array(
									   "pass" => $newPassHesh,
                                   ), 
                                   array(
                                       "id" => $user_feeld[0]->id, 
                                   )
                                );    

	if (!empty($updateRez))
	{
		$headers = array(
			'From: Корпоративные сервисы RubEx Group <RubExGroup@yandex.ru>', 
			'content-type: text/html',
		);

		add_filter('wp_mail_content_type', create_function('', 'return "text/html";'));
	   
		$mail_message = 
			"<h1>Восстановление пароля</h1>".
			"<p>Ваш логин:<p>".
			"<p>".$request["mail"]."</p>".
			"<p>Ваш новый пароль:<p>".
			"<p>".$newPass."</p>".
			"<a href = 'https://bi.rubexgroup.ru'>Перейти в сервис.</a>";
	  
		if (wp_mail($user_feeld[0]->mail, "Восстановление пароля", $mail_message, $headers))
		{
				return array("send" => true );
		}
			else 
				return new WP_Error( 'no_send_mail', 'Письмо с новым паролем не отправлено, попробуйте позднее или обратитесь к администратору. ', [ 'status' => 403 ] ); 

			return array("dell"=> true);
	}
	else 
		return new WP_Error( 'no_update_base', 'Пароль не изменен обратитесь к администратору.', [ 'status' => 403 ] ); 

}


add_action( 'rest_api_init', function () {
	register_rest_route( 'lscrm/v2', '/getregister', array(
		'methods'  => 'GET',
		'callback' => 'get_getregister',
		'args' => array(
			'reginfo' => array(
				'default'           => null,
				'required'          => true,        		
			)
		),
	) );
});

// https://lightsnab.ru/wp-json/lscrm/v2/getregister?reginfo=null
function get_getregister( WP_REST_Request $request ){

	$serviceBase = new wpdb(BI_SERVICE_USER_NAME, BI_SERVICE_USER_PASS, BI_SERVICE_DB_NAME, BI_SERVICE_DB_HOST);

	$reginfo = json_decode($request["reginfo"], true);

	$addResult = $serviceBase->get_results("SELECT * FROM `service_users` WHERE `mail` = '".$reginfo["mail"]."'");

	if (!empty($addResult))
	return new WP_Error( 'user_exist', 'Пользователь с таким e-mail уже зарегистрирован.', [ 'status' => 403 ] );

	$addResult = $serviceBase->insert('service_users', array(
		"fio" => $reginfo["fio"],
		"mail" => $reginfo["mail"],
		"dolgnost" => $reginfo["dolgnost"],
		"pass" => md5($reginfo["pass"]."dssff3fxx")
	));
	
	if (empty($addResult))
		return new WP_Error( 'no_inser_user', 'При регистрации возникли ошибки попробуйте позднее', [ 'status' => 403 ] );
	else 
		return array("result" => true);
}

//
// Добавление заказа
//


add_action( 'rest_api_init', function () {
	register_rest_route( 'lscrm/v2', '/add_zak', array(
		'methods'  => 'GET',
		'callback' => 'add_zak',
		'args' => array(
			'zakinfo' => array(
				'default'           => null,
				'required'          => true,        		
			),
			'status' => array(
				'default'           => null,
				'required'          => true,        		
			)
		),
	) );
});

// https://lightsnab.ru/wp-json/lscrm/v2/add_zak?zakinfo=null
function add_zak( WP_REST_Request $request ){
	$serviceBase = new wpdb(BI_SERVICE_USER_NAME, BI_SERVICE_USER_PASS, BI_SERVICE_DB_NAME, BI_SERVICE_DB_HOST);

	if (empty($request["zakinfo"])) 
		return new WP_Error( 'no_inser_zak', 'Нет данных для добавления', [ 'status' => 403 ] );

		$zakinfo = json_decode($request["zakinfo"], true);
	$insertZacData = array(
		'mng_name' => $zakinfo["mng_name"], 
		'mng_mail' => $zakinfo["mng_mail"], 
		'zak_numbet' => $zakinfo["zaknumber"], 
		'zak_data' => date("Y-m-d H:i:s", strtotime($zakinfo["data"])), 
		'zak_final_data' => date("Y-m-d H:i:s", strtotime($zakinfo["datafinal"])), 
		'klient_name' => $zakinfo["name"], 
		'phone' => $zakinfo["phone"], 
		'phone2' => $zakinfo["phone2"], 
		'adres' => $zakinfo["adr"], 
		'summa_sheta_1c' => $zakinfo["shetsumm"], 
		'nomer_sheta_1c' => $zakinfo["shetn"], 
		'status' => $request["status"], 
		'comment' => $zakinfo["comment"], 
		'total_summ' => $zakinfo["totalsumm"], 
	);
	$serviceBase->insert('zakaz', $insertZacData);

	$zak_id = $serviceBase->insert_id;

	for ($i = 0; $i<count($zakinfo["zaktovars"]); $i++)
	{
		$serviceBase->insert('zakaz_tovar', array(
			"zak_id" => $zak_id,
			"zak_number" => $zakinfo["zaknumber"],
			"img" => $zakinfo["zaktovars"][$i]["img"],
			"name" => $zakinfo["zaktovars"][$i]["name"],
			"sku" => $zakinfo["zaktovars"][$i]["sku"],
			"count" => $zakinfo["zaktovars"][$i]["count"],
			"price" => $zakinfo["zaktovars"][$i]["price"],
			"sale" => $zakinfo["zaktovars"][$i]["sale"],
			"summ" => $zakinfo["zaktovars"][$i]["summ"],
			"nal" => $zakinfo["zaktovars"][$i]["nal"],
			"comment" => $zakinfo["zaktovars"][$i]["comment"]
		));
	}

	if (empty($serviceBase->insert_id)) {
		return new WP_Error( 'no_inser_zak', 'Заказ не добавлен', [ 'status' => 403 ] );
	} else {
		return array("result" => true, "zinfo" => $zakinfo );
	}

	
}

//
// Редактирование заказа
//


add_action( 'rest_api_init', function () {
	register_rest_route( 'lscrm/v2', '/update_zak', array(
		'methods'  => 'POST',
		'callback' => 'update_zak',
		'args' => array(
			'zaknumber' => array(
				'default'           => "",
				'required'          => true,        		
			),

			'zakinfo' => array(
				'default'           => null,
				'required'          => true,        		
			),

			'status' => array(
				'default'           => null,
				'required'          => true,        		
			)
		),
	) );
});

// https://lightsnab.ru/wp-json/lscrm/v2/update_zak?zakinfo=null
function update_zak( WP_REST_Request $request ){
	$serviceBase = new wpdb(BI_SERVICE_USER_NAME, BI_SERVICE_USER_PASS, BI_SERVICE_DB_NAME, BI_SERVICE_DB_HOST);

	if (empty($request["zakinfo"])) 
		return new WP_Error( 'no_inser_zak', 'Нет данных для добавления', [ 'status' => 403 ] );

		// $zakinfo = json_decode($request["zakinfo"], true);
		
		$zakinfo = $request["zakinfo"];
	
		$insertZacData = array(
			'mng_name' => $zakinfo["mng_name"], 
			'mng_mail' => $zakinfo["mng_mail"], 
			'zak_numbet' => $zakinfo["zaknumber"], 
			'zak_data' => date("Y-m-d H:i:s", strtotime($zakinfo["data"])), 
			'zak_final_data' => date("Y-m-d H:i:s", strtotime($zakinfo["datafinal"])), 
			'klient_name' => $zakinfo["name"], 
			'phone' => $zakinfo["phone"], 
			'phone2' => $zakinfo["phone2"], 
			'adres' => $zakinfo["adr"], 
			'summa_sheta_1c' => $zakinfo["shetsumm"], 
			'nomer_sheta_1c' => $zakinfo["shetn"], 
			'status' => $request["status"], 
			'comment' => $zakinfo["comment"], 
			'total_summ' => $zakinfo["totalsumm"], 
		);

	$updateRez = $serviceBase->update('zakaz', $insertZacData, array("zak_numbet" => $request["zaknumber"]));
	
	$serviceBase->delete('zakaz_tovar', array("zak_number" => $request["zaknumber"]));


	for ($i = 0; $i<count($zakinfo["zaktovars"]); $i++)
	{
		$serviceBase->insert('zakaz_tovar', array(
			"zak_id" => $zakinfo["zak_id"],
			"zak_number" => $request["zaknumber"],
			"img" => $zakinfo["zaktovars"][$i]["img"],
			"name" => $zakinfo["zaktovars"][$i]["name"],
			"sku" => $zakinfo["zaktovars"][$i]["sku"],
			"count" => $zakinfo["zaktovars"][$i]["count"],
			"price" => $zakinfo["zaktovars"][$i]["price"],
			"sale" => $zakinfo["zaktovars"][$i]["sale"],
			"summ" => $zakinfo["zaktovars"][$i]["summ"],
			"nal" => $zakinfo["zaktovars"][$i]["nal"],
			"comment" => $zakinfo["zaktovars"][$i]["comment"]
		));
	}

	if (empty($updateRez)) {
		return new WP_Error( 'no_edit_zak', 'Заказ не изменен', [ 'status' => 403 ] );
	} else {
		return array("result" => true, "zinfo" => $zakinfo );
	}

	// return array("result" => true, "zinfo" => $request["zakinfo"] );
}

//
// Получение товаров для подсказки
//

add_action( 'rest_api_init', function () {
	register_rest_route( 'lscrm/v2', '/get_tovar', array(
		'methods'  => 'GET',
		'callback' => 'get_tovar',
		'args' => array(
			'query' => array(
				'default'           => null,
				'required'          => true,        		
			)
		),
	) );
});

// https://lightsnab.ru/wp-json/lscrm/v2/get_tovar?query=1122
function get_tovar( WP_REST_Request $request ){
	$serviceBase = new wpdb(BI_SERVICE_USER_NAME, BI_SERVICE_USER_PASS, BI_SERVICE_DB_NAME, BI_SERVICE_DB_HOST);

	if (empty($request["query"])) 
		return new WP_Error( 'no_query_string', 'Нет данных для добавления', [ 'status' => 403 ] );
	
	$rez = $serviceBase->get_results('SELECT * FROM `tovar_base` WHERE `sku` LIKE "%'. $request["query"] .'%" OR `name` LIKE "%'. $request["query"] .'%" OR `search_str` LIKE "%'. $request["query"] .'%" LIMIT 30');

	return $rez;
}

//
// Получение заказов
//

add_action( 'rest_api_init', function () {
	register_rest_route( 'lscrm/v2', '/get_zakaz', array(
		'methods'  => 'GET',
		'callback' => 'get_zakaz',
		'args' => array(
			'querystr' => array(
				'default'           => "%",        		
			),
			'status' => array(
				'default'           => "",        		
			)
		),
	) );
});

// https://lightsnab.ru/wp-json/lscrm/v2/get_zakaz?query=1122
function get_zakaz( WP_REST_Request $request ){
	$serviceBase = new wpdb(BI_SERVICE_USER_NAME, BI_SERVICE_USER_PASS, BI_SERVICE_DB_NAME, BI_SERVICE_DB_HOST);
	
	$queryStr = ($request["querystr"] !== "%" )?"%".$request["querystr"]."%":$request["querystr"];
	$ststus = ($request["status"] !== "" )?$request["status"]:"%";

	$rez = $serviceBase->get_results("SELECT * FROM `zakaz` WHERE `status` LIKE '".$ststus."' AND (`klient_name` LIKE '".$queryStr."' OR `zak_numbet` LIKE '".$queryStr."')");
	
	return $rez;
}

//
// Удаление номеров
//

add_action( 'rest_api_init', function () {
	register_rest_route( 'lscrm/v2', '/del_order', array(
		'methods'  => 'DELETE',
		'callback' => 'del_order',
		'args' => array(
			'orderid' => array(
				'default'           => 0,
				'required'          => true,              		
			),
			
		),
	) );
});

// https://lightsnab.ru/wp-json/lscrm/v2/del_order?orderid=1122
function del_order( WP_REST_Request $request ){
	$serviceBase = new wpdb(BI_SERVICE_USER_NAME, BI_SERVICE_USER_PASS, BI_SERVICE_DB_NAME, BI_SERVICE_DB_HOST);
	

	 $rez = $serviceBase->delete("zakaz", array("id" => $request['orderid']));
	
	if ($rez === false) 
		return new WP_Error( 'no_del_faild', 'При удалении заказа возникла ошибка', [ 'status' => 403 ] );
	
	 $rezTov = $serviceBase->delete("zakaz_tovar", array("zak_number" => $request['orderid']));
	
	if ($rezTov === false) 
		return new WP_Error( 'no_del_tov_faild', 'При удалении товаров заказа возникла ошибка сообщите администратору.', [ 'status' => 403 ] );

	return array("id" => $request['orderid'], "dellzak" => $rez, "delltov" => $rezTov);
}

//
// Получение товаров заказа
//

add_action( 'rest_api_init', function () {
	register_rest_route( 'lscrm/v2', '/get_order_tovar', array(
		'methods'  => 'GET',
		'callback' => 'get_order_tovar',
		'args' => array(
			'orderid' => array(
				'default'           => 0,
				'required'          => true,              		
			),
			
		),
	) );
});

// https://lightsnab.ru/wp-json/lscrm/v2/get_order_tovar?orderid=1122
function get_order_tovar( WP_REST_Request $request ){
	$serviceBase = new wpdb(BI_SERVICE_USER_NAME, BI_SERVICE_USER_PASS, BI_SERVICE_DB_NAME, BI_SERVICE_DB_HOST);
	
	$rezTov = $serviceBase->get_results("SELECT * FROM `zakaz_tovar` WHERE `zak_number` = '".$request["orderid"]."'");
	for ($i = 0; $i< count($rezTov); $i++) {
		$rezTov[$i]->imgBase64 = 'data:image/jpg;base64,'.base64_encode(file_get_contents($rezTov[$i]->img));
	}
	if ($rezTov === false) 
		return new WP_Error( 'no_del_tov_faild', 'Нет товаров в данном заказе.', [ 'status' => 403 ] );

	return $rezTov;
}

//
// Добавление товара в справочник
//

add_action( 'rest_api_init', function () {
	register_rest_route( 'lscrm/v2', '/add_tov_to_base', array(
		'methods'  => 'POST',
		'callback' => 'add_tov_to_base',
		'args' => array(
			'name' => array(
				'default'           => 0,
				'required'          => true,              		
			),
			'sku' => array(
				'default'           => 0,            		
			),
			'search' => array(
				'default'           => 0            		
			),
			
		),
	) );
});

// https://lightsnab.ru/wp-json/lscrm/v2/add_tov_to_base?orderid=1122
function add_tov_to_base( WP_REST_Request $request ){
	$serviceBase = new wpdb(BI_SERVICE_USER_NAME, BI_SERVICE_USER_PASS, BI_SERVICE_DB_NAME, BI_SERVICE_DB_HOST);
	
	return $rezTov;
}

?>