<?
        require_once("../../../../wp-config.php");
        include_once("simple_html_dom.php");


        $html = file_get_html("https://efimlight.ru/product/accord/");

        $tovarInfo = array();
        
        $tovarInfo["name"] = $html->find('h1')[0]->plaintext;
        $tovarInfo["sku"] = str_replace(array(" ","Артикул:"), "", $html->find('.product-summary')[0]->plaintext);
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

        print_r( $tovarInfo);
        echo "\n\r";


?>