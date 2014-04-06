<?hh namespace App\controller;


class IndexController extends \Oak\Controller\BaseController {

    public function __construct($params):void {
        parent::__construct();
        echo __FUNCTION__ . " loaded";
        print_r($params);
    }

    public function about($username, $id) :void {
        echo "<br />About Action";
        echo __FUNCTION__ . " loaded";
        echo "loaded " . $username . " with id " . $id;
    }
}
