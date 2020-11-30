<?
        require_once("../../../../wp-config.php");
        
        require_once ABSPATH . 'wp-admin/includes/media.php';
        require_once ABSPATH . 'wp-admin/includes/file.php';
        require_once ABSPATH . 'wp-admin/includes/image.php';

        include_once("simple_html_dom.php");

        global $wpdb;
        
        $tovArr = $wpdb->get_results("SELECT * FROM `lshop_parsed_tovars` WHERE `post_id` = 0 ORDER BY rand() LIMIT 5");
        
        
       foreach ($tovArr  as $tt)
       {
            echo "Обробатываем: ".$tt->lnk. "\n\r";
            
            $html = file_get_html($tt->lnk);

            $tovarInfo = array();
            
            $tovarInfo["cat"] = trim($html->find('.breadcrumb li')[count($html->find('.breadcrumb li'))-3]->plaintext);
            $tovarInfo["subcat"] = trim($html->find('.breadcrumb li')[count($html->find('.breadcrumb li'))-2]->plaintext);
            
            $tovarInfo["name"] = $html->find('h1')[0]->plaintext;
            $tovarInfo["sku"] = str_replace(array(" ","Артикул:"), "", $html->find('.product-summary')[0]->plaintext);
            $tovarInfo["price"] = $html->find('.product-prices')[0]->children(0)->attr["data-price"];
            $tovarInfo["description"] = $html->find('#product-description')[0]->children(0)->children(0)->plaintext;;
            
            
            $tovarInfo["caracter"] = array();
            $table = $html->find('#product-description table')[0];

            foreach($table->find('tr') as $cr) {
                $crLine = $cr->find("td");
                $toc["name"] = trim($crLine[0]->plaintext);
                $toc["value"] = trim($crLine[1]->plaintext);
                $tovarInfo["caracter"][] =  $toc;
            }

            $tovarInfo["modification"] = array();

            foreach($html->find('.skus li') as $cr) {
            
                $opt["name"] = trim($cr->children(1)->children(0)->plaintext);
                $opt["sku"] = $cr->children(0)->value;
                $opt["price"] = $cr->children(0)->attr["data-price"];
                $opt["price_old"] = $cr->children(0)->attr["data-compare-price"];
                $tovarInfo["modification"][] =  $opt;
            }

            $tovarInfo["images"] = array();

            foreach($html->find('.main-gallery img') as $cr) {
                $img["lnk"] = "https://efimlight.ru".$cr->src;
            
                $tovarInfo["images"][] =  $img;
            }

            if (!file_exists("tovars")) mkdir("tovars");
            if (!file_exists("tovars/".$tovarInfo["name"])) mkdir("tovars/".$tovarInfo["name"]);

            $pindex = 0;
            foreach($tovarInfo["images"] as $pict) {
                $filename = $tovarInfo["name"]."-".$tovarInfo["sku"]."-".$pindex.".".pathinfo($pict["lnk"], PATHINFO_EXTENSION);
                $dirname = "tovars/".$tovarInfo["name"];
                copy($pict["lnk"],   $dirname."/".$filename);
                
                $tovarInfo["images"][$pindex]["lnk"] = "/pars/".$dirname."/".$filename;   
                $pindex++;
            }
            file_put_contents($dirname."/content-".$tovarInfo["name"].".json", json_encode($tovarInfo));

            // --------------- Делаем пост --------------------
            $to_post_meta  = [ 
                '_offer_smile_descr' => $tovarInfo["description"], 
                '_offer_type' => "Цокольный (Со сменными лампами)", 
                '_offer_sku' => $tovarInfo["sku"], 
                '_offer_nal' => 'В наличии', 
                '_offer_price' => $tovarInfo["price"]
            ];

            $indexCh = 0;
            foreach ($tovarInfo["caracter"] as $carrecter) {
                $to_post_meta["_offer_cherecter|c_name|".$indexCh."|0|value"] = $carrecter["name"];
                $to_post_meta["_offer_cherecter|c_val|".$indexCh."|0|value"] = $carrecter["value"];
                $indexCh++;
            }


            $indexMod = 0;
            foreach ($tovarInfo["modification"] as $modif) {
                $to_post_meta["_offer_modification|mod_name|".$indexMod."|0|value"] = $modif["name"];
                $to_post_meta["_offer_modification|mod_sku|".$indexMod."|0|value"] = $modif["sku"];
                $to_post_meta["_offer_modification|mod_price|".$indexMod."|0|value"] = $modif["price"];
                $to_post_meta["_offer_modification|mod_old_price|".$indexMod."|0|value"] = $modif["price_old"];
                $to_post_meta["_offer_modification|mod_picture_id|".$indexMod."|0|value"] = "";
                $indexMod++;
            }


            $postCat = array();
            
            // ----- Категории люстр

            if (($tovarInfo["cat"] === "Люстры")&&($tovarInfo["subcat"] === "Скандинавские")) $postCat = array(11,53);
            if (($tovarInfo["cat"] === "Люстры")&&($tovarInfo["subcat"] === "Дизайнерские")) $postCat = array(11,54);
            if (($tovarInfo["cat"] === "Люстры")&&($tovarInfo["subcat"] === "Лофт")) $postCat = array(11,55);
            if (($tovarInfo["cat"] === "Люстры")&&($tovarInfo["subcat"] === "Паук")) $postCat = array(11,56);
            if (($tovarInfo["cat"] === "Люстры")&&($tovarInfo["subcat"] === "Реечные")) $postCat = array(11,57);
            if (($tovarInfo["cat"] === "Люстры")&&($tovarInfo["subcat"] === "Классика")) $postCat = array(11,58);
            if (($tovarInfo["cat"] === "Люстры")&&($tovarInfo["subcat"] === "Детские")) $postCat = array(11,59);
            if (($tovarInfo["cat"] === "Люстры")&&($tovarInfo["subcat"] === "Светодиодные")) $postCat = array(11,60);
            if (($tovarInfo["cat"] === "Люстры")&&($tovarInfo["subcat"] === "Большие люстры")) $postCat = array(11,61);
            if (($tovarInfo["cat"] === "Люстры")&&($tovarInfo["subcat"] === "Хрустальные")) $postCat = array(11,62);
            if (($tovarInfo["cat"] === "Люстры")&&($tovarInfo["subcat"] === "Деревянные")) $postCat = array(11,63);
            if (($tovarInfo["cat"] === "Люстры")&&($tovarInfo["subcat"] === "С птичками")) $postCat = array(11,64);

            // ----- Категории подвесных светильников

            if (($tovarInfo["cat"] === "Подвесные светильники")&&($tovarInfo["subcat"] === "Скандинавские")) $postCat = array(12,89);
            if (($tovarInfo["cat"] === "Подвесные светильники")&&($tovarInfo["subcat"] === "Дизайнерские")) $postCat = array(12,90);
            if (($tovarInfo["cat"] === "Подвесные светильники")&&($tovarInfo["subcat"] === "Лофт")) $postCat = array(12,91);
            if (($tovarInfo["cat"] === "Подвесные светильники")&&($tovarInfo["subcat"] === "Детские")) $postCat = array(12,92);
            if (($tovarInfo["cat"] === "Подвесные светильники")&&($tovarInfo["subcat"] === "Офисные")) $postCat = array(12,93);


            // ----- Категории Потолочных светильников

            if (($tovarInfo["cat"] === "Потолочные светильники")&&($tovarInfo["subcat"] === "Скандинавские")) $postCat = array(14,65);
            if (($tovarInfo["cat"] === "Потолочные светильники")&&($tovarInfo["subcat"] === "Дизайнерские")) $postCat = array(14,66);
            if (($tovarInfo["cat"] === "Потолочные светильники")&&($tovarInfo["subcat"] === "Лофт")) $postCat = array(14,67);
            if (($tovarInfo["cat"] === "Потолочные светильники")&&($tovarInfo["subcat"] === "Классика")) $postCat = array(14,68);
            if (($tovarInfo["cat"] === "Потолочные светильники")&&($tovarInfo["subcat"] === "Детские")) $postCat = array(14,69);
            if (($tovarInfo["cat"] === "Потолочные светильники")&&($tovarInfo["subcat"] === "Офисные")) $postCat = array(14,70);

            // ----- Категории Торшеров

            if (($tovarInfo["cat"] === "Торшеры")&&($tovarInfo["subcat"] === "Скандинавские")) $postCat = array(17,71);
            if (($tovarInfo["cat"] === "Торшеры")&&($tovarInfo["subcat"] === "Дизайнерские")) $postCat = array(17,72);
            if (($tovarInfo["cat"] === "Торшеры")&&($tovarInfo["subcat"] === "Лофт")) $postCat = array(17,73);
            if (($tovarInfo["cat"] === "Торшеры")&&($tovarInfo["subcat"] === "С абажуром")) $postCat = array(17,74);
            if (($tovarInfo["cat"] === "Торшеры")&&($tovarInfo["subcat"] === "Изогнутые")) $postCat = array(17,75);

            // ----- Категории Бра

            if (($tovarInfo["cat"] === "Бра")&&($tovarInfo["subcat"] === "Скандинавские")) $postCat = array(16,83);
            if (($tovarInfo["cat"] === "Бра")&&($tovarInfo["subcat"] === "Дизайнерские")) $postCat = array(16,82);
            if (($tovarInfo["cat"] === "Бра")&&($tovarInfo["subcat"] === "Лофт")) $postCat = array(16,84);
            if (($tovarInfo["cat"] === "Бра")&&($tovarInfo["subcat"] === "Бра с абажуром")) $postCat = array(16,86);
            if (($tovarInfo["cat"] === "Бра")&&($tovarInfo["subcat"] === "Классика")) $postCat = array(16,87);
            if (($tovarInfo["cat"] === "Бра")&&($tovarInfo["subcat"] === "Детские")) $postCat = array(16,85);
            if (($tovarInfo["cat"] === "Бра")&&($tovarInfo["subcat"] === "Светодиодные")) $postCat = array(16,88);

            // ----- Категории Настольных ламп

            if (($tovarInfo["cat"] === "Настольные лампы")&&($tovarInfo["subcat"] === "Дизайнерские")) $postCat = array(18,77);
            if (($tovarInfo["cat"] === "Настольные лампы")&&($tovarInfo["subcat"] === "Скандинавские")) $postCat = array(18,76);
            if (($tovarInfo["cat"] === "Настольные лампы")&&($tovarInfo["subcat"] === "Лофт")) $postCat = array(18,78);
            if (($tovarInfo["cat"] === "Настольные лампы")&&($tovarInfo["subcat"] === "Детские")) $postCat = array(18,79);
            if (($tovarInfo["cat"] === "Настольные лампы")&&($tovarInfo["subcat"] === "С абажуром")) $postCat = array(18,80);
            if (($tovarInfo["cat"] === "Настольные лампы")&&($tovarInfo["subcat"] === "Для рабочего стола")) $postCat = array(18,81);


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
                $img1 = get_bloginfo("template_url").$img["lnk"];
                $ttl = $tovarInfo["name"]." - ".$tovarInfo["description"]." фото ".(string)($indexImg+1);
                $img_id = media_sideload_image( $img1, $post_id, $ttl, "id" );
                
                add_post_meta( $post_id, '_offer_picture|gal_img|'.$indexImg.'|0|value', $img_id, true );
                add_post_meta( $post_id, '_offer_picture|gal_img_sku|'.$indexImg.'|0|value', "", true );
                add_post_meta( $post_id, '_offer_picture|gal_img_alt|'.$indexImg.'|0|value', $ttl, true );
                
                if ($indexImg == 0) set_post_thumbnail($post_id, $img_id);
                
                $indexImg++;
            }   

            $wpdb->update( "lshop_parsed_tovars", array("post_id" => $post_id), array("lnk" => $tt->lnk), array('%d'), array('%s') );

            echo "Пост: ".$post_id."\n\r";
            
            print_r( $tovarInfo);
            echo "\n\r";
    }


?>