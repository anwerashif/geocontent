<?php
/**
 * Plugin Name: GeoContent
 * Description: This plugin is developed for makemoneycrew.com
 * Version: 1.0.0
 * Text Domain: geo_content
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Function to change post visibility
 * 
 * @return $post
 */
function my_pre_get_posts( $query ) {

    $geoip  = geoip_detect2_get_info_from_current_ip();
    $name   = $geoip->raw['country']['names']['en'];
    $myterm = get_term_by('name', $name, 'category');

    if( $name == $myterm->name  ){
        $cat_id = $myterm->term_id;
    }

    if( !is_admin() && !current_user_can('administrator') ){

        if( isset($query->query_vars['post_type']) && $query->query_vars['post_type'] == 'post' ) {
            $query->set( 'cat', $cat_id );
        }
	
	// Exclude Nav Menu
	/* if ($query->get('post_type') == 'nav_menu_item') {
            return $query;
        } else {
            $query->set( 'cat', $cat_id );
        } */

    } else {
        //one of the conditions failed - So do nothing new
        return $query;
    }
	
	// return
	return $query;

}

add_action('pre_get_posts', 'my_pre_get_posts');
