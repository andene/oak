<?hh namespace Oak\Controller;

use \Oak\Container\Container;
use \Oak\Header\Request;

class BaseController {

    public function __construct():void {
    }

    public function config():\Oak\Config\Config {
        return Container::get('config');
    }

    public function request():Request {
    	return Container::get('request');
    }


    public function __call($name, $args): void {
        //return "Method: " . $name . " not found!";
    }

}
