<?
    require_once("../../../../wp-config.php");
        
    // параметры по умолчанию
    $posts = get_posts( array(
        'numberposts' => 1000,
        'post_type' => "light",
        'offset' => 4000
    ) );

    foreach( $posts as $post ){
        // echo $post->post_title."\n\r";
        $descr = get_post_meta( $post->ID, '_offer_smile_descr', true);
        
        if(($descr[0] == " ")&&($descr[1] == " ")&&($descr[2] == " ")&&($descr[3] == " ")&&($descr[4] == " ")) {
            update_post_meta( $post->ID, '_offer_smile_descr', "Товар: ".$post->post_title );
            echo $post->post_title."\n\r";
        } 
    }


?>