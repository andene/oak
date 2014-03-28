<?hh namespace Oak\Error;

interface ErrorControllerInterface {

    public function __construct(\Exception $e);

    public function displayError():void;
}
