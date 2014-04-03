<?hh

require "../vendor/autoload.php";


class Container implements \Oak\Container\ContainerInterface {

    protected static $services = array();

    public static function set($name, $service) {
        if(!is_object($service)) {
            throw new \InvalidArgumentException("Only objects can be registred");
        }

        if(!in_array($service, self::$services, true)) {
            self::$services[$name] = $service;
        }
    }

    public static function get($name, array $params = array()) {
        if(!isset(self::$services[$name])) {
            throw new \RuntimeException($name ." has not been registred in the container");
        }
        $service = self::$services[$name];

        return !$service instanceof Closure ? $service : call_user_func_array($service, $params);
    }

    public static function has($name):bool {
        return isset(self::$services[$name]);
    }

    public static function remove($name) {
        if(isset(self::$services[$name])) {
            unset(self::$services[$name]);
        }
    }


    /**
     * Function to reset services to an empty array
     */
    public static function clear() {
        $this->services = array();
    }

    /**
	 * Setup the layout used by the controller.
	 *
	 * @return array
	 */
    public static function getServices():array {
        return self::$services;
    }
}

class logger extends \Oak\Facades\Facade {

    public function __construct(){

    }

    public static function getName() {
        return 'logger';
    }

    public function log(string $message):void {
        echo "Logging message " . $message . "\n";
    }
}







use \Oak\App\App;

require "../bootstrap/Routes.php";

Container::set('app', function() use ($routes) {
    return new App(Container::get('routes'), new \Oak\Header\Request());
});

Container::set('logger', function() {
        return new logger();
});

$app = Container::get('app');


$app->run();
