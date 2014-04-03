<?hh namespace App\controller;


class IndexController extends \Oak\Controller\BaseController {

    public string $title;

    public function __construct():void {
        parent::__construct();

        $this->title = "Oak Framework 0.1.0";

    }

    public function index():\Oak\View\View {


        $view = new \Oak\View\View('index.index');
        $view->with('title', $this->title)->with('headline', 'Min rubrik');

        return $view;

    }

    public function office($officeName): string {

        return "Welcome to " . $officeName;
    }

    public function about($username, $id) :\Oak\View\View {

        $view = new \Oak\View\View('index.user');

        $headline = "Välkommen " . $username . " (".$id.")";

        $view->with('title', $this->title)->with('headline', $headline);
        return $view;
    }


}
