<?php if (!defined('ABSPATH')) {exit;}

spl_autoload_register(function ($class) {
	$file = THEME_DIR . $class . '.class.php';

	if (file_exists($file)) {
		require str_replace('\\', '/', $file);
	}
});
