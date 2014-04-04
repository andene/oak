<?hh namespace Oak\Route;

class Route {

    public \Vector $params;
    public function __construct(public string $path, public mixed<object, string> $controller, public ?string $action, $params = null) {

        $this->path = strtolower($path);
        $this->controller = $this->_getController($controller);
        $this->action = strtolower($action);

        if(null !== $params) {
            $this->params = strtolower($params);
        }
    }

    private function _getController($controller): mixed<string, object> {

        if(is_object($controller) && $controller instanceof \Closure) {
            return $controller;
        } elseif(is_string($controller)) {
            return strtolower($controller);
        } 
    }


    public function setParams(array $params):void {
        $this->params = $params;
    }

}
