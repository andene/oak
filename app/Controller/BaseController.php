<?hh namespace App\Controller;

use \Oak\Container\Container;
use \Elasticsearch\Client;

class BaseController extends \Oak\Controller\BaseController {

    public function __construct():void {
        parent::__construct();
    
    }
}
