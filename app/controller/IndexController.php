<?hh namespace App\controller;


class IndexController extends \Oak\Controller\BaseController {

    public function __construct():void {
        parent::__construct();

    }

    public function index():string {

        return file_get_contents(dirname(__FILE__)."/../view/index/index.php");
    }

    public function office($officeName): string {

        return "Welcome to " . $officeName;
    }

    public function about($username, $id) :void {
    
        echo "loaded " . $username . " with id " . $id;
    }


}
