<?hh

$startTime = microtime(true);

require "../vendor/autoload.php";


use \Oak\App\Facade\App;
use \Oak\App\App as A;
use \Oak\Header\Request;
use \Oak\Container\Container;


require "../bootstrap/boot.php";

Container::set('app', function() {
    return new A(Container::get('routes'), Container::get('request'));
});


App::run();

$creationtime =  microtime(true) - $startTime;
//printf("<br>Page created in %.6f seconds.", $creationtime);

