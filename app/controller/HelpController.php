<?hh namespace App\Controller;

use \Oak\Controller\BaseController as BaseController;

class HelpController extends BaseController{

    public function index():\Oak\View\View {

        $view = new \Oak\View\View('help.index');
        return $view;

    }
}
