<?php namespace Shell\Offers\Classes;

use Illuminate\Routing\Controller;
use Input;
use DB;
use Route;

class ApiDiscoveryController extends Controller
{

    public function index()
    {
        // dump(Route::getCurrentRoute()->getPath());
        $urlPrefix = Route::getCurrentRoute()->getPath();
        // dump(Route::getRoutes());
        $routes = Route::getRoutes();
		foreach ($routes as $route) {
			if ((strpos($route->getPath(), $urlPrefix) === 0) && ($route->getPath() != Route::getCurrentRoute()->getPath())) {
				dump($route->getMethods()[0].' '.$route->getPath());
			}
		}
    }

}