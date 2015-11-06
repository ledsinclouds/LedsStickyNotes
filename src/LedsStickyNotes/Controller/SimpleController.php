<?php

namespace LedsStickyNotes\Controller;

use LedsStickyNotes\Controller\AbstractStickyController;
use Zend\View\Model\ViewModel;
use LedsStickyNotes\Entity\SimpleStickyNotes;
use LedsStickyNotes\Form\Element\SimpleTextarea;
use Zend\Json\Json;

class SimpleController extends AbstractStickyController{
	
	public function indexAction(){
		$stickyNotes = $this->getSimpleRepository()->findAll();
		$textareaElement = new SimpleTextarea();
		return new ViewModel(array(
			'element' => $textareaElement,
			'stickynotes' => $stickyNotes
		));
	}

	public function addAction(){
		$request = $this->getRequest();
		$response = $this->getResponse();

		if($request->isPost()){
			$stickyNote = new SimpleStickyNotes();
			$stickyNote->setNote('');
			$this->getSimpleRepository()->create($stickyNote);

			if(!$note_id = $stickyNote->getId()){
				$response->setContent(Json::encode(array('response' => false)));
			}else{
				$response->setContent(Json::encode(array(
					'response' => true,
					'new_note_id' => $note_id
				)));
			}
		}
		return $response;
	}
	
	public function updateAction(){
		$request = $this->getRequest();
		$response = $this->getResponse();

		if($request->isPost()){
			$post_data = $request->getPost();
			$note_id = $post_data['id'];
			$note_content = $post_data['note'];

			$stickyNote = $this->getSimpleRepository()->findOneBy(array('id' => $note_id));
			$stickyNote->setNote($note_content);

			if(!$this->getSimpleRepository()->update($stickyNote)){
				$response->setContent(Json::encode(array('response' => false)));
			}else{
				$response->setContent(Json::encode(array('response' => true)));
			}
		}
		return $response;
	}

	public function removeAction(){
		$request = $this->getRequest();
		$response = $this->getResponse();

		if($request->isPost()){
			$post_data = $request->getPost();
			$note_id = $post_data['id'];
			$stickyNote = $this->getSimpleRepository()->findOneBy(array('id' => $note_id));

			$this->getSimpleRepository()->remove($stickyNote);
			$response->setContent(\Zend\Json\Json::encode(array('response' => true)));
		}
		return $response;
	}
	
}














