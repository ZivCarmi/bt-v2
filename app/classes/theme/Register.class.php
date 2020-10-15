<?php
namespace app\classes\theme;

if (!defined('ABSPATH')) {exit;}

class Register {
	static public function init () {
		add_action('init', [__NAMESPACE__  . '\Register', 'register_menus']);
	}

	static public function register_menus () {
		if (CURRENT_LANG === 'he_IL') {
			$args = [
				'main-site-menu'        => esc_html__('תפריט עליון HEADER', 'bt'),
				'main-site-footer-menu' => esc_html__('תפריט תחתון FOOTER', 'bt')
			];
		} else {
			$args = [
				'main-site-menu'        => esc_html__('Header menu', 'bt'),
				'main-site-footer-menu' => esc_html__('Footer menu', 'bt')
			];
		}

		register_nav_menus($args);
	}
}
