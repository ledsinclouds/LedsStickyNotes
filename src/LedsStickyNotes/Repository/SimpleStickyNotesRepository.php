<?php
namespace LedsStickyNotes\Repository;

use Doctrine\ORM\EntityRepository;
use LedsStickyNotes\Entity\SimpleStickyNotes;

class SimpleStickyNotesRepository extends EntityRepository{

	public function create(SimpleStickyNotes $stickyNotes){
		$this->_em->persist($stickyNotes);
		$this->_em->flush($stickyNotes);
		return $stickyNotes;
	}

	public function update(SimpleStickyNotes $stickyNotes){
		$this->_em->persist($stickyNotes);
		$this->_em->flush($stickyNotes);
		return $stickyNotes;
	}

	public function remove(SimpleStickyNotes $stickyNotes){
		$this->_em->remove($stickyNotes);
		$this->_em->flush($stickyNotes);
	}
}
