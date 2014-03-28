<?hh namespace Oak\Controller;

class BaseController {

    public function __construct():void {
    }

    public function __call($name, $args): string {

        $trace = debug_backtrace();
        trigger_error(
            'Undefined property via __get(): ' . $name .
            ' in ' . $trace[0]['file'] .
            ' on line ' . $trace[0]['line'],
            E_USER_FATAL);



        return "Method: " . $name . " not found!";
    }

}
