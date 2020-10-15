<?php
namespace app\classes\plugins\woocommerce;

if (!defined('ABSPATH')) {exit;}

class Actions {
	static public function init () {
		// dequeue default woocommerce styles
		add_action( 'wp_enqueue_scripts', [__NAMESPACE__  . '\Actions', 'bt_dequeue_woocommerce_styles'] );
	}
	
	static public function bt_dequeue_woocommerce_styles () {
		if (TRUE) {
			wp_dequeue_style('wc-block-style');
		}
	}
}
