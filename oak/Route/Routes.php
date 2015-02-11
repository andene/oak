<?hh namespace Oak\Route;


class Routes {

    public $routes = Vector {};

    
    /**
     * Add a route to the routes vector
     *  Route
     */
    public function addRoute(Route $route):void {
        $this->routes->add($route);
    }

    public function getRoutes():Vector {
        return $this->routes;
    }
}
