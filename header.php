<?php if (!defined('ABSPATH')) {exit;} ?><!doctype html>
<html <?php language_attributes(); ?>>
	<head>
		<?php do_action('bt_html_head_start'); ?>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="icon" href="data:,">
		<?php
		wp_head();
		
		do_action('bt_html_head_end');
		?>
	</head>
	<body <?php body_class(); ?>>
		<?php do_action('bt_html_body_start'); ?>
