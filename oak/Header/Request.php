<?hh namespace Oak\Header;

class Request {

    protected $requestUri;
    protected $method;

    protected $serverVars = Map{};
    protected $postData = Map{};

    public function __construct():void {

        // Set server variables
		foreach ($_SERVER as $key => $value) {
			$this->serverVars->set(strtolower($key), $value);
		}

        // Set post body data if available
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            foreach ($_POST as $key => $value) {
                $this->postData->set(strtolower($key), $value);
            }    
        }
    }

    public function getServerVar(string $name): string {
        if($this->serverVars->containsKey($name)) {
            return $this->serverVars->get($name);
        } 
        throw new \Oak\Exception\NotFoundException("Var " . $name . " does not exist", null, null);
    }


    public function getPostVar(string $name): mixed<string, array> {
        if($this->postData->containsKey($name)) {
            return $this->postData->get($name); 
        } else {
            return '';
        }   
        throw new \Oak\Exception\NotFoundException("Var " . $name . " does now exist", null, null);
    }
    public function getPostVars():Map {
        return $this->postData;
    }

    
    public function getRequestUri():string {
        return ltrim($this->serverVars->get('request_uri'), '/');
    }
}
