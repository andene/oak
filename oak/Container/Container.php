<?hh namespace Oak\Container;


class Container implements \Oak\Container\ContainerInterface {

    protected static $services = array();

    public static function set($name, $service) {

        if(!is_object($service)) {
            throw new \InvalidArgumentException("Only objects can be registred");
        }
        if(!in_array($name, static::$services, true)) {
            static::$services[$name] = $service;
        }
    }


    public static function register(string $name, $service) {
        if(!is_object($service)) {
            throw new \InvalidArgumentException("Only objects can be registred");
        }
        if(!in_array($name, static::$services, true)) {
            static::$services[$name] = $service;
        }
    }

    public static function get($name, array $params = array()) {
        if(!isset(static::$services[$name])) {
            throw new \RuntimeException($name ." has not been registred in the container");
        }

        $service = static::$services[$name];
        
        return !$service instanceof \Closure ? $service : call_user_func_array($service, $params);
    }


    public static function has($name):bool {
        return isset(static::$services[$name]);
    }

    public static function remove($name) {
        if(isset(static::$services[$name])) {
            unset(static::$services[$name]);
        }
    }


    /**
     * Function to reset services to an empty array
     */
    public static function clear() {
        self::$services = array();
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

