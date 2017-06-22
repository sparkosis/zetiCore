<?php

/*
 * This file is part of the Simple-PHP-Router package.
 *
 * (c) Stein Janssen <birdmage@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zeti\Framework\Interfaces;

/**
 * Router interface
 */
interface RouterInterface
{
	/**
	 * Add a route to the router
	 *
	 * @param string $url
	 * @param string $method
	 * @param string $action
	 */
	public function add($url, $method, $action);

	/**
	 * Get all routes
	 *
	 * @return array
	 */
	public function getAllRoutes();

	/**
	 * Get routes by method
	 *
	 * @param  string $method
	 *
	 * @return array
	 */
	public function getRoutesByMethod($method);
}
