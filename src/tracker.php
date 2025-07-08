<?php

namespace LinkTracker;

class Tracker
{
	/**
	 * Builds a URL with query parameters.
	 *
	 * @param string $baseurl The base URL to which parameters will be appended.
	 * @param array $params An associative array of query parameters.
	 * @return string The complete URL with query parameters.
	 */
	public static function buildlink(string $baseurl, array $params = []): string
	{
		return $baseurl . '?' . http_build_query($params);
	}
}
