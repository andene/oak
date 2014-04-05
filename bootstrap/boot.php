<?hh

require "routes.php";

use \Oak\Config\Config;

Container::set('config', function() {
        return new \Oak\Config\Config();
});


Config::set('publicPath', __DIR__."/../public");
Config::set('appPath', __DIR__."/../app");
Config::set('viewFolder', __DIR__."/../app/View");
