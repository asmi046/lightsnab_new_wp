<section class="products">
  <div class="container">
    <div class="products-wrapper">
      <?php
        global $isbrand;

        while(have_posts()):
          the_post();
          
          if (isset($isbrand) && !empty($isbrand))
            get_template_part('template-parts/product-elem-brand');
          else
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

<section class = "cat_description">
    <div class="container">
      <?php echo category_description();?>
    </div>
</section>