<?php
namespace app\classes\theme;

if (!defined('ABSPATH')) {exit;}

class Ajax {
	static public function init () {
		add_action('wp_ajax_bt_test', [__NAMESPACE__  . '\Ajax', 'bt_test']);
		add_action('wp_ajax_nopriv_bt_test', [__NAMESPACE__  . '\Ajax', 'bt_test']);
	}

	static public function bt_test () {
		// basic AJAX request
		/*
		jQuery.ajax({
			url: system_globals.ajaxurl,
			method: 'POST',
			data: {
				action: 'bt_test',
				security: system_globals.ajax_nonce,
			},
			success: function (response) {

			}
		});
		*/
		
		check_ajax_referer('bt_site_ajax_nonce', 'security');
		
		echo 1;
		die;
	}
}
