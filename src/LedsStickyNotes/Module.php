<?php
namespace LedsStickyNotes;

use Zend\Form\View\Helper\FormRow;

class Module{
	
	public function getViewHelperConfig(){
		return array(
			'invokables' => array(
				'simpleTextarea' => 'LedsStickyNotes\Form\View\Helper\SimpleTextareaView'
			)
		);
	}	
	
    public function getConfig(){
        return include __DIR__ . '/../../config/module.config.php';
    }

    public function getAutoloaderConfig(){
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/../../src/' . __NAMESPACE__,
                ),
            ),
        );
    }
}
