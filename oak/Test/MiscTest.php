<?hh namespace Oak\Test;

class MiscTest extends TestCase {
	
 public function testTrue() {
        $true = true;
        $this->assertTrue($true);
    }

    public function testFalse() {
    	$false = false;
    	$this->assertFalse($false);
    }

    public function testRouteObject() {
    	$r = new \Oak\Route\Route('/', 'index', 'index');
    	
    	$this->assertEquals('index', $r->controller, 'Controller is not equal with index');

    }

}