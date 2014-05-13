<?hh namespace Oak\Tests;

use \Oak\Test\TestCase;
use \Oak\Container\Container;

class ContainerText extends TestCase {

	public function testContainerSet() {
		
		Container::set('test', function() {
			return true;
		});

		
	}
	

}