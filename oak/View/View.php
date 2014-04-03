<?hh namespace Oak\View;

class View {

    private Map $properties = Map {};
    public $viewContent;
    private string $viewFileExtension = ".php";
    private string $viewFielPath;
    private $viewFolder;

    public function __construct(private string $viewpath):View {

        $config = \Container::get('config');
        $this->viewFolder = $config['viewFolder']."/";

        $this->viewpath = $viewpath;
        $path = $this->fixPath($viewpath);


        if(!file_exists($path)) {
            throw new \Oak\Exception\NotFoundException("View file ".$viewpath." not found", 0, null);
        }
        $this->viewContent = file_get_contents($path);
        $this->viewFilePath = $path;

        return $this;
    }

    public function with(string $key, string $value):View {
        $this->properties[$key] = $value;
        return $this;
    }

    public function __get(string $key) {

        if($this->properties->containsKey($key)) {
            return $this->properties[$key];
        }
    }

    private function fixPath($path) {

        $path = str_replace('.', DIRECTORY_SEPARATOR, $path);

        if(false === strpos($path, $this->viewFileExtension)) {
            $path = $path.$this->viewFileExtension;
        }
        return $this->viewFolder.$path;

    }



}
