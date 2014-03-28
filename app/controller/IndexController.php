<?hh namespace App\controller;


class IndexController extends \Oak\Controller\BaseController {

    public function __construct():void {
        parent::__construct();

    }

    public function index():void {

        echo "<h1>Welcome to Oak Framework</h1>";
        return "hej!!!";
    }

    public function about($username, $id) :void {
        echo "<br />About Action";
        echo __FUNCTION__ . " loaded";
        echo "loaded " . $username . " with id " . $id;
    }
}
