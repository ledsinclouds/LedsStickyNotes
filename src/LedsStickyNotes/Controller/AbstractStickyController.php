<?php
namespace LedsStickyNotes\Controller;

use Zend\Mvc\Controller\AbstractActionController;

abstract class AbstractStickyController extends AbstractActionController{

	protected $em;

	public function getEntityManager(){
		if($this->em == null){
			$this->em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
		}
		return $this->em;
	}
		
	public function getSimpleRepository(){
		$em = $this->getEntityManager();
		return $em->getRepository('LedsStickyNotes\Entity\SimpleStickyNotes');
	}	

	public function getTitlesRepository(){
		$em = $this->getEntityManager();
		return $em->getRepository('LedsStickyNotes\Entity\CollectionTitles');
	}

	public function getNotesRepository(){
		$em = $this->getEntityManager();
		return $em->getRepository('LedsStickyNotes\Entity\CollectionNotes');
	}

}
