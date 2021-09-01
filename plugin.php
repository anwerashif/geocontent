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

    if(!is_admin() && !current_user_can('administrator')){

        // if( isset($query->query_vars['post_type']) && $query->query_vars['post_type'] == 'post' ) {
            // $query->set( 'cat', $cat_id );
        // }

        if ($query->get('post_type') == 'nav_menu_item') {
            return $query;
        } else {
            $query->set( 'cat', $cat_id );
        }

    } else {
        //one of the conditions failed - So do nothing new
        return $query;
    }
	
	// return
	return $query;

}

add_action('pre_get_posts', 'my_pre_get_posts');

/* 
* Redirecting based on user country United States
*/
function redirect_page_en() {

    $geoip = geoip_detect2_get_info_from_current_ip();
    $name = $geoip->raw['country']['names']['en'];

    if( !is_user_logged_in() && $name == "United States" && strpos($_SERVER['REQUEST_URI'], "en") == false ) {

        // unset cookies
        if (isset($_SERVER['HTTP_COOKIE'])) {
            $cookies = explode(';', $_SERVER['HTTP_COOKIE']);
            foreach($cookies as $cookie) {
                $parts = explode('=', $cookie);
                $name = trim($parts[0]);
                setcookie($name, '', time()-1000);
                setcookie($name, '', time()-1000, '/');
            }
        }

        // split this URI by '/'
        $uriParts = explode('/', $_SERVER['REQUEST_URI']);

        // get all values after 'en'
        $uriPartsWithoutLang = array_slice($uriParts, 2);

        // prefix the new URI with 'ru' and 
        // concatinate the remaining array values with '/' again
        $newUri = '/en/' . implode('/', $uriPartsWithoutLang);

        // print out the link
        $furl = site_url($newUri);

        if(!is_admin() && !current_user_can('administrator')){
            // wp_redirect( $furl );
            wp_safe_redirect( $furl );
            exit;
        }

    }

}

add_action( 'template_redirect', 'redirect_page_en' );

/* 
* Redirecting based on user country France
*/
function redirect_page_fr() {

    $geoip = geoip_detect2_get_info_from_current_ip();
    $name = $geoip->raw['country']['names']['en'];

    if( !is_user_logged_in() && $name == "France" && strpos($_SERVER['REQUEST_URI'], "fr") == false ) {

        // unset cookies
        if (isset($_SERVER['HTTP_COOKIE'])) {
            $cookies = explode(';', $_SERVER['HTTP_COOKIE']);
            foreach($cookies as $cookie) {
                $parts = explode('=', $cookie);
                $name = trim($parts[0]);
                setcookie($name, '', time()-1000);
                setcookie($name, '', time()-1000, '/');
            }
        }

        // split this URI by '/'
        $uriParts = explode('/', $_SERVER['REQUEST_URI']);

        // get all values after 'en'
        $uriPartsWithoutLang = array_slice($uriParts, 2);

        // prefix the new URI with 'ru' and 
        // concatinate the remaining array values with '/' again
        $newUri = '/fr/' . implode('/', $uriPartsWithoutLang);

        // print out the link
        $furl = site_url($newUri);

        if(!is_admin() && !current_user_can('administrator')){
            // wp_redirect( $furl );
            wp_safe_redirect( $furl );
            exit;
        }

    }

}

add_action( 'template_redirect', 'redirect_page_fr' );

/* 
* Redirecting based on user country Bangladesh
*/
function redirect_page_bn() {

    $geoip = geoip_detect2_get_info_from_current_ip();
    $name = $geoip->raw['country']['names']['en'];

    if( !is_user_logged_in() && $name == "Bangladesh" && strpos($_SERVER['REQUEST_URI'], "bn") == false ) {

        // unset cookies
        if (isset($_SERVER['HTTP_COOKIE'])) {
            $cookies = explode(';', $_SERVER['HTTP_COOKIE']);
            foreach($cookies as $cookie) {
                $parts = explode('=', $cookie);
                $name = trim($parts[0]);
                setcookie($name, '', time()-1000);
                setcookie($name, '', time()-1000, '/');
            }
        }

        // split this URI by '/'
        $uriParts = explode('/', $_SERVER['REQUEST_URI']);

        // get all values after 'en'
        $uriPartsWithoutLang = array_slice($uriParts, 2);

        // prefix the new URI with 'ru' and 
        // concatinate the remaining array values with '/' again
        $newUri = '/bn/' . implode('/', $uriPartsWithoutLang);

        // print out the link
        $furl = site_url($newUri);

        if(!is_admin() && !current_user_can('administrator')){
            // wp_redirect( $furl );
            wp_safe_redirect( $furl );
            exit;
        }

    }

}

add_action( 'template_redirect', 'redirect_page_bn' );
