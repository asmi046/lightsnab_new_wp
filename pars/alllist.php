<?
    //http://shop.light-snab.ru/wp-content/themes/light-shop/pars/alllist.php
    
    require_once("../../../../wp-config.php");
    include_once("simple_html_dom.php");

    include_once("pages.php");

    global $wpdb;

    $rez  = $wpdb->query("TRUNCATE `lshop_parsed_tovars`");

    for ($i = 0; $i<count($parsePages); $i++)
    {
        $html = file_get_html($parsePages[$i]);

        foreach($html->find('.products-item') as $element)
        {
            $tov = array();    
    

            $tov["name"] = $element->find('.products-name')[0]->plaintext;
            $tov["price"] = str_replace(array(" ","руб."), "", $element->find('.price')[0]->plaintext);
            $tov["lnk"] = "https://efimlight.ru".$element->find('a')[0]->href;
            $tov["main_img"] = "https://efimlight.ru".$element->find('img')[0]->attr["data-src"];
            $tov["parsed_page"] = $parsePages[$i];
            
            
            $rez  = $wpdb->insert( "lshop_parsed_tovars", $tov, array("%s", "%d", "%s", "%s", "%s") );
            
            print_r( $tov);
            echo "\n\r";
            
        }
        
    }
?>