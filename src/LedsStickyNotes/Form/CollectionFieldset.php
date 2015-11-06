<?php
namespace LedsStickyNotes\Form;

use Zend\Form\Fieldset;
use LedsStickyNotes\Entity\CollectionTitles;

use LedsStickyNotes\Form\NoteFieldset;
use Doctrine\Common\Persistence\ObjectManager;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use Zend\InputFilter\InputFilterProviderInterface;

class CollectionFieldset extends Fieldset implements InputFilterProviderInterface{

	public function __construct(ObjectManager $objectManager){
		parent::__construct('collection');
		$this->setHydrator(new DoctrineHydrator($objectManager, 'LedsStickyNotes\Entity\CollectionTitles', true))
			->setObject(new CollectionTitles());

		$this->add(array(
			'name' => 'id',
			'type' => 'hidden'
		));

		$this->add(array(
			'name' => 'title',
			'type' => 'Zend\Form\Element\Text',
			'attributes' => array(
				'required' => 'required'
			)
		));

		$noteFieldset = new NoteFieldset($objectManager);
		$this->add(array(
			'name' => 'notes',
			'type' => 'Zend\Form\Element\Collection',
			'attributes' => array(
				'id' => 'sticky-notes',
			),
			'options' => array(
				'object_manager' => $objectManager,
				//'count' => 1,
				'should_create_template' => false,
				'allow_add' => true,
				'target_element' => $noteFieldset
			)
		));
	}

	public function getInputFilterSpecification(){
		return array(
			'title' => array(
				'required' => false,
			),
		);
	}
}
