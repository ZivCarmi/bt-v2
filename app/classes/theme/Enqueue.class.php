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
		
		// self::bt_load_styles_inline();
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
	
	static private function bt_load_styles_inline () {
		global $wp_styles;
		
		$queue_styles = $wp_styles->queue;
		
		ob_start();
		
		foreach ($queue_styles as $style_handle) {
			$file = $wp_styles->registered[$style_handle]->src;
			
			if (strpos($file, BPATH . '/wp-content/themes/bt/') !== false) {
				$file = str_replace(self::$FILES_VERSION, '', $file);
				
				if (file_exists($file)) {
					wp_dequeue_style($style_handle);
					
					include $file;
				} else {
					$file = str_replace(BPATH . '/wp-content/themes/bt/', THEME_DIR, $file);
					$file = str_replace(self::$FILES_VERSION, '', $file);
					
					if (file_exists($file)) {
						wp_dequeue_style($style_handle);
						
						include $file;
					}
				}
			}
		}
		
		$files_content = ob_get_contents();

		ob_end_clean();

		if (!empty($files_content)) {
			$files_content = preg_replace('/\s*(?!<\")\/\*[^\*]+\*\/(?!\")\s*/', '', $files_content);
			$files_content = preg_replace("/\s{2,}/", ' ', $files_content);
			$files_content = str_replace("\n", '', $files_content);
			$files_content = str_replace(', ', ',', $files_content);
			
			self::$minified_css = '<style>' . $files_content . '</style>';
		}
		
		add_action('bt_html_head_end', function(){
			echo self::$minified_css;
		});
	}
}
