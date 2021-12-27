<?

//
// Добавление маршрутных листов
//

add_action( 'rest_api_init', function () {
	register_rest_route( 'lscrm/v2', '/add_road_list', array(
		'methods'  => 'POST',
		'callback' => 'add_road_list',
		'args' => array(
			'data' => array(
				'default'           => "",
			)
			
		),
	) );
});


// https://lightsnab.ru/wp-json/lscrm/v2/add_road_list
function add_road_list( WP_REST_Request $request ){
	
	$serviceBase = new wpdb(BI_SERVICE_USER_NAME, BI_SERVICE_USER_PASS, BI_SERVICE_DB_NAME, BI_SERVICE_DB_HOST);
	
	$data = empty($request["data"])?date("Y-m-d"):date("Y-m-d", strtotime($request["data"]));

	$addResult = $serviceBase->insert("road_lists", array(
		"data" => $data,
		"status" => "Активный",
	));

	return array("result" => $addResult);
}

//
// Получение списка маршрутных листов
//

add_action( 'rest_api_init', function () {
	register_rest_route( 'lscrm/v2', '/get_road_list', array(
		'methods'  => 'GET',
		'callback' => 'get_road_list',
		'args' => array(
			'start' => array(
				'default'           => "",
			),
			'end' => array(
				'default'           => "",
			),
			'status' => array(
				'default'           => "",            		
			)
			
		),
	) );
});


// https://lightsnab.ru/wp-json/lscrm/v2/get_road_list?start=2021-12-17&end=2021-12-21
function get_road_list( WP_REST_Request $request ){
	
	$serviceBase = new wpdb(BI_SERVICE_USER_NAME, BI_SERVICE_USER_PASS, BI_SERVICE_DB_NAME, BI_SERVICE_DB_HOST);
	

	$start = empty($request["start"])?date("Y-m-d"):date("Y-m-d", strtotime($request["start"]));
	$end = empty($request["end"])?date("Y-m-d"):date("Y-m-d", strtotime($request["end"]));
	$status = empty($request["status"])?"%":$request["status"];

	$q = "SELECT * FROM `road_lists` WHERE `status` LIKE '".$status."' AND (`data` >= '".$start."' AND `data` <= '".$end."')";

	$lists = $serviceBase->get_results($q);

	return array("result" => $lists, "q" =>$q);
	return $lists;
}

//
// Сохранение маршрутного листа
//

add_action( 'rest_api_init', function () {
	register_rest_route( 'lscrm/v2', '/update_road_list', array(
		'methods'  => 'POST',
		'callback' => 'update_road_list',
		'args' => array(
			'data' => array(
				'default'           => "",
				'required'          => true,  
			),

			'status' => array(
				'default'           => "",
				'required'          => true,  
			),

			'driver' => array(
				'default'           => "", 
			),

			'comment' => array(
				'default'           => "", 
			)
			
		),
	) );
});


// https://lightsnab.ru/wp-json/lscrm/v2/add_road_list
function update_road_list( WP_REST_Request $request ){
	
	$serviceBase = new wpdb(BI_SERVICE_USER_NAME, BI_SERVICE_USER_PASS, BI_SERVICE_DB_NAME, BI_SERVICE_DB_HOST);
	
	$data = empty($request["data"])?date("Y-m-d"):$request["data"];

	$addResult = $serviceBase->update("road_lists", array(
			"data" => $data,
			"status" => $request["status"],
			"driver" => $request["driver"],
			"comment" => $request["comment"],
		),
		array("id" => $request["id"])
	);

	return array("result" => $addResult);
}

//
// Удаление маршрутных листов
//

add_action( 'rest_api_init', function () {
	register_rest_route( 'lscrm/v2', '/del_road_list', array(
		'methods'  => 'DELETE',
		'callback' => 'del_road_list',
		'args' => array(
			'listid' => array(
				'default'           => 0,
				'required'          => true,              		
			),
			
		),
	) );
});

// https://lightsnab.ru/wp-json/lscrm/v2/del_road_list?orderid=1122
function del_road_list( WP_REST_Request $request ){
	$serviceBase = new wpdb(BI_SERVICE_USER_NAME, BI_SERVICE_USER_PASS, BI_SERVICE_DB_NAME, BI_SERVICE_DB_HOST);
	

	$rez = $serviceBase->delete("road_lists", array("id" => $request['listid']));
	
	if ($rez === false) 
		return new WP_Error( 'no_del_faild', 'При удалении заказа возникла ошибка', [ 'status' => 403 ] );
	
	
	return array("id" => $request['orderid'], "delllist" => $rez);
}

//
// Добавление складов в маршрутные листы
//

add_action( 'rest_api_init', function () {
	register_rest_route( 'lscrm/v2', '/add_sclad_to_road_list', array(
		'methods'  => 'POST',
		'callback' => 'add_sclad_to_road_list',
		'args' => array(
			'rlid' => array(
				'default'           => 0,
				'required'          => true,
			),
			'scladinfo' => array(
				'default'           => [],
				'required'          => true,
			)
			
		),
	) );
});


// https://lightsnab.ru/wp-json/lscrm/v2/add_sclad_to_road_list
function add_sclad_to_road_list( WP_REST_Request $request ){
	
	$serviceBase = new wpdb(BI_SERVICE_USER_NAME, BI_SERVICE_USER_PASS, BI_SERVICE_DB_NAME, BI_SERVICE_DB_HOST);
	
	
	$addResult = $serviceBase->insert("road_lists_sklads", array(
		"road_list_id" => $request['rlid'],
		"sklad_name" => $request['scladinfo']["skladname"],
		"sklad_id" => $request['scladinfo']["skladid"],
		"pay" => $request['scladinfo']["pay"],
		"document" => $request['scladinfo']["document"],
		"commen" => $request['scladinfo']["comment"],
	));

	return array("result" => $addResult);
}

//
// Добавление доставок в маршрутные листы
//

add_action( 'rest_api_init', function () {
	register_rest_route( 'lscrm/v2', '/add_delivery_to_road_list', array(
		'methods'  => 'POST',
		'callback' => 'add_delivery_to_road_list',
		'args' => array(
			'rlid' => array(
				'default'           => 0,
				'required'          => true,
			),
			'zaknumber' => array(
				'default'           => 0,
				'required'          => true,
			),
			'deliveryinfo' => array(
				'default'           => [],
				'required'          => true,
			)
			
		),
	) );
});


// https://lightsnab.ru/wp-json/lscrm/v2/add_delivery_to_road_list
function add_delivery_to_road_list( WP_REST_Request $request ){
	
	$serviceBase = new wpdb(BI_SERVICE_USER_NAME, BI_SERVICE_USER_PASS, BI_SERVICE_DB_NAME, BI_SERVICE_DB_HOST);
	
	
	$addResult = $serviceBase->insert("road_lists_delivey", array(
		"road_list_id" => $request['rlid'],
		"klient_name" => $request['deliveryinfo']["klient_name"],
		"adres" => $request['deliveryinfo']["adres"],
		"comment" => $request['deliveryinfo']["comment"],
	));

	if ($addResult === false) 
		return new WP_Error( 'no_add_deliveri', 'Не удалось добавить доставку', [ 'status' => 403 ] );

	$zakResult = $serviceBase->update('zakaz', ["in_road_list" => $request['rlid']], ["zak_numbet" => $request['zaknumber']]);

	return array("result_field" => $addResult, "result_zak" => $zakResult);
}

//
// Получение данных маршрутного листа
//

add_action( 'rest_api_init', function () {
	register_rest_route( 'lscrm/v2', '/get_road_list_data', array(
		'methods'  => 'GET',
		'callback' => 'get_road_list_data',
		'args' => array(
			'mlid' => array(
				'default'           => "",
				'required'          => true,
			)
		),
	) );
});


// https://lightsnab.ru/wp-json/lscrm/v2/get_road_list_data?mlid=5
function get_road_list_data( WP_REST_Request $request ){
	
	$serviceBase = new wpdb(BI_SERVICE_USER_NAME, BI_SERVICE_USER_PASS, BI_SERVICE_DB_NAME, BI_SERVICE_DB_HOST);
	
	$q = "SELECT * FROM `road_lists_sklads` WHERE `road_list_id` = ".$request['mlid'];

	$lists_sklad = $serviceBase->get_results($q);

	$sklad_result = [];
	foreach ($lists_sklad as $sk) {
		$sklad_result[$sk->sklad_name][] =  $sk;
	}

	$q = "SELECT * FROM `road_lists_delivey` WHERE `road_list_id` = ".$request['mlid'];

	$lists_delivery = $serviceBase->get_results($q);

	return array("sklads" => $sklad_result, "delivery" => $lists_delivery, "q" =>$q);
	
}

//
// Удаление склада
//

add_action( 'rest_api_init', function () {
	register_rest_route( 'lscrm/v2', '/delete_sclad_in_road_list', array(
		'methods'  => 'DELETE',
		'callback' => 'delete_sclad_in_road_list',
		'args' => array(
			'id' => array(
				'default'           => "",
				'required'          => true,
			)
		),
	) );
});


// https://lightsnab.ru/wp-json/lscrm/v2/delete_sclad_in_road_list?id=5
function delete_sclad_in_road_list( WP_REST_Request $request ){
	
	$serviceBase = new wpdb(BI_SERVICE_USER_NAME, BI_SERVICE_USER_PASS, BI_SERVICE_DB_NAME, BI_SERVICE_DB_HOST);
	
	$rez = $serviceBase->delete("road_lists_sklads", array("id" => $request['id']));
	
	if ($rez === false) 
		return new WP_Error( 'no_del_faild', 'При удалении склада возникла ошибка', [ 'status' => 403 ] );

	return array("result" => $rez);
}


//
// Удаление доставки
//

add_action( 'rest_api_init', function () {
	register_rest_route( 'lscrm/v2', '/delete_delivery_in_road_list', array(
		'methods'  => 'DELETE',
		'callback' => 'delete_delivery_in_road_list',
		'args' => array(
			'id' => array(
				'default'           => "",
				'required'          => true,
			)
		),
	) );
});


// https://lightsnab.ru/wp-json/lscrm/v2/delete_delivery_in_road_list?id=5
function delete_delivery_in_road_list( WP_REST_Request $request ){
	
	$serviceBase = new wpdb(BI_SERVICE_USER_NAME, BI_SERVICE_USER_PASS, BI_SERVICE_DB_NAME, BI_SERVICE_DB_HOST);
	
	$rez = $serviceBase->delete("road_lists_delivey", array("id" => $request['id']));
	
	if ($rez === false) 
		return new WP_Error( 'no_del_faild', 'При удалении доставки возникла ошибка', [ 'status' => 403 ] );

	return array("result" => $rez);
}

?>