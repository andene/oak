<?hh namespace Oak\Error;

interface ErrorControllerInterface {

    public function __construct();

    public function displayError():void;
}
