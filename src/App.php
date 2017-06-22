<?php
namespace Zeti\Framework;
use Zeti\Framework\Exceptions\InvalidArgumentException;
use Zeti\Framework\Exceptions\RouteNotFoundException;
use Zeti\Framework\RouteResolver;
class App extends Router {
    public function run(){
        /**
         * After all the routes are created the resolver must be initialized
         */
        $resolver = new RouteResolver($this);

        /**
         * resolve the route and receive the response
         */
        try {
            // You have to resolve the route inside the try block
            $resolver->resolve([
                'uri' => $_SERVER['REQUEST_URI'],
                'method' => $_SERVER['REQUEST_METHOD'],
            ]);
        } catch (RouteNotFoundException $e) {
            // route not found, add a nice 404 page here if you like
            die($e->getMessage());
        } catch (InvalidArgumentException $e) {
            // when an arguments of a route is missing an InvalidArgumentException will be thrown
            // it is not necessary to catch this exception as this exception should never occur in production
            die($e->getMessage());
        }

    }
}