<?hh

require "vendor/autoload.php";

use \Oak\Route\Route as Route;
use \Oak\Route\Routes as Routes;
use \Oak\App\App as App;

$routes = new Routes();
$routes->addRoute(new Route('home', 'index', 'index'));
$routes->addRoute(new Route('index/information', 'index', 'information'));
$routes->addRoute(new Route('kontakt', 'index', 'hej'));
$routes->addRoute(new Route('kontakt/{office}', 'index', 'office'));
$routes->addRoute(new Route('user/{username}/{id}', 'index', 'about'));
$routes->addRoute(new Route('user/{username}/{id}/del', 'index', 'profile'));

$app = new App();
$app->addRoutes($routes);

$app->run();
