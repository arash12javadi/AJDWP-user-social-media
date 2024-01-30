<?php

if ( ! defined( 'ABSPATH' ) ) exit; 

/**
 * Plugin Name:       AJDWP-user-social-media
 * Plugin URI:        https://github.com/arash12javadi/
 * Description:       The User Social Media plugin employs the shortcodes [get_user_social_media] and [show_user_social_media]. To enhance readability, I've included a line break `<br>` and an internal style `<style>` to present the codes in a vertical format. If you prefer, feel free to omit them. Additionally, the plugin seamlessly incorporates the added social media links into the user author page automatically. Enjoy! :)
 * Version:           1
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Arash Javadi
 * Author URI:        https://arashjavadi.com/  
 */


//__________________________________________________________________________//
//                       ADD JAVASCRIPTS AND CSS
//__________________________________________________________________________//

wp_enqueue_style( 'AJDWP_usm_bootstrap_css', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css' );    
wp_enqueue_script( 'AJDWP_usm_bootstrap_js', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js' );   
wp_enqueue_style( 'AJDWP_usm_fontawsome_4.7.0', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css' );    

//__________________________________________________________________________//
//                               CODES HERE                   
//__________________________________________________________________________//

function plugin_handle_user_social_form() {
    // Handle form submission
    if (isset($_POST['submit_user_social']) && wp_verify_nonce($_POST['user_social_wpnonce'], 'update_user_social_media')) {
        
        update_user_meta( get_current_user_id(), 'user_facebook', sanitize_text_field($_POST['user_facebook'] ));
        update_user_meta( get_current_user_id(), 'user_instagram', sanitize_text_field($_POST['user_instagram'] ));
        update_user_meta( get_current_user_id(), 'user_twitter', sanitize_text_field($_POST['user_twitter'] ));
        update_user_meta( get_current_user_id(), 'user_linkedin', sanitize_text_field($_POST['user_linkedin'] ));
        update_user_meta( get_current_user_id(), 'user_google', sanitize_text_field($_POST['user_google'] ));
        update_user_meta( get_current_user_id(), 'user_youtube', sanitize_text_field($_POST['user_youtube'] ));
        update_user_meta( get_current_user_id(), 'user_GitHub', sanitize_text_field($_POST['user_GitHub'] ));
        update_user_meta( get_current_user_id(), 'user_StackOverFlow', sanitize_text_field($_POST['user_StackOverFlow'] ));
        update_user_meta( get_current_user_id(), 'user_whatsapp', sanitize_text_field($_POST['user_whatsapp'] ));
        update_user_meta( get_current_user_id(), 'user_other', sanitize_text_field($_POST['user_other'] ));
        update_user_meta( get_current_user_id(), 'custom_avatar_url', $user_avatar_image_url);

        if(isset($_POST['delete_avatar'])){
            delete_user_meta(get_current_user_id(), 'custom_avatar_url');
        }

    }
    // Redirect back to the page after processing the form
    wp_redirect($_SERVER['HTTP_REFERER']);
    exit;
}

// Hook for handling the form submission
add_action('admin_post_plugin_handle_user_social_form', 'plugin_handle_user_social_form');

//------------------------------------- Add input for user social media ------------------------------------//

function plugin_extra_user_profile_fields() { 
?>


<h5 class="fw-bold">Add Your Social Media Links</h5>
<form method="post" action="<?php echo esc_url( admin_url('admin-post.php') ); ?>">
    <input type="hidden" name="action" value="plugin_handle_user_social_form">

    <table class="form-table">
    <tr>
        <th><label for="user_facebook">Facebook</label></th>
        <td>
            <input type="text" name="user_facebook" id="user_facebook" value="<?php echo esc_attr( get_the_author_meta( 'user_facebook', get_current_user_id() ) ); ?>" class="regular-text" />
        </td>
    </tr>
    <tr>
        <th><label for="user_instagram">Instagram</label></th>
        <td>
            <input type="text" name="user_instagram" id="user_instagram" value="<?php echo esc_attr( get_the_author_meta( 'user_instagram', get_current_user_id() ) ); ?>" class="regular-text" />
        </td>
    </tr>
    <tr>
        <th><label for="user_twitter">Twitter</label></th>
        <td>
            <input type="text" name="user_twitter" id="user_twitter" value="<?php echo esc_attr( get_the_author_meta( 'user_twitter', get_current_user_id() ) ); ?>" class="regular-text" />
        </td>
    </tr>
    <tr>
        <th><label for="user_linkedin">Linkedin</label></th>
        <td>
            <input type="text" name="user_linkedin" id="user_linkedin" value="<?php echo esc_attr( get_the_author_meta( 'user_linkedin', get_current_user_id() ) ); ?>" class="regular-text" />
        </td>
    </tr>
    <tr>
        <th><label for="user_google">Google</label></th>
        <td>
            <input type="text" name="user_google" id="user_google" value="<?php echo esc_attr( get_the_author_meta( 'user_google', get_current_user_id() ) ); ?>" class="regular-text" />
        </td>
    </tr>
    <tr>
        <th><label for="user_youtube">YouTube</label></th>
        <td>
            <input type="text" name="user_youtube" id="user_youtube" value="<?php echo esc_attr( get_the_author_meta( 'user_youtube', get_current_user_id() ) ); ?>" class="regular-text" />
        </td>
    </tr>
    <tr>
        <th><label for="user_GitHub">GitHub</label></th>
        <td>
            <input type="text" name="user_GitHub" id="user_GitHub" value="<?php echo esc_attr( get_the_author_meta( 'user_GitHub', get_current_user_id() ) ); ?>" class="regular-text" />
        </td>
    </tr>
    <tr>
        <th><label for="user_StackOverFlow">Stack Overflow</label></th>
        <td>
            <input type="text" name="user_StackOverFlow" id="user_StackOverFlow" value="<?php echo esc_attr( get_the_author_meta( 'user_StackOverFlow', get_current_user_id() ) ); ?>" class="regular-text" />
        </td>
    </tr>
    <tr>
        <th><label for="user_whatsapp">WhatsApp</label></th>
        <td>
            <input type="text" name="user_whatsapp" id="user_whatsapp" placeholder="https://wa.me/1XXXXXXXXXX" value="<?php echo esc_attr( get_the_author_meta( 'user_whatsapp', get_current_user_id() ) ); ?> " class="regular-text" />
        </td>
    </tr>


    <tr>
        <th><label for="user_other">Other Links</label></th>
        <td>
            <input type="text" name="user_other" id="user_other" value="<?php echo esc_attr( get_the_author_meta( 'user_other', get_current_user_id() ) ); ?>" class="regular-text" />
        </td>
    </tr>
    
    </table>
    <?php wp_nonce_field('update_user_social_media', 'user_social_wpnonce'); ?>
    <input type="submit" value="Submit" name="submit_user_social">
</form>

<p>After submitting go to your profile page to see your social media links <a href="<?php echo get_author_posts_url(get_current_user_id(  ));?>"><i class="fa fa-link"></i></a>.</p>
<?php 
}

add_shortcode( 'get_user_social_media', 'plugin_extra_user_profile_fields');

//------------------------------------- Save user social medias as usermeta ------------------------------------//

function plugin_User_Social_Media_func(){

?>

<div class="text-left justify-content-center  font-weight-bold h5 py-2">
    
    <?php if(get_user_meta( get_the_author_meta('ID'), 'user_facebook', true)){ ?>
            <!-- user_facebook -->
            <a href="<?php echo get_user_meta( get_the_author_meta('ID'), 'user_facebook', true); ?>" target="_blank" ><i class="fa fa-facebook-f fa-2x m-3 fa-AJDWP-class" style="color: #3b5998;"></i></a>
            <br>
    <?php } ?>


    <?php if(get_user_meta( get_the_author_meta('ID'), 'user_twitter', true)){ ?>
            <!-- user_twitter -->
            <a href="<?php echo get_user_meta( get_the_author_meta('ID'), 'user_twitter', true); ?>" target="_blank" ><i class="fa fa-twitter fa-2x m-3 fa-AJDWP-class" style="color: #55acee;"></i></a>
            <br>
    <?php } ?>


    <?php if(get_user_meta( get_the_author_meta('ID'), 'user_google', true)){ ?>
            <!-- user_google -->
            <a href="<?php echo get_user_meta( get_the_author_meta('ID'), 'user_google', true); ?>" target="_blank" ><i class="fa fa-google fa-2x m-3 fa-AJDWP-class" style="color: #dd4b39;"></i></a>
            <br>
    <?php } ?>


    <?php if(get_user_meta( get_the_author_meta('ID'), 'user_instagram', true)){ ?>
            <!-- user_instagram -->
            <a href="<?php echo get_user_meta( get_the_author_meta('ID'), 'user_instagram', true); ?>" target="_blank" ><i class="fa fa-instagram fa-2x m-3 fa-AJDWP-class" style="color: #ac2bac;"></i></a>
            <br>
    <?php } ?>


    <?php if(get_user_meta( get_the_author_meta('ID'), 'user_linkedin', true)){ ?>
            <!-- user_linkedin -->
            <a href="<?php echo get_user_meta( get_the_author_meta('ID'), 'user_linkedin', true); ?>" target="_blank" ><i class="fa fa-linkedin fa-2x m-3 fa-AJDWP-class" style="color: #0082ca;"></i></a>
            <br>
    <?php } ?>


    <?php if(get_user_meta( get_the_author_meta('ID'), 'user_youtube', true)){ ?>
            <!-- user_youtube -->
            <a href="<?php echo get_user_meta( get_the_author_meta('ID'), 'user_youtube', true); ?>" target="_blank" ><i class="fa fa-youtube fa-2x m-3 fa-AJDWP-class" style="color: #c4302b;"></i></a>
            <br>
    <?php } ?>

    <?php if(get_user_meta( get_the_author_meta('ID'), 'user_GitHub', true)){ ?>
            <!-- user_GitHub -->
            <a href="<?php echo get_user_meta( get_the_author_meta('ID'), 'user_GitHub', true); ?>" target="_blank" ><i class="fa-brands fa-github fa-2x m-3 fa-AJDWP-class" style="color: #2dba4e;"></i></a>
            <br>
    <?php } ?>

    <?php if(get_user_meta( get_the_author_meta('ID'), 'user_StackOverFlow', true)){ ?>
            <!-- user_StackOverFlow -->
            <a href="<?php echo get_user_meta( get_the_author_meta('ID'), 'user_StackOverFlow', true); ?>" target="_blank" ><i class="fa-brands fa-stack-overflow fa-2x m-3 fa-AJDWP-class" style="color: #F48024;"></i></a>
            <br>
    <?php } ?>


    <?php if(get_user_meta( get_the_author_meta('ID'), 'user_whatsapp', true)){ ?>
            <!-- user_whatsapp -->
            <a href="<?php echo get_user_meta( get_the_author_meta('ID'), 'user_whatsapp', true); ?>" target="_blank" ><i class="fa fa-whatsapp fa-2x m-3 fa-AJDWP-class" style="color: #25D366;"></i></a>
            <br>
    <?php } ?>


    <?php if(get_user_meta( get_the_author_meta('ID'), 'user_other', true)){ ?>
            <!-- user_other -->
            <a href="<?php echo get_user_meta( get_the_author_meta('ID'), 'user_other', true); ?>" target="_blank" ><i class="fa fa-link fa-2x m-3 fa-AJDWP-class" style="color: gold;"></i></a>
            <br>
    <?php } ?>

</div>
<style>
    div#flying-icons-container {
    position: fixed;
    top: 50%;
    display: flex;
    }

    i.fa-AJDWP-class {
        transition: transform 0.3s ease !important; 
    }

    i.fa-AJDWP-class:hover {
        transform: scale(1.2) !important; 
    }

</style>
<?php } 

add_shortcode( 'show_user_social_media', 'plugin_User_Social_Media_func');


//--------------------------- Add the social media links to athor page ---------------------------//

function display_flying_icons_on_author_page() {
    // Check if the current page is an author page
    if (is_author()) {
        // Output the flying icons
        echo '<div id="flying-icons-container">';
        echo do_shortcode('[show_user_social_media]');
        echo '</div>';
    }
}

// Hook the custom function to the wp_footer action
add_action('wp_footer', 'display_flying_icons_on_author_page');
