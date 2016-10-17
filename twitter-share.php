<?php
/*
Plugin Name: A-Theme tweetable text
Description: Plugin for allowing you to share parts of your post text via twitter.
Version: 1.0
Author: Isaac Ben Hutta
License: GPLv2
*/

/* Copyright 2016 Isaac Ben Hutta
This program is free software; you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation; either version 2 of the License, or (at your option) any later version.
This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.
You should have received a copy of the GNU General Public License */

foreach ( array('post.php','post-new.php') as $hook )
{
     add_action( "admin_head-$hook", 'my_admin_head' );
}

/**
 * Localize Script
 */
function my_admin_head()
{
    $form_url = plugins_url( '/twitter-share-form.php', __FILE__ );
    ?>
<!-- TinyMCE Shortcode Plugin -->
<script type='text/javascript'>
var twitter_share_data = {
    'form_url': '<?php echo $form_url; ?>',
    'twitter_image': '<?php echo plugins_url( "/twitter-icon.png", __FILE__ ); ?>'
};
</script>
<!-- TinyMCE Shortcode Plugin -->
    <?php
}

add_action( 'admin_init', 'twitter_share_tinymce_button' );

function twitter_share_tinymce_button()
{
     if ( current_user_can( 'edit_posts' ) && current_user_can( 'edit_pages' ) )
     {
          add_filter( 'mce_buttons', 'twitter_share_register_tinymce_button' );
          add_filter( 'mce_external_plugins', 'twitter_share_add_tinymce_button' );
     }
}

function twitter_share_register_tinymce_button( $buttons )
{
     array_push( $buttons, "button_twitter_icon", "twitter_share_button" );
     return $buttons;
}

function twitter_share_add_tinymce_button( $plugin_array )
{
     $plugin_array['my_button_script'] = plugins_url( '/twitter-share.js', __FILE__ );
     return $plugin_array;
}

function twitter_icon( $atts )
{
    return "<i class='fa fa-twitter' aria-hidden='true' style='color:#15c1e1 !important'></i>";
}
add_shortcode( 'twitter-icon', 'twitter_icon' );



