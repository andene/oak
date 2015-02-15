<?hh namespace Tests;

use \Oak\Route\Route;
use \Oak\Container\Container;
use \Oak\App\Facade\App;


class RouterTest extends \Oak\Test\TestCase {
	
	public function setUp() {
		parent::setUp();

	}

	public function testCreateRouteObject() {

    	$r = new \Oak\Route\Route('/', 'index', 'index');
    	
    	$this->assertEquals('index', $r->controller, 'Controller is not equal with index');
    	$this->assertEquals('index', $r->action, 'Action is not equal with index');
	}

	public function testCreateRouterWithClosue() {

		$r = new Route('/', function() {}, null);

		$isClosure = $r->controller instanceof \Closure;
		$this->assertTrue($isClosure);
	
	}


	/** @test */
	public function isCorrect() {

		$req = Container::getServices();
		print_r($req);
		$this->assertTrue(true);
	}
}