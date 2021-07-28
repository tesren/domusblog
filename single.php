<?php get_header(); ?>

<article>


<?php 
        if ( have_posts() ):
            
            while( have_posts()):  the_post(); ?>

            <div class="container-fluid" id="single-post">

                <?php $backgroundImg = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'full' );
                $categories = get_the_category(get_the_ID());?>

                <div class="container-fluid" style="position:relative;">
                    <img class="w-100 featured-img" src="<?php echo $backgroundImg[0]?>" alt="<?php the_title(); ?>">
                    <div class="fondo-oscuro"></div>
                    <h1 title="<?php echo the_title(); ?>" id="short-title"><?php echo the_title(); ?></h1>

                    <div class="d-flex">
                        <?php $i=0;
                          foreach($categories as $category): ?>
                              <span class="category px-2 me-2 me-lg-4"><?php echo $category->name ; ?></span>
                          <?php $i++;
                          endforeach; ?>

                        <span class="date ms-2 ms-lg-3"><?php echo get_the_date();?></span>
                    </div>

                    <div class="row autor">
                        <div class="col-5 pe-0"><?php echo get_avatar( get_the_author_email() ); ?></div>
                        <div class="col-7 ps-0 pt-2">
                            <span class="fw-bold fs-4 autor-name"><?php echo get_the_author(); ?></span>
                            <span class="fw-light fs-5"><?php pll_e('Autor'); ?></span>
                        </div>
                        
                    </div>

                </div>

                <div class="container my-5">
                    <h1><?php echo the_title(); ?></h1>
                    <p><?php echo the_content(); ?></p>
                </div>


                <?php 
                    $title = get_the_title();
                    $permalink = get_the_permalink();
                    $twitterHandler = ( get_option('twitter_handler') ? '&amp;via='.esc_attr( get_option('twitter_handler') ) : '' );

                    $twitter = 'https://twitter.com/intent/tweet?text=Hey! Read this: ' . $title . '&amp;url=' . $permalink . $twitterHandler .'';
                    $facebook = 'https://www.facebook.com/sharer/sharer.php?u=' . $permalink;
                    $linkedIn = 'https://www.linkedin.com/sharing/share-offsite/?url=' . $permalink;
                ?>
                 
                <aside class="social-media">
                    
                        <a href="<?php echo $facebook ?>" class="s-item facebook" target="_blank">
                            <span class="fab fa-facebook-f"></span>
                        </a>
                        
                        <a href="<?php echo $twitter ?>" class="s-item twitter" target="_blank">
                            <span class="fab fa-twitter"></span>
                        </a>
                        

                        <a href="<?php echo $linkedIn ?>" class="s-item gplus" target="_blank">
                            <span class="fab fa-linkedin-in"></span>
                        </a>

                </aside>

                <div class="row justify-content-center text-center mt-5">
                  <?php comments_template(); ?>
                </div>

            </div>




<?php       endwhile;
            
        endif; ?>
</article>
<?php get_footer(); ?>