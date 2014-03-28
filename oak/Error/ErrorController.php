<?hh namespace Oak\Error;

class ErrorController implements ErrorControllerInterface {


    public function __construct(private \Exception $e):void {
        $this->e = $e;
    }
    public function displayError():void {
        echo "<pre>";
        print_r($this->e);
        echo "</pre>";
    }

    public function notfound(?Array $params) :void {

        header("HTTP/1.0 404 Not Found");
        echo "Error! Not found";
    }
}
