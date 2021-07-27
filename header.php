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

      
      <?php 
            wp_nav_menu( array(
                //'menu'              => "pre-header", // (int|string|WP_Term) Desired menu. Accepts a menu ID, slug, name, or object.
                'menu_class'        => "list-inline col-1", // (string) CSS class to use for the ul element which forms the menu. Default 'menu'.
                'menu_id'           => "pre_header_menu", // (string) The ID that is applied to the ul element which forms the menu. Default is the menu slug, incremented.
                'container'         => "div", // (string) Whether to wrap the ul, and what to wrap it with. Default 'div'.
                'container_class'   => "row justify-content-end bg-azul pt-3", // (string) Class that is applied to the container. Default 'menu-{menu slug}-container'.
                'container_id'      => "language-buttons", // (string) The ID that is applied to the container.
                //'fallback_cb'       => "", // (callable|bool) If the menu doesn't exists, a callback function will fire. Default is 'wp_page_menu'. Set to false for no fallback.
                //'before'            => "", // (string) Text before the link markup.
                //'after'             => "", // (string) Text after the link markup.
                //'link_before'       => "", // (string) Text before the link text.
                //'link_after'        => "", // (string) Text after the link text.
                //'echo'              => "", // (bool) Whether to echo the menu or return it. Default true.
                //'depth'             => "", // (int) How many levels of the hierarchy are to be included. 0 means all. Default 0.
                //'walker'            => "", // (object) Instance of a custom walker class.
                'theme_location'    => "pre-header", // (string) Theme location to be used. Must be registered with register_nav_menu() in order to be selectable by the user.
                //'items_wrap'        => "", // (string) How the list items should be wrapped. Default is a ul with an id and class. Uses printf() format with numbered placeholders.
                //'item_spacing'      => "", // (string) Whether to preserve whitespace within the menu's HTML. Accepts 'preserve' or 'discard'. Default 'preserve'.
            ) );
          ?>
      

      <div class="container-fluid bg-azul">
       
            <nav id="mainHeader" class="navbar navbar-expand-lg navbar-dark justify-content-between" role="navigation" style="position:relative;">
              <a class="navbar-brand" href="<?php echo get_home_url(); ?>" id="header-brand">
                <img class="ms-5 my-2" src="<?php echo get_template_directory_uri() .'/assets/images/domus_logo_blanco.png';?>" id="nav_header_logo" alt="Logo" width="200px" height="auto">
              </a>
             
              <button class="navbar-toggler me-2" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
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
                <div class="p-2 text-center" style="text-transform: uppercase;"><?php pll_e('REGÍSTRATE PARA AGENDAR UN TOUR FÍSICO O VIRTUAL'); ?> <button type="button" data-toggle="modal" data-target="#agendarVisita" style="display:block-inline; margin-left:15px;background: #21273e; border-radius: 10px; color:#fff; border:solid 1px #21273e; padding: 4px 14px;"><?php pll_e('Agenda aquí');?></button></div>
            </div>
        </div>

    </header>

