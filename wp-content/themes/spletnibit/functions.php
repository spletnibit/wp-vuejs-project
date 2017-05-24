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

	if(! count($error) && mail('info@spletnibit.si', 'Nov kontakt', $text)) {
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