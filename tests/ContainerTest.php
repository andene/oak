<?hh namespace Tests;

use \Oak\Test\TestCase;
use \Oak\Container\Container;

class ContainerText extends TestCase {

	public function testContainerSet():void {
		Container::clear();
		Container::set('test', function() {
			return true;
		});

		$this->assertEquals(count(Container::getServices()), 1, "Container is excpected to contain one service");

		Container::clear();

		$this->assertEquals(count(Container::getServices()), 0, "Container is excepcted to be empty");
	}

	public function testContainerSetNonObject():void {

		try {
			Container::set('test', 'passedString');

		} catch (\InvalidArgumentException $e) {
			$this->assertTrue($e instanceof \InvalidArgumentException);
		}	
	}

	/**
     * @expectedException        InvalidArgumentException
     */	
	public function testContainerSetNonObjectExpect():void {
		Container::set('test', 'passedString');
	}

	/**
     * @expectedException        InvalidArgumentException
     * @expectedExceptionMessage Only objects can be registred
     */	
	public function testContainerSetNonObjectExpectWithMessage():void {

		Container::set('test', 'passedString');
		
	}

	public function testExpectedException():void {
		$this->setExpectedException('InvalidArgumentException');
		Container::set('test', 'passedString');
	}	


	

}