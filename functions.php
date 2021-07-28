<?php

function domus_theme_support()
{
    //Add dinamyc title tag support
    add_theme_support('title-tag');
    add_theme_support('custom-logo');
    add_theme_support('post-thumbnails');
    add_theme_support( 'custom-header' );
    add_theme_support('html5', array('comment-list', 'comment-form') );
}

add_action('after_setup_theme', 'domus_theme_support');

//ENABLE MENU FUNCTION

function domus_menus()
{    
    $locations = array(
        'primary' => __( 'Primary Menu', 'domus' ),
        'pre-header' => __('Pre Header Menu', 'domus'),
        'footer' => "Footer menu Items",
    );
    
    register_nav_menus( $locations );
}

add_action('init', 'domus_menus');


function domus_register_styles()
{
    $version = wp_get_theme()->get( 'Version' );
    wp_enqueue_style('domus-style', get_template_directory_uri() . "/style.css", array('domus-bootstrap'), $version , 'all');
    // wp_enqueue_style('cb-bootstrap', "https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css", array(), '5.0.0', 'all');
    wp_enqueue_style('domus-bootstrap', get_template_directory_uri() . "/assets/css/bootstrap.min.css", array(), '5.0.0', 'all');
    wp_enqueue_style('domus-style-primary', get_template_directory_uri() . "/assets/css/domus_styles.css", array(), $version , 'all');
    wp_enqueue_style('domus-fontawesome', get_template_directory_uri() . "/assets/css/all.min.css", array(), '5.15.1' , 'all');
    //Fontawesome cdn
    //wp_enqueue_style('cb-fontawesome', "/style.css", array(), '1.0', 'all');
    if ( is_page( 'progress-construction' ) ) {
        wp_enqueue_style('os-gallery', get_template_directory_uri() . "/assets/css/unite-gallery.css", array(), $version , 'all');
    }
}

add_action('wp_enqueue_scripts', 'domus_register_styles');


function domus_register_scripts()
{
    
    $version = wp_get_theme()->get( 'Version' );
    wp_enqueue_script('domus_jquery', 'https://code.jquery.com/jquery-3.5.1.min.js', array(), '3.5.1', true);
    // wp_enqueue_script('cb_popper', 'https://unpkg.com/@popperjs/core@2/dist/umd/popper.js', array(), '2.0', true);
    // wp_enqueue_script('cb_bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js', array(), '5.0.0', true);
    wp_enqueue_script('one_bootstrap', get_template_directory_uri() .  '/assets/js/bootstrap.min.js', array(), '5.0.0', true);
    wp_enqueue_script('domus_gmaps', 'https://maps.googleapis.com/maps/api/js?key=AIzaSyDlDmMESUjBK1gwNJm5x4hyoS90qacpJmY', array(), '', true);
    wp_enqueue_script('domus_fontawesome', get_template_directory_uri() .  '/assets/js/all.min.js', array(), '5.15.1', true);
    wp_enqueue_script('os_reallax', get_template_directory_uri() .  '/assets/js/vendor/rellax.min.js', array(), '1', true);
    wp_enqueue_script('domus_main', get_template_directory_uri() .  '/assets/js/domus_main.js', array('domus_jquery'), $version, true);
    wp_enqueue_script('domus_datepicker', 'https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js', array(), '1', true);
    if ( is_page( 'progress-construction' ) ) {
        wp_enqueue_script('os-gallery', get_template_directory_uri() . "/assets/js/vendor/unitegallery.min.js", array(), $version , true);
        wp_enqueue_script('theme-gallery', get_template_directory_uri() . "/assets/themes/tiles/ug-theme-tiles.js", array(), $version , true);
        wp_enqueue_script('custom-js', get_template_directory_uri() . "/assets/js/progress-construction.js", array('theme-gallery'), $version , true);
    }
    
}

add_action('wp_enqueue_scripts', 'domus_register_scripts');


// Async load
function os_async_scripts($url)
{
    if ( strpos( $url, '#asyncload') === false )
        return $url;
    else if ( is_admin() )
        return str_replace( '#asyncload', '', $url );
    else
	return str_replace( '#asyncload', '', $url )."' async='async"; 
}

add_filter( 'clean_url', 'os_async_scripts', 11, 1 );


/*
		==========================================
			INCLUDE WALKER FILTER
		==========================================

	*/
    /**
     * Register Custom Navigation Walker
     */
    function register_navwalker(){
        require_once get_template_directory() . '/classes/class-wp-bootstrap-navwalker.php';
    }
    add_action( 'after_setup_theme', 'register_navwalker' );

    /**
     * Register Custom Comments Walker
     */
    function register_commentswalker(){
        require_once get_template_directory() . '/inc/walker-comments.php';
    }
    add_action( 'after_setup_theme', 'register_commentswalker' );


/*
		==========================================
			CUSTOM CONTACT FORM
		==========================================

    */
    
    function v4you_contact_custom_post_type(){

        $labels = array(
            'name'          => 'Messages',
            'singular_name' => 'Message',
            'add_new'       => 'Add new message',
            'all_items'     => 'All Messages',
            'add_new_items' => 'Add item',
            'edit_item'     => 'Edit Message',
            'new_item'      => 'New Item',
            'view_item'     => 'View Item',
            'name_admin_bar'=> 'Message',
            'search_item'   => 'Search Listing',
            'not_found'     => 'No items found',
            'parent_item_colon' => 'Parent item'

        );

        $args = array(
            'labels' => $labels,
            'public' => true,
            'has_archive' => true,
            'publicly_queryable' =>  true,
            'query_var' => true,
            'rewrite' => true,
            'capability_type' => 'post',
            'hierarchical' => false,
            'supports' => array(
                'title',
                'editor',
                'author',
            ),
            'menu_icon' => 'dashicons-email-alt',
            'menu_positions' => 9,

        );

        register_post_type('v4you-contact', $args);

    }

    add_action('init', 'v4you_contact_custom_post_type');
    
    add_filter( 'manage_v4you-contact_posts_columns', 'v4you_set_contact_columns' );

    add_action( 'manage_v4you-contact_posts_custom_column', 'v4you_contact_custom_column', 10, 2);

    function v4you_set_contact_columns( $columns ){
        
        $newColumns = array();
        $newColumns['title'] = 'Full Name';
        $newColumns['message'] = 'Message';
        $newColumns['email'] = 'Email';
        $newColumns['date'] = 'Date';
        return $newColumns;

    }

    function v4you_contact_custom_column( $column, $post_id ){

        switch( $column ){

            case 'message' :
                echo get_the_excerpt();
                break;
            case 'email' :
                $email = get_post_meta( $post_id, '_contact_email_value_key', true);
                echo '<a href="mailto:'.$email.'">'.$email.'</a>';
                break;
        }

    }

    /*CONTACT META BOXES si quiero recolectar más campos del form solo tengo que añadirlos aquí */

    function v4you_contact_add_meta_box(){
        add_meta_box( 'contact_email', 'User Email', 'v4you_contact_email_callback', 'v4you-contact', 'normal', 'high' );
    }

    function v4you_contact_email_callback( $post ){

        wp_nonce_field( 'v4you_save_contact_email_data', 'v4you_contact_email_meta_box_nonce' );
        
        $value = get_post_meta( $post->ID, '_contact_email_value_key', tue);

        echo '<label for="v4you_contact_email_field">User Email Address</label>';
        echo '<input type="email" id="v4you_contact_email_field" name="v4you_contact_email_field" value="'. esc_attr( $value ) .'" size="25" />';
    };

    add_action('add_meta_boxes', 'v4you_contact_add_meta_box');

    //Storage data
    function v4you_save_contact_email_data( $post_id ){

        if( ! isset( $_POST['v4you_contact_email_meta_box_nonce'] ) ){
            return;
        }

        if( ! wp_verify_nonce( $_POST['v4you_contact_email_meta_box_nonce'],'v4you_save_contact_email_data') ) {
            return;
        }

        if( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ){
            return;
        }

        //revisar si el usuario tiene permisos
        if( ! current_user_can('edit_post', $post_id) ){
            return;
        }
        //Validar que el campo enviado no esté vacio
        if( !isset( $_POST['v4you_contact_email_field'] ) ){
            return;
        }

        $my_data = sanitize_text_field( $_POST['v4you_contact_email_field'] );

        update_post_meta( $post_id, '_contact_email_value_key', $my_data );

    }

    add_action('save_post', 'v4you_save_contact_email_data');


    require get_template_directory() . '/inc/ajax.php';



    function check_post_type_and_remove_media_buttons() {
        global $current_screen;
        // Replace following array items with your own custom post types
        $post_types = array('rentals','lifestyle', 'developments', 'realtors');
        if (in_array($current_screen->post_type,$post_types)) {
        remove_action('media_buttons', 'media_buttons');
        }
    }
    
    add_action('admin_head','check_post_type_and_remove_media_buttons');


    function domus_get_list_terms($postID, $taxonomy)
    {
         $terms_list = array_reverse(wp_get_post_terms( $postID, $taxonomy ) );

        $j =1;
        if ( ! empty( $terms_list ) && ! is_wp_error( $terms_list ) ) {
            foreach ( $terms_list as $term ) {
                echo $term->name;
                if( $j < count($terms_list) ){
                    echo ', ';
                }
                $j++;
            }
        }
    }


    function domus_set_strings_transtaltion(){
        
        $strings = array(
            array(
                'name'     =>'agenda_aqui',
                'string'   =>'Agenda aquí',
                'group'    =>'Header',
                'multiline'=>false,
            ),
            array(
                'name'     =>'register_tour',
                'string'   =>'REGÍSTRATE PARA AGENDAR UN TOUR FÍSICO O VIRTUAL',
                'group'    =>'Header',
                'multiline'=>false,
            ),
            array(
                'name'     =>'recent_post',
                'string'   =>'Entradas Recientes',
                'group'    =>'Front Page',
                'multiline'=>false,
            ),
            array(
                'name'     =>'author',
                'string'   =>'Autor',
                'group'    =>'Single Page',
                'multiline'=>false,
            ),
            array(
                'name'     =>'search',
                'string'   =>'Buscar',
                'group'    =>'Search Form',
                'multiline'=>false,
            ),
            array(
                'name'     =>'reply',
                'string'   =>'Responder',
                'group'    =>'Comments',
                'multiline'=>false,
            ),
            array(
                'name'     =>'closed_comments',
                'string'   =>'Comentarios Cerrados',
                'group'    =>'Comments',
                'multiline'=>false,
            ),
            array(
                'name'     =>'awaiting_moderation',
                'string'   =>'Su comentario está a la espera de moderación',
                'group'    =>'Comments',
                'multiline'=>false,
            ),
            array(
                'name'     =>'name',
                'string'   =>'Nombre',
                'group'    =>'Comments',
                'multiline'=>false,
            ),
            array(
                'name'     =>'correo',
                'string'   =>'Correo',
                'group'    =>'Comments',
                'multiline'=>false,
            ),
            array(
                'name'     =>'website',
                'string'   =>'Sitio Web',
                'group'    =>'Comments',
                'multiline'=>false,
            ),
            array(
                'name'     =>'submit',
                'string'   =>'Enviar',
                'group'    =>'Comments',
                'multiline'=>false,
            ),
            array(
                'name'     =>'leave_comment',
                'string'   =>'Deja un comentario',
                'group'    =>'Comments',
                'multiline'=>false,
            ),
            array(
                'name'     =>'comment',
                'string'   =>'Comentario',
                'group'    =>'Comments',
                'multiline'=>false,
            ),
            array(
                'name'     =>'results',
                'string'   =>'Resultados',
                'group'    =>'Search Results',
                'multiline'=>false,
            ),
            array(
                'name'     =>'no_results',
                'string'   =>'No hay resultados',
                'group'    =>'Search Results',
                'multiline'=>false,
            ),
            array(
                'name'     =>'go_back',
                'string'   =>'Volver',
                'group'    =>'Search Results',
                'multiline'=>false,
            ),
            array(
                'name'     =>'follow_us',
                'string'   =>'Síguenos',
                'group'    =>'Footer',
                'multiline'=>false,
            ),
            array(
                'name'     =>'affiliates',
                'string'   =>'Afiliados',
                'group'    =>'Footer',
                'multiline'=>false,
            ),
            array(
                'name'     =>'know_our',
                'string'   =>'Conoce nuestras',
                'group'    =>'Footer',
                'multiline'=>false,
            ),
            array(
                'name'     =>'privacy_policy',
                'string'   =>'Políticas de Privacidad',
                'group'    =>'Footer',
                'multiline'=>false,
            ),
           
        );


        foreach ($strings as $string ) {
            
            pll_register_string( $string['name'], $string['string'], $string['group'], $string['multiline'] );
        };

    }

    add_action('init', 'domus_set_strings_transtaltion');


?>