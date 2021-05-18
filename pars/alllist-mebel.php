<?
    //php www/lightsnab.ru/wp-content/themes/light-shop/pars/alllist-mebel.php
    ini_set('max_execution_time', 9000);

    require_once("../../../../wp-config.php");
    include_once("simple_html_dom.php");

    include_once("pages-mebel.php");

    global $wpdb;

    $rez  = $wpdb->query("TRUNCATE `lshop_parsed_tovars`");
    for ($j = 0; $j<count($parsePages); $j++)
    {
        for ($i = 0; $i<count($parsePages[$j]["pages"]); $i++)
        {
            $html = file_get_html($parsePages[$j]["pages"][$i]);

            foreach($html->find('.itembg') as $element)
            {
                $tov = array();    
        

                $tov["name"] = $element->find('.item-name')[0]->plaintext;
                $tov["price"] = trim(str_replace(array(" ","руб."), "", $element->find('.price')[0]->plaintext));
                $tov["lnk"] = "https://loft-concept.ru".$element->find('a')[0]->href;
                $tov["main_img"] = "https://loft-concept.ru".$element->find('img')[0]->src;
                $tov["parsed_page"] = $parsePages[$j]["pages"][$i];
                
                
                $rez  = $wpdb->insert( "lshop_parsed_tovars", $tov, array("%s", "%d", "%s", "%s", "%s") );
                
                print_r( $tov);
                echo "\n\r";
                
            }
            
        }

    }
?>