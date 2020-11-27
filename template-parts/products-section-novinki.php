<section class="products">
    <div class="container">
      <h2 class="section-title">Новинки</h2>
      <div class="products-wrapper">
        
        <?
           $args = array(
            'posts_per_page' => 8,
            'post_type' => 'light',
            'tax_query' => array(
              array(
                'taxonomy' => 'lightcat',
                'field' => 'id',
                'terms' => array(10)
              )
            )
          );
          $query = new WP_Query($args);
          
          foreach( $query->posts as $post ){
            $query->the_post();
            get_template_part('template-parts/product-elem');
          }  
          wp_reset_postdata();
        ?>
      </div>
      <div class="btn-wrapper">
        <a href="<?echo get_category_link(94); ?>" class="all-link">Смотреть все новинки</a>
      </div>
    </div>
  </section>