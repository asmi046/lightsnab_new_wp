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