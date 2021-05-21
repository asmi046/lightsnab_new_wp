<?
        //php www/lightsnab.ru/wp-content/themes/light-shop/pars/parsTov-mebel.php
        ini_set('max_execution_time', 9000);

        require_once("../../../../wp-config.php");
        
        require_once ABSPATH . 'wp-admin/includes/media.php';
        require_once ABSPATH . 'wp-admin/includes/file.php';
        require_once ABSPATH . 'wp-admin/includes/image.php';

        include_once("simple_html_dom.php");

        global $wpdb;
        
        $tovArr = $wpdb->get_results("SELECT * FROM `lshop_parsed_tovars` WHERE `post_id` = 0 ORDER BY rand() LIMIT 1000");
        
        $indexAdd = 0;
        foreach ($tovArr  as $tt)
        {
            if (empty($tt->price)) continue;
            echo "Обробатываем: ".$tt->lnk. "\n\r";
            
            if (get_headers($tt->lnk, 1)[0] === "HTTP/1.1 404 Not Found") {
                $wpdb->update( "lshop_parsed_tovars", array("post_id" => 9999999), array("lnk" => $tt->lnk), array('%d'), array('%s') );
                continue;
            }

            $html = file_get_html($tt->lnk);

            //$html = file_get_html("https://loft-concept.ru/catalog/mebel_inkrustirovannaya_kostyu/bolshie_dveri_inkrustirovannye_kostyu/");

            $tovarInfo = array();
            
            

            $tovarInfo["cat"] = "Мебель";
            $tovarInfo["subcat"] = $tt->cat;
            
            $tovarInfo["name"] = $html->find('h1')[0]->plaintext;
            // $tovarInfo["sku"] = str_replace(array(" ","Артикул:"), "", $html->find('.product-summary')[0]->plaintext);
            $tovarInfo["price"] = $tt->price;

            // if (!empty($html->find('#product-description')[0])) $tovarInfo["description"] = $html->find('#product-description')[0]->children(0)->children(0)->plaintext;;
            
            if (!empty($html->find('.detail-text')[0])) 
            {
                

                $textDescr = $html->find('.detail-text')[0]->plaintext;

                $tovarInfo["description"] = trim(strip_tags($textDescr));
                
                if (empty($tovarInfo["description"])) $tovarInfo["description"] = "Товар: ".$tovarInfo["name"];
            }
             
            
            $tovarInfo["caracter"] = array();
            $table = $html->find('#mainproperties')[0];

            if (!empty($table))
            foreach($table->find('tr') as $cr) {
                $crLine = $cr->find("td");
                $toc["name"] = trim($crLine[0]->plaintext);
                $toc["value"] = trim($crLine[1]->plaintext);
                
                if ($toc["name"] === "Место использования") $toc["value"] = str_replace (array(" ", ""), "", $toc["value"] );
                
                
                $tovarInfo["caracter"][] =  $toc;
                if ($toc["name"] === "Артикул") $tovarInfo["sku"] = $toc["value"];
            }

     
            $tovarInfo["images"] = array();

            
            $img["lnk"] = "https://loft-concept.ru".$html->find('.detail-flexslider-img')[0]->src;
            $tovarInfo["images"][] =  $img;

            foreach($html->find('.carousel-top') as $cr) {
                $img["lnk"] = "https://loft-concept.ru".$cr->src;
            
                $tovarInfo["images"][] =  $img;
            }

            // --------------- Делаем пост --------------------

            $to_post_meta  = [ 
                '_offer_smile_descr' => "Товар: ".$tovarInfo["name"], 
                '_offer_type' => "", 
                '_offer_sku' => $tovarInfo["sku"], 
                '_offer_nal' => 'В наличии', 
                '_offer_price' => $tovarInfo["price"],
                '_offer_fulltext' => $tovarInfo["description"],
                '_offer_name' => $tovarInfo["name"],
                '_offer_allsearch' => $tovarInfo["name"]." ".$tovarInfo["sku"],
            ];

            $indexCh = 0;
            foreach ($tovarInfo["caracter"] as $carrecter) {
                $to_post_meta["_offer_cherecter|c_name|".$indexCh."|0|value"] = $carrecter["name"];
                $to_post_meta["_offer_cherecter|c_val|".$indexCh."|0|value"] = $carrecter["value"];
                $indexCh++;
            }


            // $indexMod = 0;
            // foreach ($tovarInfo["modification"] as $modif) {
            //     $to_post_meta["_offer_modification|mod_name|".$indexMod."|0|value"] = $modif["name"];
            //     $to_post_meta["_offer_modification|mod_sku|".$indexMod."|0|value"] = $modif["sku"];
            //     $to_post_meta["_offer_modification|mod_price|".$indexMod."|0|value"] = $modif["price"];
            //     $to_post_meta["_offer_modification|mod_old_price|".$indexMod."|0|value"] = $modif["price_old"];
            //     $to_post_meta["_offer_modification|mod_picture_id|".$indexMod."|0|value"] = "";
            //     $indexMod++;
            // }


             $postCat = array();
            
            // ----- Категории люстр

            if (($tovarInfo["cat"] === "Мебель")&&($tovarInfo["subcat"] === "Диваны")) $postCat = array(113,114);
            if (($tovarInfo["cat"] === "Мебель")&&($tovarInfo["subcat"] === "Кресла")) $postCat = array(113,115);
            if (($tovarInfo["cat"] === "Мебель")&&($tovarInfo["subcat"] === "Стулья")) $postCat = array(113,116);
            if (($tovarInfo["cat"] === "Мебель")&&($tovarInfo["subcat"] === "Столы")) $postCat = array(113,117);
            if (($tovarInfo["cat"] === "Мебель")&&($tovarInfo["subcat"] === "Комоды")) $postCat = array(113,118);
            if (($tovarInfo["cat"] === "Мебель")&&($tovarInfo["subcat"] === "Консоли")) $postCat = array(113,119);
            if (($tovarInfo["cat"] === "Мебель")&&($tovarInfo["subcat"] === "Шкафы и буфеты")) $postCat = array(113,120);
            if (($tovarInfo["cat"] === "Мебель")&&($tovarInfo["subcat"] === "Сундуки")) $postCat = array(113,121);
            if (($tovarInfo["cat"] === "Мебель")&&($tovarInfo["subcat"] === "Приставные столики и табуреты")) $postCat = array(113,122);
            if (($tovarInfo["cat"] === "Мебель")&&($tovarInfo["subcat"] === "TV-тумбы")) $postCat = array(113,123);
            if (($tovarInfo["cat"] === "Мебель")&&($tovarInfo["subcat"] === "Витрины")) $postCat = array(113,124);
            if (($tovarInfo["cat"] === "Мебель")&&($tovarInfo["subcat"] === "Кровати")) $postCat = array(113,125);
            if (($tovarInfo["cat"] === "Мебель")&&($tovarInfo["subcat"] === "Оттоманки, банкетки, пуфы")) $postCat = array(113,126);
            if (($tovarInfo["cat"] === "Мебель")&&($tovarInfo["subcat"] === "Стеллажи")) $postCat = array(113,127);
            if (($tovarInfo["cat"] === "Мебель")&&($tovarInfo["subcat"] === "Тумбы")) $postCat = array(113,128);

           
            $post_id = wp_insert_post(  wp_slash( array(
                'post_type'     => 'light',
                'post_author'    => 1,
                'post_status'    => 'publish',
                'post_title' => $tovarInfo["name"],
                'post_excerpt'  => $tovarInfo["description"],
                'post_content'  => $tovarInfo["description"],
                'meta_input'     => $to_post_meta,
                'tax_input' => array( 'lightcat' => $postCat )
            ) ) );

             wp_set_object_terms( $post_id, $postCat, "lightcat" );

            $indexImg = 0;
            foreach ($tovarInfo["images"] as $img) {
                $img1 = $img["lnk"];
                $ttl = $tovarInfo["name"]." - фото ".(string)($indexImg+1);
                $img_id = media_sideload_image( $img1, $post_id, $ttl, "id" );
                
                add_post_meta( $post_id, '_offer_picture|gal_img|'.$indexImg.'|0|value', $img_id, true );
                add_post_meta( $post_id, '_offer_picture|gal_img_sku|'.$indexImg.'|0|value', "", true );
                add_post_meta( $post_id, '_offer_picture|gal_img_alt|'.$indexImg.'|0|value', $ttl, true );
                
                if ($indexImg == 0) set_post_thumbnail($post_id, $img_id);
                
                $indexImg++;
            }   

            $wpdb->update( "lshop_parsed_tovars", array("post_id" => $post_id), array("lnk" => $tt->lnk), array('%d'), array('%s') );

            echo "Пост: ".$post_id."\n\r";
            
            print_r( $indexAdd);
            //print_r( $tovarInfo);
            echo "\n\r";

           // if ($indexAdd == 10) break;
            $indexAdd++;
    }


?>