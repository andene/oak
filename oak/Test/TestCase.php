<?hh namespace Oak\Test;

class TestCase extends \PHPUnit_Framework_TestCase {

	public function setUp() {
		parent::setUp();
	}
   public function testBool() {
   		$this->assertTrue(true);
   }

}
