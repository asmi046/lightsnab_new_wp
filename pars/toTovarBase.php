<?
    //php www/lightsnab.ru/wp-content/themes/light-shop/pars/toTovarBase.php
    require_once("../../../../wp-config.php");
    
    define("BI_SERVICE_DB_NAME", "u0743099_lscrm");
    define("BI_SERVICE_USER_NAME", "u0743099__lscrm");
    define("BI_SERVICE_USER_PASS", "2V4o5H6o");
    define("BI_SERVICE_DB_HOST", "localhost");

    // параметры по умолчанию
    $posts = get_posts( array(
        'numberposts' => 1000,
        'post_type' => "light",
        'offset' => 7000,

        // 'tax_query' => array(
        //     array(
        //         'taxonomy' => 'lightcat',
        //         'field'    => 'id',
        //         'terms'    => 113
        //     )
        // )
    ) );

    $counter = 0;

    $serviceBase = new wpdb(BI_SERVICE_USER_NAME, BI_SERVICE_USER_PASS, BI_SERVICE_DB_NAME, BI_SERVICE_DB_HOST);

    foreach( $posts as $post ){

        // if ($post->ID != 27063) continue;

        

        // $serviceBase->query("TRUNCATE `tovar_base`");

        $offerName = trim(carbon_get_post_meta($post->ID, "offer_name"));
        if (empty($offerName)) $offerName = $post->post_title;

        $offerSKU = trim(carbon_get_post_meta($post->ID, "offer_sku")); 
        $searchStr = trim(carbon_get_post_meta($post->ID, "offer_allsearch"));
        $lnk = trim(get_the_post_thumbnail_url($post->ID, "large"));

        echo '#'.$counter." -> ". $offerName . " -> " . $offerSKU  . "\n\r";

        $insertZacData = array(
            'sku' => $offerSKU, 
            'name' => $offerName, 
            'lnk' => $lnk, 
            'search_str' => $searchStr, 
        );
        $serviceBase->insert('tovar_base', $insertZacData);


        $counter ++; 
     }


?>