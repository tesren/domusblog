<?php 
/*

@package vallarta4yourentalstheme

    =============================
    AJAX FUNCTIONS
    ============================

*/

add_action('wp_ajax_nopriv_v4you_save_contact', 'v4you_save_contact');
add_action('wp_ajax_v4you_save_contact', 'v4you_save_contact');


function v4you_save_contact(){
    $title = wp_strip_all_tags($_POST['name']);
    $email = wp_strip_all_tags($_POST['email']);
    $phone = wp_strip_all_tags($_POST['phone']);
    $message = wp_strip_all_tags($_POST['message']);

     $args = array(
        'post_title' => $title,
        'post_content' => $message,
        'post_author' => 1,
        'pots_status' => 'publish',
        'post_type' => 'v4you-contact',
        'meta_input' => array(
            '_contact_email_value_key' => $email
        )
    );

    $postID = wp_insert_post( $args );

    if( $postID !== 0 ){

        //$to = get_bloginfo('admin_email');
        $to = 'info@oceansingerlacruz.com';

        $subject = 'Contact Email Ocean Singer La Cruz - '. $title;

        $headers[] = 'From: '. get_bloginfo('name') . '<'. $to .'>';
        $headers[] = 'Reply-To: '. $title. '<'. $email .'>';
        $headers[] = 'Content-Type: text/html; chartset=UTF8';

        $messageHTLM = "Name: ".$title."<br>Email: ".$email."<br> Phone Number:  ".$phone."<br> Message: ".$message;

        wp_mail( $to, $subject, $messageHTLM, $headers );

        echo $postID;

    }else{
        echo 0;
    }


    //echo $postID;

    die();

}