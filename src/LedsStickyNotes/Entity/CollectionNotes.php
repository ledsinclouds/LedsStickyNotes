<?php
namespace LedsStickyNotes\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="LedsStickyNotes\Repository\CollectionRepository")
 * @ORM\HasLifecycleCallbacks
 */
class CollectionNotes{

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
	protected $note;

	/**
	 * @ORM\Column(type="datetime")
	 */
	protected $created;

	/**
	 * @ORM\ManyToOne(targetEntity="CollectionTitles", inversedBy="note")
	 */
	protected $title;

	public function getId(){
		return $this->id;
	}

	public function setNote($note = null){
		$this->note = $note;
		return $this;
	}

	public function getNote(){
		if(!isset($this->note)){
			$this->setNote();
		}
		return $this->note;
	}

	public function setCreated(\DateTime $created = null){
		if($created == null){
			$created = new \DateTime("now");
		}
		$this->created = $created;
		return $this;
	}

	public function getCreated(){
		if(!isset($this->created)){
			$this->setCreated();
		}
		return $this->created->format('Y-m-d H:i');
	}

	public function setTitle(CollectionTitles $title = null){
		$this->title = $title;
		return $this;
	}

	public function getTitle(){
		if(!isset($this->title)){
			$this->setTitle();
		}
		return $this->title;
	}

	public function prePersist(){
		$this->getCreated();
	}

}
