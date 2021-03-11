<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>

<table>
		<thead>
			<tr>
				<th>Тип</th>
				<th>Наименование</th>
				<th>Артикул</th>
				<th>Старая цена</th>
				<th>Цена</th>
			</tr>
		</thead>
<tbody>

<?
    require_once("../../../../wp-config.php");
        
    // параметры по умолчанию
    $posts = get_posts( array(
        'numberposts' => -1,
        'post_type' => "light",
        'offset' => 0
    ) );

    
    foreach( $posts as $post ){
        $mass = array(
            "main",
            $post->post_title,
            carbon_get_post_meta($post->ID,"offer_sku"),
            carbon_get_post_meta($post->ID,"offer_offer_old_priceprice"),
            carbon_get_post_meta($post->ID,"offer_price")
        );

        echo "<tr>";
            echo "<td>main</td>";
            echo "<td>".$post->post_title."</td>";
            echo "<td>".carbon_get_post_meta($post->ID,"offer_sku")."</td>";
            echo "<td>".carbon_get_post_meta($post->ID,"offer_offer_old_priceprice")."</td>";
            echo "<td>".carbon_get_post_meta($post->ID,"offer_price")."</td>";
        echo "</tr>";
        


        
        $modif = carbon_get_the_post_meta('offer_modification');
        if($modif) {
            $i = 0;
            foreach($modif as $item) {
                
                echo "<tr>";
                    echo "<td>sub</td>";
                    echo "<td>".$item["mod_name"]."</td>";
                    echo "<td>".$item["mod_sku"]."</td>";
                    echo "<td>".$item["mod_old_price"]."</td>";
                    echo "<td>".$item["mod_price"]."</td>";
                echo "</tr>";

               
                $i++;
            }
        }
        
        
     }


?>
</tbody>
</table>
