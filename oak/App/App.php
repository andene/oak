<?hh namespace Oak\App;

use \App\Controller\IndexController;


class App {

    public $routes;
    protected $request;

    public function __construct(\Oak\Route\Routes $routes, \Oak\Header\Request $request):void {

        $this->request = $request;
        $this->routes = $routes;
    }

    public function run():string {
        try { 
           $rTo = $this->parseRequestRoute();

            if($rTo->controller instanceof \Closure) {
                    call_user_func_array($rTo->controller, $rTo->params);

            } else {
                $controller = $this->createController($rTo->controller);
                $view = call_user_func_array(array($controller, $rTo->action), $rTo->params);

                if($view instanceof \Oak\View\View) {
                    $this->dispatch($view);
                } else {
                    echo $view;
                }
            }

        } catch (\Oak\Exception\NotFoundException $e) {
            $error = new \App\Controller\ErrorController($e);
            $error->displayError();
            
        }
        
        
    }

    public function dispatch($view): void {
        echo $view->render();
    }

    public function parseRequestRoute(): \Oak\Route\Route {

	$matches = [] ;
        preg_match_all('#{([a-z0-9][a-zA-Z0-9_,]*)}#', urldecode($this->request->getRequestUri()), $matches);
        foreach($this->routes->getRoutes() as $route) {
            //Change parameters to regex
            $regex = preg_replace('/{.*?}/', '([a-zA-Z0-9_-]*)', $route->path);
            $regex = '#'.$regex.'$#';

            if($this->request->getRequestUri() === "") {
                    if($route->path == '/') {
                        return $route;
                    }
            }
		
            $m = []; 
            if(preg_match($regex, $this->request->getRequestUri(), $m)) {
                $keys = [];
                preg_match_all('/{([a-zA-Z0-9_-]*)}/', $route->path, $keys); // Get the parameter keys from request URI
                unset($m[0]); //Remove the whole request to be able to merge keys and parameters

                $matched = array_combine($keys[1], $m);
                $route->setParams($matched);

                return $route;
            }
        }
        throw new \Oak\Exception\NotFoundException("Couldn't find route " . $this->request->getRequestUri(), null, null);
    }

    private function createController($requestController): mixed<\Oak\Controller\BaseController, Closure> {


        $name = "\App\Controller\\".ucfirst($requestController)."Controller";
        $controller = new $name();
        if(!$controller  instanceof \Oak\Controller\BaseController) {
            throw new \Exception($name . " must the an instance if BaseController");
        }
        return $controller;

    }


}
