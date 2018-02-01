<?php

class rpgstats extends SeedObject {

	function __construct(&$db) {
		
		$this->db = $db;

		$this->table_element = 'rpgstats';

		$this->fields=array(
			 'rowid'=>array('type'=>'integer','index'=>true)
		    ,'fk_contact'=>array('type'=>'integer','index'=>true)
			,'force'=>array('type'=>'integer')
			,'charisme'=>array('type'=>'integer')
			,'intelligence'=>array('type'=>'integer')
			,'datec'=>array('type'=>'date')
			,'tms'=>array('type'=>'date')
			
		);

		$this->init();
	}

    private function tirage() {
        $tirage = array(rand(0,6),rand(0,6),rand(0,6),rand(0,6));
        rsort($tirage);
        $tirage = array_slice($tirage,0,3);
        return array_sum($tirage);
    }
    
    function setForce() {    
           $this->force = $this->tirage();    
    }
    
    function setCharisme() {    
           $this->charisme = $this->tirage();    
    }
    
    function setIntelligence() {    
           $this->intelligence = $this->tirage();    
    }
    
    function setAll() {
        $this->setForce();
        $this->setCharisme();
        $this->setIntelligence();
    }
   
    function saveByContact($fk_contact) {
    /* 
        $res = $this->db->query("
        UPDATE ".MAIN_DB_PREFIX.$this->table_element." 
        SET force=".$this->force.",
        charisme=".$this->charisme.",
        intelligence=".$this->intelligence."  
		WHERE fk_contact=".(int)$fk_contact);
		
		if($res === false) {
		    var_dump($this->db);exit;
		}
		*/     
    }

	function fetchByContact($fk_contact) {
		
		$res = $this->db->query("SELECT rowid FROM ".MAIN_DB_PREFIX.$this->table_element." 
			WHERE fk_contact=".(int)$fk_contact);
			
		if($res === false) {
		    var_dump($this->db);exit;
		}
			
		if($obj = $this->db->fetch_object($res)) {
			return $this->fetchCommon($obj->rowid);
		}

		return false;
	}

}

