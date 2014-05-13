<?hh namespace Oak\Facades;

use \Oak\Container\Container;

abstract class Facade {

    protected static function getName() {
        throw new \Exception("Can not call getName function on Facade abstract class");
    }

    public static function __callStatic($method, $args) {

        $instance = Container::get(static::getName());


        if(!method_exists($instance, $method)) {
            throw new \Exception(get_called_class() . ' does not implement ' . $method . ' method.');
        }
        return call_user_func_array([$instance, $method], $args);
    }

}
 