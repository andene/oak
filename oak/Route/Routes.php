<?hh namespace Oak\Route;


class Routes {

    public $routes = Vector {};
    public function addRoute(Route $route):void {
        $this->routes->add($route);
    }

    public function getRoutes():Vector {
        return $this->routes;
    }
}
