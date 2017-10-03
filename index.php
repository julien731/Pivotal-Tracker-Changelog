<?php
use rmrevin\pivotal\API;
use rmrevin\pivotal\Client;
use rmrevin\pivotal\ErrorResponse;
use rmrevin\pivotal\transports\CurlTransport;
use Michelf\Markdown;

$project_id = filter_input( INPUT_GET, 'project_id', FILTER_SANITIZE_NUMBER_INT );
$release_version = filter_input( INPUT_GET, 'version', FILTER_SANITIZE_STRING );

if ( empty( $project_id) || empty( $release_version ) ) : ?>

	<form method="get" action="#">
		<label for="project_id">
			Project ID
			<input type="text" id="project_id" name="project_id">
		</label>
		<label for="version">
			Version
			<input type="text" id="version" name="version">
		</label>
		<input type="submit" value="Get Changelog">
	</form>

<?php else :

	require( 'vendor/autoload.php' );

	$defaultToken = file_exists(__DIR__ . '/.token')
		? file_get_contents(__DIR__ . '/.token')
		: null;

	$token = empty($token) ? $defaultToken : $token;

	if (empty($token)) {
		throw new \RuntimeException('Empty api token');
	}

	$Client = new Client([
		'apiToken' => $token,
	]);

	$Transport = new CurlTransport;
	//or $Transport = new GuzzleTransport;

	$Api = new API($Client, $Transport);

	$Response = $Api->projects()->stories()->getList( $project_id, array( 'with_label' => "@$release_version" ) );

	if ($Response instanceof ErrorResponse) {
		print_r($Response->_exception);
	} else {

		echo '<ul>';
		foreach ( $Response->getData() as $story ) {

			printf( '<li><strong>%1$s:</strong> <a href="%3$s" target="_blank">%2$s</a></li>', strtoupper( $story['kind'] ), $story['name'], $story['url'] );

		}
		echo '</ul>';

	}

	endif;