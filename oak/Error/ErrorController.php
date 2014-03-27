<?hh namespace Oak\Error;

class ErrorController implements ErrorControllerInterface {

    public function __construct():void {

    }
    public function displayError():void {
        echo "Errors!";
    }

    public function notfound(?Array $params) :void {

        header("HTTP/1.0 404 Not Found");
        echo "Error! Not found";
    }
}
