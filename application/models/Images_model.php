<?php
Class Images_model extends CI_Model{
  public $user;
  public $url;
  public function __construct(){
    parent::__construct();
  	$this->load->database();
  }
  public function create($toins){

    $this->db->insert('userimage', $toins);
  }
  public function show($toshow){
    

  }
  
}

 ?>
