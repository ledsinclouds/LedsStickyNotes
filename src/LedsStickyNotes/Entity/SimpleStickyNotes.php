<?php

namespace LedsStickyNotes\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="LedsStickyNotes\Repository\SimpleStickyNotesRepository")
 * @ORM\HasLifecycleCallbacks 
 */
class SimpleStickyNotes {
	
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
    
    //public function setId($id){
        //$this->id = $id;
        //return $this;
    //}    

    public function getId(){
        return $this->id;
    }

    public function setNote($note){
        $this->note = $note;
        return $this;
    }

    public function getNote(){
        return $this->note;
    }

    public function setCreated(\DateTime $created = null){        
        if ($created==null){
            $created = new \DateTime("now");
        }
        $this->created = $created;
        return $this;
    }
    
    public function getCreated(){                
        if (!isset($this->created)){
            $this->setCreated();
        }
        return $this->created->format('Y-m-d H:i:s');
    }
    
    /** 
    *  @ORM\PrePersist 
    */
    public function prePersist(){
        $this->getCreated(); 
    } 
    
    /** 
    *  @ORM\PostPersist 
    */
    public function postPersist(){
        $this->getId();
    } 
	      
}





























