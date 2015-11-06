<?php
namespace LedsStickyNotes\Repository;

use Doctrine\ORM\EntityRepository;
use LedsStickyNotes\Entity\CollectionTitles;
use LedsStickyNotes\Entity\CollectionNotes;

class CollectionRepository extends EntityRepository{

	public function createTitle(CollectionTitles $title){
		$this->_em->persist($title);
		$this->_em->flush($title);
		return $title;
	}

	public function getTitlesId($title){
		$em = $this->getEntityManager();
		$titleId = $em->createQuery("SELECT n FROM LedsStickyNotes\Entity\CollectionTitles n WHERE n.title = :title");
		$titleId->setParameter('title', $title);
		$titleId->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);
		return $titleId->getArrayResult();
	}

	public function createNote(CollectionNotes $note, $id){
		$title = $this->_em->getRepository('LedsStickyNotes\Entity\CollectionTitles')->findOneBy(array('id' => $id));
		$note->setTitle($title);
		$note->setNote('');
		$note->setCreated(new \DateTime('now'));
		$this->_em->persist($note);
		$title->addNote($note);
		$this->_em->persist($title);
		$this->_em->flush();
		return $note;
	}

	public function updateNote(CollectionNotes $note){
		$this->_em->persist($note);
		$this->_em->flush($note);
		return $note;
	}

	public function removeNote(CollectionNotes $note){
		$this->_em->remove($note);
		$this->_em->flush($note);
		return $note;
	}
//strtolower(str_replace("-", " ", $title))
}
