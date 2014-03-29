<?hh namespace Oak\Controller;

class BaseController {

    public function __construct():void {
    }

    public function __call($name, $args): string {
        
        return "Method: " . $name . " not found!";
    }

}
