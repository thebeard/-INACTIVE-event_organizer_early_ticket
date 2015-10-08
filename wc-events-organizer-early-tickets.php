<?php
/**
 * Plugin Name: Events Calendar Early Tickets
 * Plugin URI: *
 * Description: Tickets sent after order is set to processing rather than at completed state
 * Author: Theunis Cilliers
 * Author URI: https://github.com/thebeard
 * Version: 1.0.1
 *
 * License: GNU General Public License v3.0
 * License URI: http://www.gnu.org/licenses/gpl-3.0.html
 *
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

define('WC_EVENT_EARLY_TICKETS_PLGN_DIR', plugin_dir_path( __FILE__ ) );


function wc_early_ticket_plugin_activation() {
    add_option( 'wc_early_tickets', array() );
}

function wc_early_ticket_plugin_deactivation() {
    delete_option( 'wc_early_tickets' );
}

register_activation_hook( __FILE__, 'wc_early_ticket_plugin_activation' );
register_deactivation_hook( __FILE__, 'wc_early_ticket_plugin_deactivation' );

add_action('admin_init', 'wc_early_ticket_load_admin_init');
function wc_early_ticket_load_admin_init() {
    register_setting( 'wc_early_tickets', 'wc_early_tickets' );
}

add_action('init', 'wc_early_tickets_make_early');
function wc_early_tickets_make_early() {
	$early_ticket_options = get_option('wc_early_tickets');
	if ( $early_ticket_options['active'] === 'on' ) {
		$event_ticket = new Tribe__Events__Tickets__Woo__Main();
		remove_action( 'woocommerce_order_status_completed', array($event_ticket, 'generate_tickets'), 13 );

		add_action( 'woocommerce_order_status_pending_to_processing_notification', array($event_ticket, 'generate_tickets') );
		add_action( 'woocommerce_order_status_on-hold_to_processing_notification', array($event_ticket, 'generate_tickets') );
		add_action( 'woocommerce_order_status_failed_to_processing_notification', array($event_ticket, 'generate_tickets') );
	}
}

add_action('admin_menu', 'wc_early_ticket_load_admin_menu');
function wc_early_ticket_load_admin_menu() {    
    $page = add_options_page('Early Tickets', 'Early Tickets', 'manage_options', 'wc-early-tickets', 'wc_early_ticket_display_options_page' );
}

function wc_early_ticket_display_options_page() {
	require_once( WC_EVENT_EARLY_TICKETS_PLGN_DIR . 'views/options.php' );
}