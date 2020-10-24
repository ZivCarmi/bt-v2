<?php
namespace app\classes\helpers;

if (!defined('ABSPATH')) {exit;}

class Helper {
	// very basic php debugger tool
	static public function _ ($value, $result_output_as = 'print', $die = false) {
		echo '<div dir="ltr"><pre>';

		switch (strtolower($result_output_as)) {
			case 'print':
				print_r($value);

				break;
			case 'dump':
				var_dump($value);

				break;
			case 'export':
				var_export($value);

				break;
			default:
				print_r($value);

				break;
		}

		echo '</pre></div>';

		if ($die) {
			die;
		}
	}

	// basic php error loger using print_r
	static public function el ($value) {
		$ds = DIRECTORY_SEPARATOR;

		error_log(print_r($value, true), 3, BDIR . "{$ds}log{$ds}log.txt");
		error_log("\r\n\r\n", 3, BDIR . "{$ds}log{$ds}log.txt");
	}

	// javascript debugging tool
	static public function console_log ($value) {
		echo '<script>var helper_output = ' . json_encode($value) . ';console.log(helper_output);</script>';
	}

	// javascript debugging tool
	static public function alert ($value) {
		echo '<script>var helper_output = ' . json_encode($value) . ';alert(helper_output);</script>';
	}

	// get the image alt text
	static public function get_image_alt (&$image) {
		$image_alt = get_post_meta($image->ID);

		if (!empty($image_alt) && is_array($image_alt)) {
			$image->alt = $image_alt;

			if (isset($image_alt['_wp_attachment_image_alt']) && !empty($image_alt['_wp_attachment_image_alt'])) {
				if (is_array($image_alt['_wp_attachment_image_alt'])) {
					$image->alt = esc_attr($image_alt['_wp_attachment_image_alt'][0]);
				} else {
					$image->alt = esc_attr($image_alt['_wp_attachment_image_alt']);
				}
			} else {
				$image->alt = '';
			}
		} else {
			$image->alt = '';
		}
	}

	// get the image by id
	static public function get_image ($image_id, $size, &$image_data) {
		$image = new \stdClass();

		$image_src = wp_get_attachment_image_src($image_id, $size);

		if (!empty($image_src) && is_array($image_src)) {
			$image->exists = true;

			$image->ID = $image_id;

			$image->src = $image_src[0];

			self::get_image_alt($image);
		} else {
			$image->exists = false;
		}

		$image_data = $image;
	}
}
