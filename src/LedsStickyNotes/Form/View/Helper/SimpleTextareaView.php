<?php
namespace LedsStickyNotes\Form\View\Helper;

use Zend\Form\View\Helper\AbstractHelper;
use Zend\Form\ElementInterface;
use Zend\Form\Exception;

class SimpleTextareaView extends AbstractHelper{

	public function __invoke(ElementInterface $element){
		if(!$element){
			return $this;
		}
		return $this->render($element);
	}

	public function createSourcesString($text){
		$retval = '';
		if(is_array($text) == true){
			foreach($text as $tmpsrc){
				$retval .= $this->createSourcesString($tmpsrc);
			}
		}else{
			$retval = sprintf('%s', $text);
		}
		return $retval;
	}

	public function render(ElementInterface $element){
		$text = $element->getAttribute('text');
		if($text === null){
			throw new Exception\DomainException(sprintf(
				'%s requires that the element has an assigned text; none discovered', __METHOD__
			));
		}
		$attributes = $element->getAttributes();
		$content            = (string) $element->getValue();
		$escapeHtml         = $this->getEscapeHtmlHelper();
		return sprintf(
			'<textarea %s>%s</textarea>',
			$this->createAttributesString($attributes),
			$this->createSourcesString($text),
			$escapeHtml($content)
		);
	}

}

