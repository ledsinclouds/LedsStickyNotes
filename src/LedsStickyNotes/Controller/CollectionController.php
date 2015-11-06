<?php

namespace LedsStickyNotes\Controller;

use LedsStickyNotes\Controller\AbstractStickyController;
use Zend\View\Model\ViewModel;
use LedsStickyNotes\Form\CollectionForm;
use LedsStickyNotes\Entity\CollectionTitles;
use LedsStickyNotes\Entity\CollectionNotes;

class CollectionController extends AbstractStickyController{

    public function indexAction(){
		$em = $this->getEntityManager();
		$titles = $this->getTitlesRepository()->findAll();

		$title = new CollectionTitles();
		$form = new CollectionForm($em);
		$form->bind($title);

		$request = $this->getRequest();
		if($request->isPost()){
			$post = $request->getPost();
			$title_id = $post['id'];			
			$form->setData($post);
			if($form->isValid()){
				$this->getTitlesRepository()->createTitle($title);
				return $this->redirect()->toRoute('sticky-notes-collection');
			}
		}
		return new ViewModel(array(
			'form' => $form,
			'titles' => $titles
		));
    }

	public function collectionViewAction(){
		$em = $this->getEntityManager();
		$request = $this->getRequest();

		$collectionTitle = (string)$this->getEvent()->getRouteMatch()->getParam('note');
		$titleId = $this->getTitlesRepository()->getTitlesId($collectionTitle);
		$id = $titleId[0]['id'];

		$form = new CollectionForm($em);
		$title = $this->getTitlesRepository()->findOneBy(array('id' => $id));
		$form->bind($title);

		return array(
			'form' => $form,
			'title' => $collectionTitle
		);
	}
	
	public function addAction(){
		$request = $this->getRequest();
		$response = $this->getResponse();

		$collectionTitle = (string)$this->getEvent()->getRouteMatch()->getParam('note');
		$titleId = $this->getTitlesRepository()->getTitlesId($collectionTitle);
		$id = $titleId[0]['id'];

		$notes = new CollectionNotes();
		$note = $this->getTitlesRepository()->createNote($notes, $id);

		if($request->isPost()){
			if(!$note_id = $note->getId()){
				$response->setContent(\Zend\Json\Json::encode(array('response' => false)));
			}else{
				$response->setContent(\Zend\Json\Json::encode(array(
					'response' => true,
					'note_id' => $note_id
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

			$note = $this->getNotesRepository()->findOneBy(array('id' => $note_id));
			$note->setNote($note_content);

			if(!$this->getNotesRepository()->updateNote($note)){
				$response->setContent(\Zend\Json\Json::encode(array('response' => false)));
			}else{
				$response->setContent(\Zend\Json\Json::encode(array('response' => true)));
			}
		}
		return $response;
	}

	public function deleteAction(){
		$request = $this->getRequest();
		$response = $this->getResponse();

		if($request->isPost()){
			$post_data = $request->getPost();
			$note_id = $post_data['id'];

			$note = $this->getNotesRepository()->findOneBy(array('id' => $note_id));
			$this->getNotesRepository()->removeNote($note);
			$response->setContent(\Zend\Json\Json::encode(array('response' => true)));
		}
		return $response;
	}		
}

