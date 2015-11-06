<?php
namespace LedsStickyNotes\Form;

use Zend\Form\Fieldset;
use LedsStickyNotes\Entity\CollectionNotes;
use Doctrine\Common\Persistence\ObjectManager;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use Zend\InputFilter\InputFilterProviderInterface;

class NoteFieldset extends Fieldset implements InputFilterProviderInterface{

	public function __construct(ObjectManager $objectManager){
		parent::__construct('collection-notes');
		$this->setHydrator(new DoctrineHydrator($objectManager, 'LedsStickyNotes\Entity\CollectionNotes', true))
			->setObject(new CollectionNotes());
		$this->setAttribute('class', 'sticky-note');

		$this->add(array(
			'name' => 'id',
			'type' => 'hidden'
		));

		$this->add(array(
			'name' => 'note',
			'type' => 'Zend\Form\Element\Textarea',
			'attributes' => array(
				'required' => 'required',
				'id' => 'stickynote-'
			)
		));
	}

	public function getInputFilterSpecification(){
		return array(
			'note' => array(
				'required' => false
			)
		);
	}

}
