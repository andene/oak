<?hh namespace App\Controller;


class IndexController extends \Oak\Controller\BaseController {

    public string $title;

    public function __construct():void {
        parent::__construct();
        $this->title = "Oak Framework 0.1.0";
    }

    public function index():\Oak\View\View {

        $view = new \Oak\View\View('index.index');
        $view->with('title', $this->title)
             ->with('headline', 'Welcome to OakFramework')
             ->with('description', 'OakFramework is a MVC framework build in Hack running on HHVM');

        return $view;

    }

}
