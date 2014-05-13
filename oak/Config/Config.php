<?hh namespace Oak\Config;


class Config {

    public Map $container = Map {};

    public function __construct(){}

    /**
    *    Tell which name class is registered with in the IoC container
    *
    *    return @string
    */
    public static function getName():string {
        return "config";
    }

    public function set(string $key, $value): void {

        $this->container->set($key, $value);
    }

    public function get(string $key):mixed {

        return $this->container->get($key);
    }
    
}
