<?
    header('Content-Type: text/xml');
    echo '<?xml version="1.0" encoding="UTF-8"?>';
    echo '<yml_catalog date="'.date("Y-m-d\TH:i:sP").'">';
?>

    <shop>
        <name>LightSnab</name>
        <company>ООО "Лайт-Снаб".</company>
        <url>https://lightsnab.ru/</url>
        <currencies>
            <currency id="RUR" rate="1"/>
        </currencies>
        <categories>

            <?
                $categories = get_categories( [
                    'taxonomy'     => 'lightbrand',
                    'orderby'      => 'name',
	                'parent'  => 0
                    
                ] );

                foreach( $categories as $cat ){
            ?>
                  <category id="<?echo $cat->term_id?>"><?echo $cat->name?></category>  
            <?
                    $sub_categories = get_categories( [
                        'taxonomy'     => 'lightbrand',
                        'orderby'      => 'name',
                        'parent'  => $cat->term_id   
                    ] );

                    foreach( $sub_categories as $sub_cat ){
                ?>
                    <category id="<?echo $sub_cat->term_id?>" parentId="<?echo $cat->term_id?>"><?echo $sub_cat->name?></category>
                <?
                   }
                }
            ?>
        </categories>
        <offers>

            <?
                $param = array(
                    'numberposts' => -1,
                    'post_type'   => 'light',
                );

                if (!empty($_REQUEST["cat"])) {
            
                    $tax = array(
                        'tax_query' => array(
                            array(
                                'taxonomy' => 'lightbrand',
                                'field'    => 'slug',
                                'terms'    => $_REQUEST["cat"]
                            )
                        )
                    );

                    $param = array_merge($param, $tax);
                    // var_dump($param);
                }

                $my_posts = get_posts( $param );
                
                foreach( $my_posts as $post ){
                    setup_postdata( $post );

                    $modif = carbon_get_the_post_meta('offer_modification');
                    
                    global $wpdb;
                    $mainPrice = $wpdb->get_results("SELECT * FROM `lshop_loadprice` WHERE `sku` = '".carbon_get_post_meta(get_the_ID(),"offer_sku")."'");
                    $mainPrice = $mainPrice[0]->price;

                    $sku = carbon_get_post_meta(get_the_ID(),"offer_sku");
                    if (empty($sku)) continue;
                    if (empty($mainPrice)) continue;
            ?>

            <offer id="<?echo $sku; ?>">
                <name><? the_title();?></name>
                <url><? the_permalink();?></url>
                <picture><?php  $imgTm = get_the_post_thumbnail_url( get_the_ID(), "tominiatyre" ); echo empty($imgTm)?get_bloginfo("template_url")."/img/no-photo.jpg":$imgTm; ?></picture>
                <price><?echo $mainPrice; ?></price>
                <description><?php echo  str_replace(array("&nbsp;", "&"), "", strip_tags (empty(carbon_get_the_post_meta('offer_fulltext'))?get_the_title():carbon_get_the_post_meta('offer_fulltext')));?></description>
                <currencyId>RUR</currencyId>
                <categoryId><? $cc = get_the_terms(get_the_ID(), "lightbrand"); if (!empty($cc) ) echo $cc[0]->term_id;?></categoryId>
                <delivery>false</delivery>
                <vendor>LightSnab</vendor>
            </offer>

            <?
                }
            ?>
        </offers>
        <gifts>
            <!-- подарки не из прайс‑листа -->
        </gifts>
        <promos>
            <!-- промоакции -->
        </promos>
    </shop>
</yml_catalog>