<?php
Class Images_model extends CI_Model{
  public $user;
  public $url;
  public function __construct(){
    parent::__construct();
  	$this->load->database();
  }
  public function show(){
  	$user="Krishnanunni";
  	$url="www.google.com";
    $data=array('user'=>$user,'url'=>$url);
    $this->db->insert('userimage', $data);
  }
  
}

 ?>
