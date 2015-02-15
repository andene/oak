<?hh
require "vendor/autoload.php";


use \Oak\Route\Route;
use \Oak\Route\Routes;
use \Oak\App\Facade\App;
use \Oak\Container\Container;

use \Oak\Config\Config as c;
use \Oak\Config\Facade\Config;
use \Oak\Header\Request;
use \Oak\Header\Response;

$config = new c();
Container::register('config', $config);

Config::set('publicPath', __DIR__."/../public");
Config::set('appPath', __DIR__."/../app");


// =============================================
// Add config files values to config
// =
// ============================================

$routes = new Routes();

$routes->addRoute(new Route('/', function() {

} , null));


$routes->addRoute(new Route('test/{param1}', function($param1) { 
    echo "This is loaded with a closure.";
    echo "Easy access of param1 by using{$param1} ";
}, null ));

Container::register('routes', $routes);


Container::register('request',  function() {
    return new Request();
});
Container::register('response', function() {
	return new Response();
});

Container::register('app', function() {
    return new \Oak\App\App(Container::get('routes'), Container::get('request'));
});

$_SERVER['REQUEST_METHOD'] = 'GET';
$_SERVER['REQUEST_URI'] = '/';

print_r(Container::getServices());

App::run();

