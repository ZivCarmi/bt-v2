<?php
namespace app\classes\theme;

if (!defined('ABSPATH')) {exit;}

class Support {
	static public function init () {
		self::add_theme_support();
	}

	static private function add_theme_support () {
		// add menus support
		add_theme_support('menus');

		// add thumbnails support
		add_theme_support('post-thumbnails');

		// make script and styles tags in html5 format
		add_theme_support('html5', ['script', 'style']);

		// lets the wordpress manage the documnet title
		add_theme_support('title-tag');
		
		// add custom site logo support
		add_theme_support('custom-logo');

		// add support for woocommerce plugin
		if (class_exists('woocommerce')) {
			add_theme_support('woocommerce');
		}
	}
}
