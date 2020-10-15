<?php
namespace app\classes\theme;

if (!defined('ABSPATH')) {exit;}

class Enqueue {
	// the template directories uri
	static private $TEMPLATE_DIRECTORY_URI = '';

	// file versions, helps with cache busting when developing and in production
	static private $FILES_VERSION = '';

	static private function set_properties () {
		self::$TEMPLATE_DIRECTORY_URI = get_template_directory_uri();

		if (current_user_can('editor') || current_user_can('administrator')) {
			self::$FILES_VERSION = '?v=' . time();
		} else {
			self::$FILES_VERSION = '?v=000000';
		}
	}

	static public function init () {
		self::set_properties();

		add_action('wp_enqueue_scripts', [__NAMESPACE__  . '\Enqueue', 'enqueue_all']);
	}

	static public function enqueue_all () {
		self::enqueue_styles();
		self::enqueue_scripts();
	}

	static public function enqueue_styles () {
		wp_enqueue_style('bt-main', self::$TEMPLATE_DIRECTORY_URI . '/assets/css/style.css' . self::$FILES_VERSION);

		if (is_front_page()) {
			wp_enqueue_style('bt-front-page', self::$TEMPLATE_DIRECTORY_URI . '/assets/css/pages/front-page.css' . self::$FILES_VERSION);
		}
	}

	static public function enqueue_scripts () {
		wp_enqueue_script('bt-main', self::$TEMPLATE_DIRECTORY_URI . '/assets/js/script.js' . self::$FILES_VERSION, ['jquery'], '', true);

		$args = [
			'ajax_nonce' => wp_create_nonce('bt_site_ajax_nonce'),
			'ajaxurl'    => BPATH . '/wp-admin/admin-ajax.php',
			'BPATH'   	 => BPATH,
			'FPATH'   	 => FPATH,
			'CPATH'   	 => CPATH,
			'TINYGIF' 	 => TINYGIF
		];

		wp_localize_script('bt-main', 'system_globals', $args);

		if (is_front_page()) {
			wp_enqueue_script('bt-front-page', self::$TEMPLATE_DIRECTORY_URI . '/assets/js/pages/front-page.js' . self::$FILES_VERSION, ['jquery'], '', true);
		}
	}
}
