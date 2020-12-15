<?
    require_once("../../../../wp-config.php");
        
    // параметры по умолчанию
    $posts = get_posts( array(
        'numberposts' => 1000,
        'post_type' => "light",
        'offset' => 4000
    ) );

    foreach( $posts as $post ){
        
        // if (!has_post_thumbnail( $post->ID )) {
        //     echo $post->post_title."\n\r";  
        //     $wpdb->update( "lshop_parsed_tovars", 
        //     array("post_id" => ""), 
        //     array("post_id" => $post->ID), array('%d'), array('%d') );
        // }

        // if ($post->ID != 27063) continue;

        $curPrice = carbon_get_post_meta($post->ID,"offer_price");
        $curPriceNew = round($curPrice * 0.9);
        update_post_meta( $post->ID, '_offer_price', $curPriceNew);    
        
        echo $curPrice . " - " . $curPriceNew."\n\r";
        
        $modif = carbon_get_the_post_meta('offer_modification');
        if($modif) {
            $i = 0;
            foreach($modif as $item) {
                

                $curPrice = $item["mod_price"];
                $curPriceNew = round($curPrice * 0.9);
                
                carbon_set_post_meta( $post->ID, 'offer_modification['.$i.']/mod_price', $curPriceNew );

                echo 'offer_modification['.$i.']/mod_price: ' . $curPrice . " - " . $curPriceNew."\n\r";

                $i++;
            }
        }
        echo "\n\r";
        
        // echo $post->post_title."\n\r";
    //     $descr = get_post_meta( $post->ID, '_offer_smile_descr', true);
        
    //     if(($descr[0] == " ")&&($descr[1] == " ")&&($descr[2] == " ")&&($descr[3] == " ")&&($descr[4] == " ")) {
    //         update_post_meta( $post->ID, '_offer_smile_descr', "Товар: ".$post->post_title );
    //         echo $post->post_title."\n\r";
    //     } 
     }


?>