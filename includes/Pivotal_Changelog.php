<?php

use rmrevin\pivotal\API;
use rmrevin\pivotal\Client;
use rmrevin\pivotal\ErrorResponse;
use rmrevin\pivotal\transports\CurlTransport;

/**
 * @package   Pivotal Changelog
 * @author    Julien Liabeuf <julien@liabeuf.fr>
 * @license   GPL-2.0+
 * @link      https://julienliabeuf.com
 * @copyright 2017 Julien Liabeuf
 */
class Pivotal_Changelog {

	/**
	 * Project ID in Pivotal Tracker.
	 *
	 * @var int
	 */
	public $project_id;

	/**
	 * Release version for which to retrieve the changelog.
	 *
	 * @var string
	 */
	public $version;

	/**
	 * User API key for Pivotal Tracker.
	 *
	 * @var string
	 */
	protected $api_key;

	/**
	 * Holds the user stories.
	 *
	 * @var array
	 */
	protected $stories;

	/**
	 * Holds the version release date.
	 *
	 * @var string
	 */
	public $release_date;

	public function __construct( $project_id, $version ) {
		$this->project_id = (int) $project_id;
		$this->version    = trim( $version );
		$this->set_api_key();

		// Load the Composer dependencies.
		require( 'vendor/autoload.php' );

		// Get stories now to "cache" them and get all data available upfront.
		$this->get_stories();
	}

	/**
	 * Get the project version.
	 *
	 * @return string
	 */
	public function get_version() {
		return $this->version;
	}

	/**
	 * Get the release date.
	 *
	 * @return string
	 */
	public function get_release_date() {
		return $this->release_date;
	}

	/**
	 * Retrieve the user API key from the .token file.
	 *
	 * @return void
	 */
	public function set_api_key() {
		// Get the user token.
		$token_filepath = $_SERVER['DOCUMENT_ROOT'] . '/.token';
		$this->api_key  = file_exists( $token_filepath ) ? file_get_contents( $token_filepath ) : null;

		if ( empty( $this->api_key ) ) {
			die( 'API key missing' );
		}
	}

	/**
	 * Get an instance of the client.
	 *
	 * @return rmrevin\pivotal\API
	 */
	private function get_client() {
		$Client = new Client( [
			'apiToken' => $this->api_key,
		] );

		$Transport = new CurlTransport;

		return new API( $Client, $Transport );

	}

	/**
	 * Get the project details.
	 *
	 * @return array
	 */
	public function get_project() {

		$result   = array( 'success' => true, 'data' => array() );
		$response = $this->get_client()->projects()->getById( $this->project_id );

		if ( $response instanceof ErrorResponse ) {
			$result['success'] = false;
		} else {
			$result['data'] = $response->getData();
		}

		return $result;

	}

	/**
	 * List the user stories for the given version.
	 *
	 * @return array
	 */
	public function get_stories() {

		if ( null !== $this->stories ) {
			return $this->stories;
		}

		$result   = array( 'success' => true, 'data' => array() );
		$response = $this->get_client()->projects()->stories()->getList( $this->project_id, array( 'with_label' => "@$this->version" ), 50 );

		if ( $response instanceof ErrorResponse ) {
			$result['success'] = false;
		} else {
			$result['data'] = $this->filter_stories( $response->getData() );
		}

		return $result;
	}

	/**
	 * Filter the user stories and extract the project-specific ones.
	 *
	 * @param $stories array The list of user stories.
	 *
	 * @return array
	 */
	protected function filter_stories( $stories ) {

		$clean_stories = array();

		foreach ( $stories as $story ) {

			// Get the release date and ignore release story.
			if ( 'Release - ' . $this->get_version() === $story['name'] ) {
				$this->release_date = isset( $story['accepted_at'] ) ? $story['accepted_at'] : '';
				continue;
			}

			// Do not include stories that haven't been accepted.
			// It can easily add improperly tagged stories that don't belong to the release.
			if ( 'accepted' !== $story['current_state'] ) {
				continue;
			}

			$clean_stories[] = $story;

		}

		return $clean_stories;
	}

}