<?hh namespace App\Controller;

class ErrorController extends \Oak\Error\ErrorController implements \Oak\Error\ErrorControllerInterface{

    public function __construct(private \Exception $e):void {
        $this->e = $e;
    }
    public function displayError():void {
        echo "<pre>";
        print_r($this->e);
        echo "</pre>";
    }

}
