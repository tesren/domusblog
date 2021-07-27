<?php 
    get_header();
  
?>

<div class="container mb-5" id="front-page">

<div class="row justify-content-between ms-0 ms-lg-2 mt-5 mb-4 mb-lg-2">

    <div class="col-lg p-0 text-center text-lg-start">
      <h1 class=""><?php echo pll_e('Entradas Recientes') ?></h1>
    </div>

    <div class="col-lg-3 p-0 text-center text-lg-end">
        <?php get_search_form(); ?>
    </div>
    
</div>
    
    <?php if( have_posts() ): 
      $j=1; ?>
      
      <div class="row">
          <?php while( have_posts()):  the_post();
          $portada = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ) , 'full' );
          $categories = get_the_category(get_the_ID());?>

                  <div class="recent-posts mb-4 col-12 col-md-<?php if($j>2){echo '4';}else{echo'6';}?>" style="position:relative;">
                    <a href="<?php echo get_the_permalink(); ?>">
                      <img class="w-100" src="<?php echo $portada[0] ?>" alt="<?php echo the_title() ?>">
                      <div class="fondo-oscuro"></div>
                      <h2 class="fs-2"><?php echo the_title();?></h2>

                      <div class="d-flex">
                          <?php $i=0;
                          foreach($categories as $category): ?>
                              <span class="category px-2"><?php echo $category->name ; ?></span>
                          <?php $i++; if ($i == 1) break;
                          endforeach; ?>
                          <span class="ms-2 date"><?php echo get_the_date(); ?></span>
                      </div>
                    </a>
                  </div>

                
          <?php   $j++;
            if($j==8) break;
            endwhile; 
            the_posts_pagination();
            ?>
      </div><!--row-->
    <?php endif; ?>
     

</div>

    
<?php get_footer(); ?>