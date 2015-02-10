<?php

/**
 * This file is part of the Router package.
 *
 * @package Router
 * @since   2015
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Router;

/**
 * RouteMatcher
 *
 * @author Elliot Wright
 */
class RouteMatcher implements RouteMatcherInterface
{
    /**
     * {@inheritDoc}
     */
    public function match($method, $url, $routes)
    {
        $parsed = parse_url($url);
        $path = $parsed['path'];

        $matched = null;
        /* @var Route[] $routes */
        foreach ($routes as $route) {
            $compiled = $this->compileRoute($route);

            if (!preg_match($compiled['regexp'], $path, $variables)) {
                continue;
            }

            if (!$route->hasTargetForMethod($method)) {
                continue;
            }

            array_shift($variables);

            $matched = [
                'method'     => $method,
                'name'       => $route->getName(),
                'parameters' => $variables,
                'target'     => $route->getTargetForMethod($method),
            ];

            break;
        }

        return $matched;
    }

    /**
     * {@inheritDoc}
     */
    protected function compileRoute(Route $route)
    {
        $parameters = $this->processPathParameters($route->getPath());
        $regexp = $route->getPath();

        foreach ($parameters as $parameter) {
            if (substr_count($route->getPath(), '{'.$parameter.'}') > 1) {
                throw new \RuntimeException(sprintf(
                    'Route name "%s" cannot reference variable "%s" more than once.',
                    $route->getName(),
                    $parameter
                ));
            }

            $regexp = str_replace(
                '{' . $parameter . '}',
                '(?<' . $parameter . '>[A-z0-9_-]+)',
                $regexp
            );
        }

        $regexp = "#$regexp#";

        return [
            'parameters' => $parameters,
            'regexp' => $regexp,
        ];
    }

    /**
     * Get tokens for given route path
     *
     * @param string $path
     *
     * @return array
     */
    protected function processPathParameters($path)
    {
        preg_match_all('#{(\w+)}#', $path, $matches);

        return $matches[1];
    }
}
