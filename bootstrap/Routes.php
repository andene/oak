<?hh
use \Oak\Route\Route;
use \Oak\Route\Routes;

$routes = new Routes();

$routes->addRoute(new Route('/', 'index', 'index'));
$routes->addRoute(new Route('help', 'help', 'index'));

$routes->addRoute(new Route('user/{username}/{id}', 'index', 'about'));
$routes->addRoute(new Route('kontakt/{office}', 'index', 'office'));
$routes->addRoute(new Route('index/information', 'index', 'information'));
$routes->addRoute(new Route('index/notextist', 'index', 'NotExtist'));

Container::set('routes', $routes);
