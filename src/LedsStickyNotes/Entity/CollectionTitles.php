<?php
namespace LedsStickyNotes\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="LedsStickyNotes\Repository\CollectionRepository")
 */
class CollectionTitles{

	use \LedsStickyNotes\Traits\ReadOnly;

	/**
	 * @ORM\Id
	 * @ORM\Column(type="integer")
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	protected $id;

	/**
	 * @ORM\Column(type="string")
	 */
	protected $title;

	/**
	 * @ORM\OneToMany(targetEntity="CollectionNotes", mappedBy="title", cascade={"persist", "remove"})
	 */
	protected $notes;

	public function getId(){
		return $this->id;
	}

	public function setTitle($title = null){	
		$this->title = strtolower(str_replace(" ", "-", $title));				
		//$this->title = $title;
		return $this;
	}

	public function getTitle(){
		return $this->title;
	}

	public function setNotes($notes = null){
		$this->notes = $notes;
		return $this;
	}

	public function getNotes(){
		if(!isset($this->notes)){
			$this->setNotes();
		}
		return $this->notes;
	}

	public function removeNote(CollectionNotes $note){
		throw new \Exception('Not implemented');
	}

	public function addNote(CollectionNotes $note){
		$note->setTitle($this);
		$notes = $this->getNotes();
		$notes[] = $note;
		$this->setNotes($notes);
		return $this;
	}
}




































