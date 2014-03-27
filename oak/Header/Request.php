<?hh namespace Oak\Header;

class Request {
    protected $requestUri;
    protected $method;

    public function __construct():void {
        $this->requestUri = $_SERVER['REQUEST_URI'];
        $this->method = $_SERVER['REQUEST_METHOD'];
    }

    public function getRequestUri():string {
        return ltrim(strtolower($this->requestUri), '/');
    }
}
