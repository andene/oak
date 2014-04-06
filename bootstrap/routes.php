<?hh
use \Oak\Route\Route;
use \Oak\Route\Routes;

$routes = new Routes();
$routes->addRoute(new Route('/', 'index', 'index'));
Container::set('routes', $routes);
