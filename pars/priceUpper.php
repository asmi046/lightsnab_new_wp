<?
    //php www/lightsnab.ru/wp-content/themes/light-shop/pars/priceUpper.php
    ini_set('memory_limit', '2048M'); 
    require_once("../../../../wp-config.php");
        
    // параметры по умолчанию
    $posts = get_posts( array(
        'numberposts' => -1,
        'post_type' => "light",
        'offset' => 0,

        'tax_query' => array(
            array(
                'taxonomy' => 'lightcat',
                'field'    => 'id',
                'terms'    => 142
            )
        )
    ) );

    $counter = 0;
    foreach( $posts as $post ){
        

        // if ($post->ID != 27063) continue;

        $curPrice = carbon_get_post_meta($post->ID,"offer_price");
        $curPriceNew = round($curPrice * 0.75);
        update_post_meta( $post->ID, '_offer_price', $curPriceNew);    
        
        echo $post->post_title . " -> " . $curPrice . " - " . $curPriceNew."\n\r";

        
        
        $modif = carbon_get_the_post_meta('offer_modification');
        if($modif) {
            $i = 0;
            foreach($modif as $item) {
                

                $curPrice = $item["mod_price"];
                $curPriceNew = round($curPrice * 0.75);
                
                carbon_set_post_meta( $post->ID, 'offer_modification['.$i.']/mod_price', $curPriceNew );

                echo 'offer_modification['.$i.']/mod_price: ' . $curPrice . " - " . $curPriceNew."\n\r";

                $i++;
            }
        }

        echo "\n\r";
        


        $counter ++; 
     }


?>