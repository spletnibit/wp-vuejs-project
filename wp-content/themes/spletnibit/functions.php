<?php
if ( ! function_exists( 'wp_handle_upload' ) ) {
	require_once( ABSPATH . 'wp-admin/includes/file.php' );
}
// Enable the option show in rest
add_filter( 'acf/rest_api/field_settings/show_in_rest', '__return_true' );

function sendContact() {
	$error = [];

	$params = ['name', 'tel', 'email', 'msg'];
	$text = "";
	foreach ($params as $param) {
		if ($field = trim(esc_sql($_POST[$param]))) {
			$text .= "$param: $field\n";
		} else {
			$error[] = $param;
		}
	}

	$attachment = null;
	if (!empty($_FILES["file"]))  {
		require_once( ABSPATH . 'wp-admin/includes/image.php' );
		require_once( ABSPATH . 'wp-admin/includes/file.php' );
		require_once( ABSPATH . 'wp-admin/includes/media.php' );
		$file = $_FILES['file'];

		$attachment = wp_handle_upload($file, ['test_form' => false] );

	}

	if(! count($error) && wp_mail('info@spletnibit.si', 'Nov kontakt', $text, '', $attachment)) {
		echo 'OK';
	}
	else {
		wp_send_json_error( $error, 400);
	}

	die();
}

add_action( 'rest_api_init', function () {
	register_rest_route( 'spletnibit/v1', '/contact/', array(
		'methods' => 'POST',
		'callback' => 'sendContact',
	) );
} );

function disable_wp_emojicons() {

	// all actions related to emojis
	remove_action( 'admin_print_styles', 'print_emoji_styles' );
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
	remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
	remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
}
add_action( 'init', 'disable_wp_emojicons' );
add_filter( 'emoji_svg_url', '__return_false' );

add_filter( 'rest_endpoints', function( $endpoints ){

	$allowedRoutes = [
		'/spletnibit/v1/contact',
		'/wp/v2/projekti',
		'/wp/v2/reference',
		'/wp/v2/reference/(?P<id>[\d]+)'
	];
//	var_dump(array_keys($endpoints));die;

	foreach ($endpoints as $route => $arr) {
		if (! in_array($route, $allowedRoutes)) unset($endpoints[$route]);
	}

	return $endpoints;
});

// Disable use XML-RPC
add_filter( 'xmlrpc_enabled', '__return_false' );

// Disable X-Pingback to header
add_filter( 'wp_headers', 'disable_x_pingback' );
function disable_x_pingback( $headers ) {
	unset( $headers['X-Pingback'] );

	return $headers;
}