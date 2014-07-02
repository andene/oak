<?hh namespace Tests;

use \Oak\View\View;

class ViewTest extends \Oak\Test\TestCase {
	
	public function testCreateSingleView():void {

		$file = 'single';
		$view = new View($file, __DIR__.'/View');
		$this->assertEquals($file, $view->getViewPath());

		$this->assertTrue((false !== strpos($view->render(), 'Oak')) ? true : false, 'View does not contain expected value Oak');
	}

	public function testCreateSingleViewWithLayout():void {

		$file = 'singleWithLayout';
		$view = new View($file, __DIR__.'/View');
		$this->assertEquals($file, $view->getViewPath());

		$this->assertTrue((false !== strpos($view->render(), 'Oak_Layout')) ? true : false, 'View does not contain expected value Oak_Layout');
		
		$this->assertTrue((false !== strpos($view->render(), '_LAYOUT_')) ? true : false, 'Layout file does not contain expected value _LAYOUT_');
		
	}

}