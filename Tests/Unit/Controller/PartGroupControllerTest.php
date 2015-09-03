<?php
namespace S3b0\EcomConfigCodeGenerator\Tests\Unit\Controller;
/***************************************************************
 *  Copyright notice
 *
 *  (c) 2015 Sebastian Iffland <Sebastian.Iffland@ecom-ex.com>, ecom instruments GmbH
 *  			
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 2 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

/**
 * Test case for class S3b0\EcomConfigCodeGenerator\Controller\PartGroupController.
 *
 * @author Sebastian Iffland <Sebastian.Iffland@ecom-ex.com>
 */
class PartGroupControllerTest extends \TYPO3\CMS\Core\Tests\UnitTestCase {

	/**
	 * @var \S3b0\EcomConfigCodeGenerator\Controller\PartGroupController
	 */
	protected $subject = NULL;

	protected function setUp() {
		$this->subject = $this->getMock('S3b0\\EcomConfigCodeGenerator\\Controller\\PartGroupController', array('redirect', 'forward', 'addFlashMessage'), array(), '', FALSE);
	}

	protected function tearDown() {
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function listActionFetchesAllPartGroupsFromRepositoryAndAssignsThemToView() {

		$allPartGroups = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array(), array(), '', FALSE);

		$partGroupRepository = $this->getMock('S3b0\\EcomConfigCodeGenerator\\Domain\\Repository\\PartGroupRepository', array('findAll'), array(), '', FALSE);
		$partGroupRepository->expects($this->once())->method('findAll')->will($this->returnValue($allPartGroups));
		$this->inject($this->subject, 'partGroupRepository', $partGroupRepository);

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$view->expects($this->once())->method('assign')->with('partGroups', $allPartGroups);
		$this->inject($this->subject, 'view', $view);

		$this->subject->listAction();
	}

	/**
	 * @test
	 */
	public function showActionAssignsTheGivenPartGroupToView() {
		$partGroup = new \S3b0\EcomConfigCodeGenerator\Domain\Model\PartGroup();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$this->inject($this->subject, 'view', $view);
		$view->expects($this->once())->method('assign')->with('partGroup', $partGroup);

		$this->subject->showAction($partGroup);
	}
}
