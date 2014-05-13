<?hh namespace Oak\View;

use \Oak\Config\Facade\Config;

class View {

    private Map $properties = Map {};
    public $viewContent;
    private string $viewFileExtension = ".php";
    private string $viewFilePath;
    private string $layoutPath;
    private $viewFolder;
    public $doneView;

    public function __construct(private string $viewpath, string $viewFolder):void {
        
        $this->viewFolder = $viewFolder.DIRECTORY_SEPARATOR;

        $this->viewpath = $viewpath;

        $path = $this->fixPath($viewpath);

        if(!file_exists($path)) {
            throw new \Oak\Exception\NotFoundException('View file '.$viewpath.' not found', 0, null);
        }

        $this->viewFilePath = $path;
          
    }
    public function getViewPath():string {
        return $this->viewpath;
    }

    public function render():string {

        ob_start();
        include $this->viewFilePath;
        $this->viewContent = ob_get_clean();

        if($this->useLayout()) {
            $this->doneView = $this->getLayout();
        } else {
            $this->doneView = $this->viewContent;
        }

        $partials = $this->getPartials();
        foreach($partials as $partial) {
            $partialPath = $this->fixPath($partial[1]);
            ob_start();
            include $partialPath;
            $data = ob_get_clean();
            $this->doneView = str_replace($partial[0], $data, $this->doneView);
        }

        return $this->doneView;
    }

    public function getLayoutPath():string {
        echo $this->layoutPath;
        return $this->layoutPath;
    }

    /**
     * Check if @layout tag is found in view file content
     * return @bool
     */
    private function useLayout():bool {
        if(preg_match('/@layout/', $this->viewContent)) {
            return true;
        }
        return false;
    }

    private function getPartials() {

        preg_match_all('/\@include\(\'([a-zA-Z0-9\.]*)\'\)/', $this->doneView, $m, PREG_SET_ORDER);
        return $m;

    }

    private function getLayoutFilePath():string {
        preg_match('/\@layout\(\'([a-zA-Z0-9\.]*)\'\)/',$this->viewContent, $m);

        $layoutFile = $m[1];
        $this->layoutPath = $this->fixPath($layoutFile);
        return $this->fixPath($layoutFile);
    }

    public function with(string $key, mixed<string, array, object> $value):View {
        $this->properties[$key] = $value;
        return $this;
    }

    public function __get(string $key) {

        if($this->properties->containsKey($key)) {
            return $this->properties[$key];
        }
    }

    /**
     * Get the contents of layout file and remove the @layout keyword from
     * contents. Replace the {{layout_content}} tag with content of the view file  
     *
     * return @string
     */
    protected function getLayout():string {
        ob_start();
        include $this->getLayoutFilePath();
        $layout = ob_get_clean();

        // Remove @layout() command from view
        $this->viewContent = preg_replace('/\@layout\(\'([a-zA-Z0-9\.]*)\'\)/','', $this->viewContent);

        // Add the view content to the layout in by replace of {{ layout_content }}
        $layout = preg_replace('/{{layout_content}}/', $this->viewContent, $layout);

        return $layout;
    }

    private function fixPath(string $path):string {

        $path = str_replace('.', DIRECTORY_SEPARATOR, $path);

        if(false === strpos($path, $this->viewFileExtension)) {
            $path = $path.$this->viewFileExtension;
        }
        return $this->viewFolder.$path;

    }



}
