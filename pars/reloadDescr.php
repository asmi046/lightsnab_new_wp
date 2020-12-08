<?
        require_once("../../../../wp-config.php");
        
        require_once ABSPATH . 'wp-admin/includes/media.php';
        require_once ABSPATH . 'wp-admin/includes/file.php';
        require_once ABSPATH . 'wp-admin/includes/image.php';

        include_once("simple_html_dom.php");

        global $wpdb;
        
         $tovArr = $wpdb->get_results("SELECT * FROM `lshop_parsed_tovars` WHERE `post_descr` = '' ORDER BY rand() LIMIT 5");
        //$tovArr = $wpdb->get_results("SELECT * FROM `lshop_parsed_tovars` WHERE `post_descr` = ''  AND `name` = 'Люстра Rope filament 8109–D12' ORDER BY rand() LIMIT 5");
        
        
         foreach ($tovArr  as $tt)
         {
            echo "Обробатываем: ".$tt->lnk. "\n\r";
            
            if (get_headers($tt->lnk, 1)[0] === "HTTP/1.1 404 Not Found") {
                continue;
            }

             $html = file_get_html($tt->lnk);
            
            $tovarInfo = array();
            
            $tovarInfo["cat"] = trim($html->find('.breadcrumb li')[count($html->find('.breadcrumb li'))-3]->plaintext);
            $tovarInfo["subcat"] = trim($html->find('.breadcrumb li')[count($html->find('.breadcrumb li'))-2]->plaintext);
            
            $tovarInfo["name"] = $html->find('h1')[0]->plaintext;
            $tovarInfo["sku"] = str_replace(array(" ","Артикул:"), "", $html->find('.product-summary')[0]->plaintext);
            $tovarInfo["price"] = $html->find('.product-prices')[0]->children(0)->attr["data-price"];

            if (!empty($html->find('#product-description')[0])) 
            {
                $textDescr = substr(
                        $html->find('#product-description')[0]->outertext, 
                        0, 
                        strripos($html->find('#product-description')[0]->outertext, "<table>") );
                $tovarInfo["description"] = trim(strip_tags($textDescr));
                if (empty($tovarInfo["description"])) $tovarInfo["description"] = "Товар: ".$tovarInfo["name"];
            }
             
            
            $tovarInfo["caracter"] = array();
            $table = $html->find('#product-description table')[0];

            if (!empty($table))
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

            update_post_meta( $tt->post_id, '_offer_smile_descr', $tovarInfo["description"] );

            //if (!file_exists("tovars")) mkdir("tovars");
            //if (!file_exists("tovars/".$tovarInfo["name"])) mkdir("tovars/".$tovarInfo["name"]);

            // $pindex = 0;
            // foreach($tovarInfo["images"] as $pict) {
            //     $filename = $tovarInfo["name"]."-".$tovarInfo["sku"]."-".$pindex.".".pathinfo($pict["lnk"], PATHINFO_EXTENSION);
            //     $dirname = "tovars/".$tovarInfo["name"];
            //     copy($pict["lnk"],   $dirname."/".$filename);
                
            //     $tovarInfo["images"][$pindex]["lnk"] = "/pars/".$dirname."/".$filename;   
            //     $pindex++;
            // }
            // file_put_contents($dirname."/content-".$tovarInfo["name"].".json", json_encode($tovarInfo));

            
            $indexImg = 0;
            foreach ($tovarInfo["images"] as $img) {
                $ttl = $tovarInfo["name"]." -  фото ".(string)($indexImg+1);
               
                
                update_post_meta( $tt->post_id, '_offer_picture|gal_img_alt|'.$indexImg.'|0|value', $ttl );
                
                
                $indexImg++;
            }   

            $wpdb->update( "lshop_parsed_tovars", array("post_descr" => $tovarInfo["description"]), array("lnk" => $tt->lnk), array('%s'), array('%s') );

            // echo "Пост: ".$post_id."\n\r";
            
            // print_r( $tovarInfo);
             print_r( $tovarInfo["name"]);
             echo "\n\r";
             print_r( $tovarInfo["description"]);
             echo "\n\r";
     }


?>