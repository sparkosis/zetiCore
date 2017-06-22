<?php

/*
 * This file is part of the Simple-PHP-Router package.
 *
 * (c) Stein Janssen <birdmage@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zeti\Framework;

use Zeti\Framework\Interfaces\RouterInterface;
use Zeti\Framework\RouteFactory;

/**
 * Simple routing collection class
 *
 * @implements RouterInterface
 */
class Router implements RouterInterface
{
	/**
	 * Route factory
	 *
	 * @var RouteFactory
	 */
	private $factory;

	/**
	 * Default namespace
	 *
	 * @var string
	 */
	private $namespace;

	/**
	 * An array with all the registerd routes
	 *
	 * @var array
	 */
	private $routes = array();

	/**
	 * an array with all routes by method
	 *
	 * @var array
	 */
	private $routesByMethod = array();

	/**
	 * Router constructor
	 */
	public function __construct($namespace = '')
	{
		$this->factory = new RouteFactory();
		$this->namespace = $namespace;
	}

	/**
	 * Add a route with get method
	 *
	 * @param  string $url
	 * @param  mixed  $action
	 * 
	 * @return void
	 */
	public function get($url, $action)
	{
		$this->add($url, 'GET', $action);
	}

	/**
	 * Add a route with post method
	 *
	 * @param  string $url
	 * @param  mixed  $action
	 * 
	 * @return void
	 */
	public function post($url, $action)
	{
		$this->add($url, 'POST', $action);
	}

	/**
	 * Add a route with put method
	 *
	 * @param  string $url
	 * @param  mixed  $action
	 * 
	 * @return void
	 */
	public function put($url, $action)
	{
		$this->add($url, 'PUT', $action);
	}

	/**
	 * Add a route with patch method
	 *
	 * @param  string $url
	 * @param  mixed  $action
	 * 
	 * @return void
	 */
	public function patch($url, $action)
	{
		$this->add($url, 'PATCH', $action);
	}

	/**
	 * Add a route with delete method
	 *
	 * @param  string $url
	 * @param  mixed  $action
	 * 
	 * @return void
	 */
	public function delete($url, $action)
	{
		$this->add($url, 'DELETE', $action);
	}

	/**
	 * Add a route for all posible methods
	 *
	 * @param  string $url
	 * @param  mixed  $action
	 *
	 * @return void
	 */
	public function any($url, $action)
	{
		$this->add($url, 'GET|POST|PUT|PATCH|DELETE', $action);
	}

	/**
	 * Add new route to routes array
	 *
	 * @param  string $url
	 * @param  string $method
	 * @param  mixed  $action
	 *
	 * @return void
	 */
	public function add($url, $method, $action)
	{	
		$route = $this->factory->create($url, $method, $action);
		$route->setNamespace($this->namespace);

		$this->routes[] = $route;

		foreach ($route->getMethod() as $method) {
			$this->routesByMethod[$method][] = $route;
		}
	}

	/**
	 * Set namespace
	 *
	 * @param string $namespace
	 */
	public function setNamespace($namespace)
	{
		$this->namespace = $namespace;
	}

	/**
	 * Get routes by method
	 *
	 * @param  string $method
	 *
	 * @return array
	 */
	public function getRoutesByMethod($method)
	{
		return ($this->routesByMethod && isset($this->routesByMethod[$method])) ? $this->routesByMethod[$method] : array();
	}

	/**
	 * Get all routes
	 *
	 * @return array
	 */
	public function getAllRoutes()
	{
		return $this->routes;
	}
}
