<section class="products">
  <div class="container">
    <div class="products-wrapper">
      <?php
        while(have_posts()):
          the_post();
          get_template_part('template-parts/product-elem');
        endwhile;
      ?>
    </div>
  </div>
</section>

<section class = "pagination">
  <div class="container">
    <?php 
    the_posts_pagination( array(
      'mid_size' => 2,
      'prev_next'    => false,
      'screen_reader_text' => "11",
    ) ); 
    ?>
  </div>
</section>