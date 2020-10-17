<?php
namespace app\classes\plugins\woocommerce;

if (!defined('ABSPATH')) {exit;}

class Actions {
	static public function init () {
		// dequeue default woocommerce styles/scripts
		add_action('wp_enqueue_scripts', [__NAMESPACE__  . '\Actions', 'bt_dequeue_woocommerce_styles']);
		add_action('wp_enqueue_scripts', [__NAMESPACE__  . '\Actions', 'bt_dequeue_woocommerce_scripts']);
	}
	
	static public function bt_dequeue_woocommerce_styles () {
		if (!is_admin()) {
			wp_dequeue_style('wc-block-style');
		}
	}
	
	static public function bt_dequeue_woocommerce_scripts () {
		if (!is_admin()) {
			wp_dequeue_script('jquery-blockui');
			wp_dequeue_script('wc-add-to-cart');
			wp_dequeue_script('js-cookie');
			wp_dequeue_script('woocommerce');
			wp_dequeue_script('wc-cart-fragments');
		}
	}
}
