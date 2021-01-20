<?
        require_once("../../../../wp-config.php");
        
        require_once ABSPATH . 'wp-admin/includes/media.php';
        require_once ABSPATH . 'wp-admin/includes/file.php';
        require_once ABSPATH . 'wp-admin/includes/image.php';

        include_once("simple_html_dom.php");

        echo "Парсинг страницы: ".$_REQUEST["lnk"];
        
        $html = file_get_html($_REQUEST["lnk"]);

        $tovarInfo = array();

        $tovarInfo["name"] = $html->find('h1')[0]->plaintext;
        $tovarInfo["sku"] = str_replace(array(" ","Артикул:"), "", $html->find('.parsSku')[0]->plaintext);
        $tovarInfo["price"] = str_replace(array(" "), "", $html->find('.parsPrice')[0]->plaintext);
        $tovarInfo["description"] = $html->find('.single-product__descr1')[0]->innertext;
        
        $tovarInfo["siries"] = str_replace(array(" "), "", $html->find('.parsSiries')[0]->plaintext);

        $tovarInfo["images"] = array();

        foreach($html->find('.single-slider__item') as $cr) {
            $img["lnk"] = str_replace(array(" ", "background-image:", ")", "(", ";", "url"), "", $cr->style);
        
            $tovarInfo["images"][] =  $img;
        }


        $to_post_meta  = [ 
            '_offer_type' => "Цокольный (Со сменными лампами)", 
            '_offer_sku' => $tovarInfo["sku"], 
            '_offer_nal' => 'В наличии', 
            '_offer_price' => $tovarInfo["price"],
            '_offer_siries' => $tovarInfo["siries"],
            '_offer_name' => $tovarInfo["siries"]
        ];

        $post_id = wp_insert_post(  wp_slash( array(
            'post_type'     => 'light',
            'post_author'    => 1,
            'post_status'    => 'draft',
            'post_title' => $tovarInfo["name"],
            'post_excerpt'  => $tovarInfo["description"],
            'post_content'  => $tovarInfo["description"],
            'meta_input'     => $to_post_meta,
        ) ) );

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

        echo "<pre>";
        print_r( $tovarInfo);
        echo "</pre>";
?>