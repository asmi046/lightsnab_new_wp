<?
    //php www/lightsnab.ru/wp-content/themes/light-shop/crm-archiv.php
    require_once("../../../wp-config.php");
        
    $serviceBase = new wpdb(BI_SERVICE_USER_NAME, BI_SERVICE_USER_PASS, BI_SERVICE_DB_NAME, BI_SERVICE_DB_HOST);

	$q = 'SELECT * FROM `zakaz` WHERE `status` = "Новый" AND `zak_final_data` > "'.date('Y-m-d', strtotime('-30 days')).'"';

    $rez = $serviceBase->get_results($q); 

    foreach ($rez as $zak) {
        // $r = $serviceBase->update(`zakaz`, array("status" => "Архив"),array('id' => $zak->id), array('%s'));
        
        $serviceBase->get_results("UPDATE `zakaz` SET `status` = 'Архив' WHERE `zakaz`.`id` = ". $zak->id);
        
        echo $zak->id."\n\r";
    }

?>