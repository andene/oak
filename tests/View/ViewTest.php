<?hh namespace Test;

use \Oak\View\View;

class ViewTest extends \Oak\Test\TestCase {
	
	public function testCreateSingleView():void {

		$file = 'single';
		$view = new View($file, __DIR__);
		$this->assertEquals($file, $view->getViewPath());

		$this->assertTrue((false !== strpos($view->render(), 'Oak')) ? true : false, 'View does not contain expected value Oak');


		
	}

}