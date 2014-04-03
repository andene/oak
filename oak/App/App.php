<?hh namespace Oak\App;

use \App\Controller\IndexController;


class App implements \ArrayAccess{

    public $routes;
    protected $request;

    public function __construct(\Oak\Route\Routes $routes, \Oak\Header\Request $request):void {

        $this->request = $request;
        $this->routes = $routes;


    }

    public function run():void {

        try {
            $rTo = $this->parseRequestRoute();
        } catch (\Oak\Exception\NotFoundException $e) {
            $error = new \App\Controller\ErrorController($e);
            $error->displayError();
            die();
        }

        $controller = $this->createController($rTo->controller);
        $actionName = $rTo->action;

        $view = call_user_func_array(array($controller, $actionName), $rTo->params);
        if($view instanceof \Oak\View\View) {
            $this->dispatch($view);
        } else {
            echo $view;
        }

    }

    public function dispatch($view): void {
        require $view->viewFilePath;
    }

    public function parseRequestRoute(): \Oak\Route\Route {

        preg_match_all('#{([a-z0-9][a-zA-Z0-9_,]*)}#', urldecode($this->request->getRequestUri()), $matches);
        foreach($this->routes->getRoutes() as $route) {
            //Change parameters to regex
            $regex = preg_replace('/{.*?}/', '([a-zA-Z0-9_-]*)', $route->path);
            $regex = '#'.$regex.'$#';

            if(preg_match($regex, $this->request->getRequestUri(), $m)) {
                preg_match_all('/{([a-zA-Z0-9_-]*)}/', $route->path, $keys); // Get the parameter keys from request URI
                unset($m[0]); //Remove the whole request to be able to merge keys and parameters


                $matched = array_combine($keys[1], $m);
                $route->setParams($matched);

                return $route;
            }
        }
        throw new \Oak\Exception\NotFoundException("Couldn't find route " . $this->request->getRequestUri(), null, null);
    }

    private function createController($requestController):\Oak\Controller\BaseController {

        $controllerName = ucfirst($requestController)."Controller";
        $name = "\App\Controller\\".$controllerName;
        $controller = new $name();
        if(!$controller  instanceof \Oak\Controller\BaseController) {
            throw new \Exception($name . " must the an instance if BaseController");
        }
        return $controller;

    }


    public function offsetSet($offset, $value):void {
        if (is_null($offset)) {
            $this->container[] = $value;
        } else {
            $this->container[$offset] = $value;
        }
    }
    public function offsetExists($offset):bool {
        return isset($this->container[$offset]);
    }
    public function offsetUnset($offset) {
        unset($this->container[$offset]);
    }
    public function offsetGet($offset) {
        return isset($this->container[$offset]) ? $this->container[$offset] : null;
    }

}
