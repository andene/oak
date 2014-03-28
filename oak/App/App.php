<?hh namespace Oak\App;

class App {

    public $routes;
    protected $request;

    public function __construct():void {
        $this->request = new \Oak\Header\Request();
    }

    public function run():void {

        try {
            $rTo = $this->parseRequestRoute();
        } catch (\Oak\Exception\NotFoundException $e) {
            $error = new \App\Controller\ErrorController($e);
            $error->displayError();
            return;
        }

        $controllerName = ucfirst($rTo->controller)."Controller";
        $actionName = $rTo->action;

        $name = "\App\Controller\\".$controllerName;
        $controller = new $name();
        $res = call_user_func_array(array($controller, $actionName), $rTo->params);
        $this->dispatch($res);
    }

    public function dispatch($response): void {
        echo $response;
    }

    public function addRoutes(\Oak\Route\Routes $routes):void {
            $this->routes = $routes;
    }

    public function parseRequestRoute(): Route {

        preg_match_all('#{([a-z0-9][a-zA-Z0-9_,]*)}#', urldecode($this->request->getRequestUri()), $matches);
        foreach($this->routes->getRoutes() as $route) {
            //Change parameters to regex
            $regex = preg_replace('/{.*?}/', '([a-zA-Z0-9_-]*)', $route->path);
            $regex = '#'.$regex.'$#';

            if(preg_match($regex, $this->request->getRequestUri(), $m)) {
                // Get the parameter keys from request URI
                preg_match_all('/{([a-zA-Z0-9_-]*)}/', $route->path, $keys);
                unset($m[0]); //Remove the whole request to be able to merge keys and parameters

                $matched = array_combine($keys[1], $m);
                $route->setParams($matched);

                return $route;
            }
        }
        throw new \Oak\Exception\NotFoundException("Couldn't find route " . $this->request->getRequestUri());
    }

}
