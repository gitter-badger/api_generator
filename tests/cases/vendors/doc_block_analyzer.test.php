<?php
App::import('Vendor', 'ApiGenerator.DocBlockAnalyzer');
App::import('Vendor', 'ApiGenerator.ClassDocumentor');

/**
 * A class to run rules against
 *
 **/
class TestSubjectOne {
	public $noDoc = '';
/**
 * This one has a complete doc string
 *
 * @var string
 **/
	public $hasDoc;

	public function iHazNoDocz() {

	}
/**
 * This func haz docz
 *
 * @return void
 **/
	public function iCanHazDocz() {

	}
/**
 * I haz docs, but no param tags
 *
 * @return void
 **/
	public function iHazNoParams($one, $two, $three) {
		
	}
/**
 * This function has everything
 *
 * @param string $one Its the first param
 * @param string $two the second param
 * @param string $three the third param
 * @link http://mark-story.com
 * @return void
 **/
	public function bestestFunc($one, $two, $three) {

	}
}

Mock::generate('DocBlockRule', 'MockDocBlockRule');

class DocBlockAnalyzerTestCase extends CakeTestCase {
/**
 * test construction and rule building.
 *
 * @return void
 **/
	function testConstruction() {
		$analyze = new DocBlockAnalyzer(array('MissingLink', 'IncompleteTags'));
		$rules = $analyze->getRules();
		$this->assertEqual(array_keys($rules), array('MissingLinkDocBlockRule', 'IncompleteTagsDocBlockRule'));
	}
/**
 * test that the source setting only allows Documentors.
 *
 * @return void
 **/
	function testSourceSetting() {
		$analyze = new DocBlockAnalyzer();
		$reflection = new ClassDocumentor('TestSubjectOne');
		$result = $analyze->setSource($reflection);
		$this->assertTrue($result);
		
		$this->expectError();
		$fail = new StdClass();
		$result = $analyze->setSource($fail);
		$this->assertFalse($result);
	}
}
?>