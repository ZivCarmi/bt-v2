<?php
namespace app\classes\plugins\woocommerce;

if (!defined('ABSPATH')) {exit;}

class Filters {
	static public function init () {
		// dequeue default woocommerce styles
		add_filter('woocommerce_enqueue_styles', [__NAMESPACE__  . '\Filters', 'bt_dequeue_woocommerce_styles']);
	}

	static public function bt_dequeue_woocommerce_styles ($enqueued_styles) {
		if (!is_admin()) {
			unset($enqueued_styles['woocommerce-general']);
			unset($enqueued_styles['woocommerce-layout']);
			unset($enqueued_styles['woocommerce-smallscreen']);
		}

		return $enqueued_styles;
	}
}
