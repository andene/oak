<?hh namespace Oak\Header;

class Response {

    protected $statusCode;
    public $headers = Map{};

    public function __construct():void {

        $this->statusCode = 200; 
        $this->headers['Content-Type'] = 'text/html';
        $this->headers['Expires'] = 'off';
    }


    public function addHeader(string $key, string $value):Response {
    	$this->headers->set($key, $value);
    	return $this;
    }
    public function setStatusCode(int $statusCode):Response {
    	$this->statusCode = $statusCode;
    	return $this;
    }

    public function getRequestUri():string {
        return ltrim(strtolower($this->requestUri), '/');
    }

    public function getStatusCode():int {
    	return $this->statusCode;
    }
    public function getHeaders(): Map {
    	return $this->headers;

    }
}
