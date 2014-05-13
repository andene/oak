<?hh

require "routes.php";

use \Oak\Config\Config as c;
use \Oak\Config\Facade\Config;
use \Oak\Container\Container;
use \Oak\Header\Request;

$config = new c();
Container::set('config', $config);


Config::set('publicPath', __DIR__."/../public");
Config::set('appPath', __DIR__."/../app");
Config::set('viewFolder', __DIR__."/../app/View");

Container::set('request',  function() {
    return new Request();
});

/**
 *
 * Register View with the container
 *
 */

Container::set('view', function($viewFilePath) {
	return new \Oak\View\View($viewFilePath, Config::get('viewFolder'));
});