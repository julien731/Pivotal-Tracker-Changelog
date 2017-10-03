<?php
$project_id      = filter_input( INPUT_GET, 'project_id', FILTER_SANITIZE_NUMBER_INT );
$release_version = filter_input( INPUT_GET, 'version', FILTER_SANITIZE_STRING );

if ( empty( $project_id ) || empty( $release_version ) ) :
	include( 'project.php' );
else :
	require( 'includes/Pivotal_Changelog.php' );
	$changelog = new Pivotal_Changelog( $project_id, $release_version );
	include( 'changelog.php' );
endif;