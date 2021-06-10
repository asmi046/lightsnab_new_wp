<?
    //php www/lightsnab.ru/wp-content/themes/light-shop/pars/alllist-mebel.php
    ini_set('max_execution_time', 9000);

    require_once("../../../../wp-config.php");
    include_once("simple_html_dom.php");

    include_once("pages-mebel2.php");

    global $wpdb;

    $rez  = $wpdb->query("TRUNCATE `lshop_parsed_tovars`");
    
    $termSiteParent = get_term_by('name', "Мебель", 'lightcat');
    if (empty($termSiteParent)) 
    {
        wp_insert_term( "Мебель", 'lightcat');
    } 
    else {
        wp_update_term( $termSiteParent->term_id, 'lightcat');
    }

    
    
  
    for ($j = 0; $j<count($parsePages); $j++)
    {
        for ($i = 0; $i<count($parsePages[$j]["pages"]); $i++)
        {
            $context = stream_context_create(
                array(
                    "http" => array(
                        "header" => "User-Agent: Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.102 Safari/537.36"
                    )
                )
            );
            
          //  $fstr = file_get_contents($parsePages[$j]["pages"][$i], false, $context);

            $html = file_get_html($parsePages[$j]["pages"][$i], false, $context);

            foreach($html->find('.product') as $element)
            {
                $tov = array();    
        

                $tov["name"] = $element->find('.title')[0]->plaintext;
                
                if (empty($tov["name"])) continue;

                $tov["cat"] = $parsePages[$j]["cat"];
                $rub_price = trim(str_replace(array(" ","USD","руб.","₽","$",",",",00",".00"), "", $element->find('.price .money')[0]->plaintext));
                $rub_price = (float)$rub_price*72;

                $tov["price"] = $rub_price;
                $tov["lnk"] = "https://louvrehome.ru".$element->find('a')[0]->href;
                $tov["main_img"] = $element->find('img')[0]->src;
                $tov["parsed_page"] = $parsePages[$j]["pages"][$i];
                
                
                $rez  = $wpdb->insert( "lshop_parsed_tovars", $tov, array("%s", "%s", "%d", "%s", "%s", "%s") );
                
                print_r( $tov);
                echo "\n\r";
                
            }
            
         
        }

        $termSite = get_term_by('name', $parsePages[$j]["cat"], 'lightcat');
        if (empty($termSite)) 
        {
            wp_insert_term( $parsePages[$j]["cat"], 'lightcat');
        } 
        else {
            wp_update_term( $termSite->term_id, 'lightcat', array("parent" => $termSiteParent->term_id));
        }
        
    }
?>