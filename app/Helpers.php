<?php

/*
|--------------------------------------------------------------------------
| Detect Active Route
|--------------------------------------------------------------------------
|
| Compare given route with current route and return output if they match.
| Very useful for navigation, marking if the link is active.
|
*/
function isActiveRoute($route, $output = "active")
{
	if(str_finish($route, '.*')) {
		$route = str_replace('.*', '', $route);
		if(substr(Route::currentRouteName(), 0, strlen($route)) === $route) {
			return $output;
		}

	} else if (Route::currentRouteName() == $route) {
		return $output;
	}
}

/*
|--------------------------------------------------------------------------
| Detect Active Routes
|--------------------------------------------------------------------------
|
| Compare given routes with current route and return output if they match.
| Very useful for navigation, marking if the link is active.
|
*/
function areActiveRoutes(array $routes, $output = "active")
{
	foreach ($routes as $route) {
		if (isActiveRoute($route)) {
            return $output;
        }
	}

}