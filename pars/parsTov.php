<?
        require_once("../../../../wp-config.php");
        include_once("simple_html_dom.php");


        $html = file_get_html("https://efimlight.ru/product/accord/");

        $tovarInfo = array();
        
        $tovarInfo["name"] = $html->find('h1')[0]->plaintext;
        $tovarInfo["sku"] = str_replace(array(" ","Артикул:"), "", $html->find('.product-summary')[0]->plaintext);
        $tovarInfo["price"] = $html->find('.price')[0]->attr["data-real-price"];
        $descr = $html->find('.product-description')[0]->innertext;
        $tovarInfo["description"] = substr( $descr, 0, strpos( $descr, "<table>"));
        $tovarInfo["caracter"] = array();

        
        $table = $html->find('.product-description table')[0];

        foreach($table->find('tr') as $cr) {
            $crLine = $cr->find("td");
            $toc["name"] = $crLine[0]->plaintext;
            $toc["value"] = $crLine[1]->plaintext;
            $tovarInfo["caracter"][] =  $toc;
        }

        $tovarInfo["modification"] = array();

        foreach($html->find('.select-skus option') as $cr) {
            $opt["name"] = $cr->plaintext;
            $opt["sku"] = $cr->value;
            $opt["price"] = $cr->attr["data-price"];
            $opt["price_old"] = $cr->attr["data-compare-price"];
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

        $post_id = wp_insert_post(  wp_slash( array(
            'post_type'     => 'light',
            'post_status'    => 'publish',
            'post_title' => $tovarInfo["name"],
            'post_excerpt'  => $tovarInfo["description"],
            'post_content'  => $tovarInfo["description"],
            'meta_input'     => $to_post_meta
        ) ) );

        echo "Пост: ".$post_id."\n\r";
        print_r( $tovarInfo);
        echo "\n\r";


?>