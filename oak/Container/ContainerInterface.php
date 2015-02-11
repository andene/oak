<?hh namespace Oak\Container;

interface ContainerInterface {

    public static function set($name, $service);
    public static function register(string $name, $service);
    public static function get($name, array $params = array());
    public static function has($name);
    public static function remove($name);
    public static function clear();
}
