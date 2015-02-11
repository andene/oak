<?hh namespace Oak\Controller;

use \Oak\Container\Container;
use \Oak\Header\Request;
use \Oak\Header\Response;
use \Oak\Config\Config;

class BaseController {

    protected $response;
    protected $request;


    public function __construct():void {
        $this->response = Container::get('response');
        $this->request = Container::get('request');

    }

    public function config():Config {
        return Container::get('config');
    }

    public function request():Request {
    	return $this->request;
    }

    public function getResponse(): Response {
        return $this->response;
    }


    public function __call($name, $args): void {
        //return "Method: " . $name . " not found!";
    }

}
