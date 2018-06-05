<?php
$project_id      = filter_input( INPUT_GET, 'project_id', FILTER_SANITIZE_NUMBER_INT );
$release_version = filter_input( INPUT_GET, 'version', FILTER_SANITIZE_STRING );
$user_token      = filter_input( INPUT_GET, 'user_token', FILTER_SANITIZE_STRING );

if ( ! empty( $user_token ) ) {
	setcookie( 'tracker_user_token', $user_token, time() + 3600 * 24 * 365 );
}

require( 'includes/Pivotal_Changelog.php' );

if ( empty( $user_token ) ) {
	$user_token = Pivotal_Changelog::get_token();
}

if ( empty( $project_id ) || empty( $release_version ) ) :
	if ( empty( $user_token ) ) {
		include( 'get-token.php' );
	} else {
		include( 'project.php' );
	}
else :
	$changelog = new Pivotal_Changelog( $project_id, $release_version );
	include( 'changelog.php' );
endif;