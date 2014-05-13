<?hh namespace Tests;

/**
 *  Class to test misc functions
 *
 */
class MiscTest extends \Oak\Test\TestCase {
	
    public function testRouteObject() {
    	$r = new \Oak\Route\Route('/', 'index', 'index');
    	
    	$this->assertEquals('index', $r->controller, 'Controller is not equal with index');

    }

}