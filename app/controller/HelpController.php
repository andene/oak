<?hh namespace App\Controller;

use \Oak\Controller\BaseController as BaseController;
use \Oak\App\App as App;
use \Logger;

class HelpController extends BaseController{

    public function index(): \Oak\View\View {


        $view = new \Oak\View\View('help.index');
        $view->with('title', 'Help for Oak')
             ->with('headline', 'Help!');

        return $view;

    }
}
