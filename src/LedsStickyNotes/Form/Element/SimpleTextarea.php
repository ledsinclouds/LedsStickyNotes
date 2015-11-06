<?php
namespace LedsStickyNotes\Form\Element;

use Zend\Form\Element;

class SimpleTextarea extends Element {	

	protected $validator;
	protected $attributes = array(
		'text' => 'textarea'
	);
	
}
