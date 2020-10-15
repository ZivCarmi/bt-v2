<?php
namespace app\classes\theme;

if (!defined('ABSPATH')) {exit;}

class Headers {
	static public function init () {
		add_action('send_headers', [__NAMESPACE__  . '\Headers', 'add_headers']);
	}

	static public function add_headers () {
		header('x-Powered-By: bt');
		header('server: bt');
	}
}
