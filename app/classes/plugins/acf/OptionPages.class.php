<?php
namespace app\classes\plugins\acf;

if (!defined('ABSPATH')) {exit;}

class OptionPages {
	static public function init () {
		self::create_option_pages();
	}
	
	static public function create_option_pages () {
		if (function_exists('acf_add_options_page')) {
			if (CURRENT_LANG === 'he_IL') {
				$titles = [
					'parent'  => esc_html__('הגדרות כלליות לתבנית', 'bt'),
					'header'  => esc_html__('הגדרות HEADER לתבנית', 'bt'),
					'footer'  => esc_html__('הגדרות FOOTER לתבנית', 'bt'),
					'contact' => esc_html__('הגדרות יצירת קשר לתבנית', 'bt'),
					'social'  => esc_html__('הגדרות מדיה חברתית לתבנית', 'bt'),
				];
			} else {
				$titles = [
					'parent'  => esc_html__('General theme options', 'bt'),
					'header'  => esc_html__('Header theme options', 'bt'),
					'footer'  => esc_html__('Footer theme options', 'bt'),
					'contact' => esc_html__('Contact theme options', 'bt'),
					'social'  => esc_html__('Social media theme options', 'bt'),
				];
			}
			
			$parent = acf_add_options_page([
				'page_title' 	=> $titles['parent'],
				'menu_title'	=> $titles['parent'],
				'menu_slug' 	=> 'general',
				'capability'	=> 'edit_posts',
				'icon_url' 		=> 'dashicons-admin-settings',
				'redirect'		=> false,
			]);
			
			$pages = [
				'header',
				'footer',
				'contact',
				'social',
			];

			foreach ($pages as $page) {
				acf_add_options_sub_page([
					'page_title' 	=> $titles[$page],
					'menu_title'	=> $titles[$page],
					'menu_slug' 	=> $page,
					'parent_slug' 	=> $parent['menu_slug'],
				]);
			}
		}
	}
}
