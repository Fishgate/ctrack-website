<?php

/*
 * Add a color selection meta box onto the pages screen to tag faculty pages with their correct colours.
 */
function ct_add_header_meta() {
    add_meta_box('bc_fac_color', __('Ctrack Options', 'Avada'), 'ct_add_header_meta_callback', 'page', 'side');
}
add_action('add_meta_boxes', 'ct_add_header_meta');

/*
 * Output the meta box
 * 
 * @param WP_Post $post The object for the current page/post
 */
function ct_add_header_meta_callback( $post ) {
    // Add an nonce field so we can check for it later.
    wp_nonce_field( 'ct_add_header_meta', 'ct_add_header_meta_nonce' );        
    ?>

    <p><strong><?php _e('Header Options', 'Avada'); ?></strong></p>

    <?php if(get_post_meta($post->ID, '_ct_header_meta', true) === 'true') { ?>

        <div><input checked="checked" class="checkbox" name="_ct_header_meta" id="header_meta_checkbox" value="true" type="checkbox"><label for="header_meta_checkbox"><?php _e('Light Header', 'Avada'); ?></label></div>

    <?php } else { ?>

        <div><input class="checkbox" name="_ct_header_meta" id="header_meta_checkbox" value="true" type="checkbox"><label for="header_meta_checkbox"><?php _e('Light Header', 'Avada'); ?></label></div>

    <?php } ?>
    
    <?php
}

/**
 * When the post is saved, saves our custom data.
 *
 * @param int $post_id The ID of the post being saved.
 */
function ct_add_header_meta_save( $post_id ) {
    /*
    * We need to verify this came from our screen and with proper authorization,
    * because the save_post action can be triggered at other times.
    */

    // Check if our nonce is set.
    if ( ! isset( $_POST['ct_add_header_meta_nonce'] ) ) {
            return;
    }

    // Verify that the nonce is valid.
    if ( ! wp_verify_nonce( $_POST['ct_add_header_meta_nonce'], 'ct_add_header_meta' ) ) {
            return;
    }
    
    // If this is an autosave, our form has not been submitted, so we don't want to do anything.
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
            return;
    }

    // Check the user's permissions.
    if ( isset( $_POST['post_type'] ) && 'page' == $_POST['post_type'] ) {

            if ( ! current_user_can( 'edit_page', $post_id ) ) {
                    return;
            }

    } else {

            if ( ! current_user_can( 'edit_post', $post_id ) ) {
                    return;
            }
    }

    // everything is good, save the meta

    if(isset($_POST['_ct_header_meta']) && !empty($_POST['_ct_header_meta'])) {
        $ct_header_meta = sanitize_text_field($_POST['_ct_header_meta']);

        if($ct_header_meta == 'true') {
            add_post_meta($post_id, '_ct_header_meta', 'true', true ) || update_post_meta($post_id, '_ct_header_meta', 'true');
        }else{
            add_post_meta($post_id, '_ct_header_meta', 'false', true ) || update_post_meta($post_id, '_ct_header_meta', 'false');
        }
    }else{
        add_post_meta($post_id, '_ct_header_meta', 'false', true ) || update_post_meta($post_id, '_ct_header_meta', 'false');
    }

}
add_action('save_post', 'ct_add_header_meta_save');


?>
