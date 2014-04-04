<?hh namespace Oak\Route;

class Route {

    public \Vector $params;
    public function __construct(public string $path, public mixed $controller, public ?string $action, $params = null) {

        $this->path = ($path);
        $this->controller = $this->_getController($controller);
        $this->action = ($action);

        if(null !== $params) {
            $this->params = strtolower($params);
        }
    }

    private function _getController($controller): mixed<string, object> {

        if(is_object($controller) && $controller instanceof \Closure) {
            return $controller;
        } elseif(is_string($controller)) {
            return strtolower($controller);
        } else {
            throw new \Exception("Controller must be of type string or object, ". gettype($controller) . " given");
        }
    }


    public function setParams(array $params):void {
        $this->params = $params;
    }

}
