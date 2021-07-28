<?php get_header();?>

    <?php if(have_posts()):?>
       
        
        <div class="row justify-content-evenly ms-0 ms-lg-2 mt-5 mb-4 mb-lg-2">

            <div class="col-lg-3 p-0 text-center text-lg-start">
                <h1 class=""><?php echo pll_e('Resultados') ?></h1>
            </div>

            <div class="col-lg-3 p-0 text-center text-lg-end">
                <?php get_search_form(); ?>
            </div>

        </div>

    <div class="row justify-content-center" id="search-page">

       <?php while( have_posts() ): the_post(); 
       $portada = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ) , 'full' );
       $categories = get_the_category(get_the_ID());?>

       

        

            <div class="col-12 col-md-10 col-lg-8">


                <div class="row mb-3">

                    <div class="col-lg-4">
                        <a href="<?php echo get_the_permalink(); ?>">
                            <img style="border-radius:10px;" class="img-fluid" src="<?php echo $portada[0] ?>" alt="">
                        </a>
                    </div>

                    <div class="col-lg-8">

                        <div class="d-flex mt-2">
                            <?php $i=0;
                            foreach($categories as $category): ?>
                                <span class="category px-2"><?php echo $category->name ; ?></span>
                            <?php $i++; if ($i == 1) break;
                            endforeach; ?>
                            <span class="ms-2 fw-light"><?php echo get_the_date(); ?></span>
                        </div>
                        <a href="<?php echo get_the_permalink(); ?>">
                            <h2 class="fs-2 mt-1"><?php the_title(); ?></h2>
                            <p class="secondary-text"><?php echo get_the_excerpt(); ?></p>
                        </a>
                    </div>
                    <hr class="mt-2">
                </div>


            </div>

        
                
               
       <?php endwhile; 
            the_posts_pagination(); ?>

    </div>
    
    <?php else:?>
        <div class="container mb-5 text-center" style="height:50vh;">
            <h1 class="my-5"><?php echo pll_e('No hay resultados');?></h1>
            <a class="btn btn-azul w-25" href="<?php echo get_home_url(); ?>"><?php echo pll_e('Volver'); ?></a>
        </div>
        
    <?php endif; ?>


<?php get_footer(); ?>