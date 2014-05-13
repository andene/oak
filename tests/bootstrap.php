<?hh
require "vendor/autoload.php";

use \Oak\App\Facade\App;
use \Oak\Header\Request;
use \Oak\Container\Container;

require "bootstrap/boot.php";


Container::set('app', function() {
    return new \Oak\App\App(Container::get('routes'), Container::get('request'));
});


