<?hh namespace Oak\Config;


class Config extends \Oak\Facades\Facade{

    public static Map $container = Map {};

    public function __construct(){}

    /**
    *    Tell which name class is registered with in the IoC container
    *
    *    return @string
    */
    public static function getName():string {
        return 'config';
    }

    public function set($key, $value): void {
        self::$container[$key] = $value;
    }

    public function get(string $key):string {
        return self::$container[$key];
    }


}
