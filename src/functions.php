<?php

namespace LinkTracker\Utils;
use LinkTracker\Tracker;
use function NewfoldLabs\WP\ModuleLoader\container as getContainer;

/**
 * Build a link with default parameters for tracking.
 *
 * @param string $url The URL to build the link for.
 * @param array  $params Additional parameters to include in the link.
 * @return string The built URL with tracking parameters.
 */
function buildlink( string $url, array $params = []): string
{
	$container = getContainer();
	// Check if source is passed in params.
	if ( !empty( $params['source'] ) ) {
		$source = $params['source'];
		unset( $params['source'] );
	} else {
		$source = 'no_source';
	}
	$defaultParams = [
		'channelid'   => strpos($url, 'wp-admin') !== false ? 'P99C100S1N0B3003A151D115E0000V111' : 'P99C100S1N0B3003A151D115E0000V112',
		'utm_medium'   => $container->plugin()->get( 'id', 'bluehost' ).'_plugin',
		'utm_campaign' => 'link_tracker',
		'utm_source'   => $_SERVER['PHP_SELF'] ? $_SERVER['PHP_SELF'].'?'. $source  : $source,
	];
	$params = array_merge( $defaultParams, $params );
	$tracker = new Tracker( $container );
	$url = $tracker->BuildLink( $url, $params );
	return esc_url( $url );
}