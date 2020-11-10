<?php
namespace app\classes;

if (!defined('ABSPATH')) {exit;}

class Master {
	const NAMESPACE_PREFIX = __NAMESPACE__ . '\\';

	const THEME_PREFIX = self::NAMESPACE_PREFIX . 'theme\\';

	const PLUGINS_PREFIX = [
		'acf' 	      => self::NAMESPACE_PREFIX . 'plugins\\acf\\',
		'woocommerce' => self::NAMESPACE_PREFIX . 'plugins\\woocommerce\\'
	];

	static public function init () {
		$classes = [
			// core
			self::THEME_PREFIX . 'Headers',
			self::THEME_PREFIX . 'Enqueue',
			self::THEME_PREFIX . 'Updates',
			self::THEME_PREFIX . 'Support',
			self::THEME_PREFIX . 'Register',
			self::THEME_PREFIX . 'RemoveCoreFeatures',
			
			// optional (uncomment only when using)
			//self::THEME_PREFIX . 'Pixels',
			//self::THEME_PREFIX . 'Ajax',
			//self::THEME_PREFIX . 'Actions',
			//self::THEME_PREFIX . 'Filters',
		];

		if (class_exists('ACF')) {
			$classes[] = self::PLUGINS_PREFIX['acf'] . 'OptionPages';
		}

		if (class_exists('woocommerce')) {
			$classes[] = self::PLUGINS_PREFIX['woocommerce'] . 'Actions';
			$classes[] = self::PLUGINS_PREFIX['woocommerce'] . 'Filters';
			$classes[] = self::PLUGINS_PREFIX['woocommerce'] . 'Templates';
		}

		foreach ($classes as $class) {
			($class . '::init')();
		}
	}
}
