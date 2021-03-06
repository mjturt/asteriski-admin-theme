<?php
/**
 * Plugin Name: WP Asteriski admin theme
 * Plugin URI: https://asteriski.fi
 * Description: Hallintapaneelin ulkoasua hieman Asteriskimmaksi
 * Version: 1.1
 * Author: Maks Turtiainen, Asteriski ry
 * Author URI: https://github.com/asteriskiry
 * License: GPLv2
 **/

/*
Original CSS/SCSS-files published with GPLv2 by Kelly Dwan, Mel Choyce, Dave Whitley, Kate Whitley
Changes by Maks Turtiainen 
*/

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/* Korvataan kulmassa oleva Wordpressin logo Asteriskin logolla */

function asteriski_custom_logo() {
    echo '
    <style type="text/css">
        #wpadminbar #wp-admin-bar-wp-logo > .ab-item .ab-icon:before { 
        background: url(' . plugins_url( 'img/admin-logo-asteriski.svg', __FILE__  ) . ') no-repeat scroll 0 0 / 100% auto !important; 
        color: transparent;
        }   
        #wpadminbar #wp-admin-bar-wp-logo.hover > .ab-item .ab-icon {
        background-position: 0 0;
        }   
    </style>
    ';
}

add_action('wp_before_admin_bar_render', 'asteriski_custom_logo'); 

/* Väriteeman lataus */

$colors = array(
    'asteriski',
);

function add_colors() {
    wp_admin_css_color(
        'asteriski', __( 'Asteriski', 'admin_schemes' ),
        plugins_url( "asteriski/colors.css", __FILE__ ),
        array( '#17411e', '#c19a12', '#d66621', '#348d42' ),
        array( 'base' => '#17411e', 'focus' => '#c19a12', 'current' => '#d66621' )
    );
}
add_action( 'admin_init', 'add_colors' );

/* Asettaa Asteriskin admin teeman oletusteemaksi */

function set_default_admin_color($user_id) {
$args = array(
            'ID' => $user_id,
                    'admin_color' => 'asteriski'
                        
                );  
    wp_update_user( $args  );
}
add_action('user_register', 'set_default_admin_color');

/* Login-sivun logo */

function asteriski_custom_login_logo() {
echo '
<style type=text/css>
    body.login div#login h1 a {
        background-image: url(' . plugins_url( 'img/login-asteriski.png', __FILE__  ) . ');
        padding-bottom: 20px;
    }
</style>
';
}
add_action( 'login_enqueue_scripts', 'asteriski_custom_login_logo' );
