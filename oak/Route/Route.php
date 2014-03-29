<?hh namespace Oak\Route;

class Route {

    public \Vector $params;
    public function __construct(public string $path, public string $controller, public string $action, $params = null) {
        $this->path = strtolower($path);
        $this->controller = strtolower($controller);
        $this->action = strtolower($action);

        if(null !== $params) {
            $this->params = strtolower($params);
        }
    }

    public function setParams(array $params):void {
        $this->params = $params;
    }

}
