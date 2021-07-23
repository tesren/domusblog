<!DOCTYPE html>
<html <?php language_attributes();?>>
    <head>
        <meta charset="UTF-8">
        <title> </title>
         <meta charset="<?php bloginfo('charset');?>">
        <?php if( is_singular() && pings_open( get_queried_object() )  ) : ?>
        <link rel="pingback" href="<?php bloginfo('pingback_url');?>">
        <?php endif; ?>
        <?php wp_head();?>
        <link rel="shortcut icon" href="favicon.svg" type="image/x-icon">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!--fuente-->
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
        <!--fancybox-->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui/dist/fancybox.css"/>
        <!--datepicker-->
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
        
    </head>
    
    <body <?php body_class();?>>

      <!--NAVBAR-->
    <header>
      <div class="container-fluid bg-azul">
       
            <nav id="mainHeader" class="navbar navbar-expand-lg navbar-dark justify-content-between" role="navigation" style="position:relative;">
              <a class="navbar-brand" href="<?php echo get_home_url(); ?>" id="header-brand">
                <img class="ms-5 my-2" src="<?php echo get_template_directory_uri() .'/assets/images/domus_logo_blanco.png';?>" id="nav_header_logo" alt="Logo" width="220px" height="auto">
              </a>
             
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
            
              
                <?php
                      wp_nav_menu( array(
                          'theme_location'    => 'primary',
                          'depth'             => 2,
                          'container'         => 'div',
                          'container_class'   => 'collapse navbar-collapse',
                          'container_id'      => 'navbarSupportedContent',
                          'menu_class'        => 'navbar-nav d-flex justify-content-between mx-5 w-100',
                          'menu_id'           => 'domus_navbar',
                          'fallback_cb'       => 'WP_Bootstrap_Navwalker::fallback',
                          'walker'            => new WP_Bootstrap_Navwalker(),
                      ) );
                      ?>
            
            </nav>
          </div>

          <div class="row" id="fixedTopMsg" style="background: #ccc;">
            <div class="col-12">
                <div class="p-2 text-center" style="text-transform: uppercase;">Regístrate para agendar un tour físico o virtual <button type="button" data-toggle="modal" data-target="#agendarVisita" style="display:block-inline; margin-left:15px;background: #21273e; border-radius: 10px; color:#fff; border:solid 1px #21273e; padding: 4px 14px;">AGENDA AQUÍ</button></div>
            </div>
        </div>

    </header>

