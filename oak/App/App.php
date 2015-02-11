<?hh namespace Oak\App;

use \App\Controller\IndexController;
use \Oak\Route\Routes;


class App {

    protected $request;

    public function __construct(public  $routes, \Oak\Header\Request $request):void {

        $this->request = $request;
        $this->routes = $routes;
    }

    public function run():string {

        try { 

            // Returns a Route object
           $rTo = $this->parseRequestRoute();


            // ====================================================================
            //  If we use a closure controller, just call the closure with the params
            // ====================================================================
            if($rTo->controller instanceof \Closure) {
                    call_user_func_array($rTo->controller, $rTo->params);

            } else {

                // Controller is created and returned
                $controller = $this->createController($rTo->controller);

                // May return a \Oak\View\View, Plain text
                $returnedDataFromControlller = call_user_func_array(array($controller, $rTo->action), $rTo->params);

                if($returnedDataFromControlller instanceof \Oak\View\View) {
                    $this->dispatchView($returnedDataFromControlller);
                } else {
                    $this->dispatch($returnedDataFromControlller, $controller);
                }
            }

        } catch (\Oak\Exception\NotFoundException $e) {

            if($controller) {

                $response = $controller->getResponse();
                $code = (int)$response->getStatusCode();
                http_response_code(404);

            }
            $error = new \App\Controller\ErrorController($e);
            $error->displayError();
            
        }
        
        
    }

    public function dispatch(string $data, \Oak\Controller\BaseController $controller):void {

        $response = $controller->getResponse();

        // ====================================
        // Set the headers that are specified in 
        // Response class or the Controller
        // ====================================
        foreach ($response->getHeaders() as $key => $header) {
            header($key.":".$header);
        }

        $code = (int)$response->getStatusCode();
        http_response_code($code);

        echo $data;
    }

    public function dispatchView(\Oak\View\View $view): void {
        echo $view->render();
    }


    public function parseRequestRoute(): \Oak\Route\Route {

	   $matches = [] ;
//        echo "<pre>";
  //      print_r($this->request); 

    //    echo $_GET['limit'];echo $_GET['order'];
    //    
    //    
        if(strpos($this->request->getServerVar('request_uri'), '&') !== false) {
            
            $url = substr($this->request->getServerVar('request_uri'), 0, strpos($this->request->getServerVar('request_uri'), '&'));
        } else {
            
            $url = $this->request->getServerVar('request_uri');
        }

        preg_match_all('#{([a-z0-9][a-zA-Z0-9_,]*)}#', urldecode($url), $matches);
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
            if(preg_match($regex, $url, $m)) {
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
