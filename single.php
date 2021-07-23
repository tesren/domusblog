<?php get_header(); ?>

<article>


<?php 
        if ( have_posts() ):
            
            while( have_posts()):  the_post(); ?>

            <div class="container-fluid" id="single-post">

                <?php $backgroundImg = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'full' );
                $categories = get_the_category(get_the_ID());?>

                <div class="container-fluid" style="position:relative;">
                    <img class="w-100" src="<?php echo $backgroundImg[0]?>" alt="<?php the_title(); ?>">
                    <div class="fondo-oscuro"></div>
                    <h1 id="short-title"><?php echo the_title(); ?></h1>

                    <div class="d-flex">
                        <?php $i=0;
                          foreach($categories as $category): ?>
                              <span class="category px-2 me-4"><?php echo $category->name ; ?></span>
                          <?php $i++;
                          endforeach; ?>

                        <span class="date ms-3"><?php echo get_the_date();?></span>
                    </div>
                </div>

                <div class="container my-5">
                    <h1><?php echo the_title(); ?></h1>
                    <p><?php echo the_content(); ?></p>

                    <?php $comments = get_comments( ); 
                    var_dump($comments);?>
 ?>
                </div>

            </div>




<?php       endwhile;
            
        endif; ?>
</article>
<?php get_footer(); ?>