<?hh
use \Oak\Route\Route;
use \Oak\Route\Routes;
use \Oak\Container\Container;

$routes = new Routes();
$routes->addRoute(new Route('/', 'index', 'index'));
$routes->addRoute(new Route('test', 'index', 'index'));
Container::set('routes', $routes);
