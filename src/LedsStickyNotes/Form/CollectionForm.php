<?php
namespace LedsStickyNotes\Form;

use Doctrine\Common\Persistence\ObjectManager;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use Zend\Form\Form;

class CollectionForm extends Form{

	public function __construct(ObjectManager $objectManager){
		parent::__construct('collection-form');
		$this->setHydrator(new DoctrineHydrator($objectManager, 'LedsStickyNotes\Entity\CollectionTitles', true));

		$collection = new CollectionFieldset($objectManager);
		$collection->setUseAsBaseFieldset(true);
		$this->add($collection);

		$this->add(array(
			'name' => 'submit',
			'attributes' => array(
				'type' => 'submit',
				'value' => 'New Note Title'
			)
		));

		$this->setValidationGroup(array(
			'collection' => array(
				'title'
			)
		));
	}

}
