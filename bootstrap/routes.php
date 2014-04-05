<?hh
use \Oak\Route\Route;
use \Oak\Route\Routes;

$routes = new Routes();

$routes->addRoute(new Route('/', 'index', 'index'));
$routes->addRoute(new Route('help', 'help', 'index'));

$routes->addRoute(new Route('test/{param1}/{param2}', function($param1, $param2) {

$view = new \Oak\View\View('index.index');
$view->with('title', "Closue title")
     ->with('headline', 'Welcome to OakFramework')
     ->with('footer', date('H:i:s'));
     echo $view->render();

    echo "<h1>Closure run from Route</h1>";
    echo "Value 1: " . $param1;
    echo "<br> Value 2: " . $param2;
}, null));


$routes->addRoute(new Route('user/{username}/{id}', 'index', 'about'));
$routes->addRoute(new Route('index/information', 'index', 'information'));
$routes->addRoute(new Route('index/notextist', 'index', 'NotExtist'));

Container::set('routes', $routes);
