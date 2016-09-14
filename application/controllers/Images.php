<?php
session_start();
class Images extends CI_Controller{
  public function __construct(){
    parent::__construct();
    $this->load->helper(array('form','url'));
  }
  public function index(){

    system("rm -rf uploads");
    system("rm test.jpg");
    system("rm test.png");
    system("mkdir uploads");
    chmod("./uploads",0777);
    if(!isset($__SESSION['user'])){
      $x=fopen("visit.txt",'r');
      $vno=fread($x, filesize("visit.txt"));
      $__SESSION['user']=$vno;
      fclose($x);
    }
    else{
      $x=fopen("visit.txt",'w');
      $vno++;
      fwrite($x,$vno);
      fclose($x);
    }

    $userData=array('userno'=>$vno);
    $this->load->view('upload_form',$userData);
  }
  public function do_upload(){
    $config['upload_path']  ='./uploads/';
    $config['allowed_types']='gif|png|jpg';
    $this->load->library('upload',$config);
    if(!$this->upload->do_upload('userfile')){
      $error = array('error' => $this->upload->display_errors());
      $this->load->view('upload_form', $error);
    }
    else{
      $info=$this->upload->data();
      $base=base_url();
      $source= $base."uploads/".$info['file_name'];
      chmod("./uploads/".$info['file_name'],0777);
      if($info['file_ext']==".jpg" || $info['file_ext']==".jpeg"){
        $image=imagecreatefromjpeg($source);
        $dst=imagecreatetruecolor(1000,1000);
        list($width,$height)=getimagesize($source);
        imagecopyresampled($dst,$image,0,0,0,0,1000,1000,$width,$height);
        imagejpeg($dst,"test.jpg",50);
        chmod("./test.jpg", 0777);
        $name="test.jpg";
        $size=filesize ("./test.jpg");
      }
      elseif($info['file_ext']==".png"){
        $image=imagecreatefrompng($source);
        $dst=imagecreatetruecolor(500,500);
        list($width,$height)=getimagesize($source);
        imagecopyresampled($dst,$image,0,0,0,0,500,500,$width,$height);
        imagepng($dst,"test.png",1);
        chmod("./test.png", 0777);
        $name="test.png";
        $size=filesize ("./test.png");
      }

      $data=array('upload_data'=> $this->upload->data());
      $data["im_size"]=100-$size/($info["file_size"]*10.00);
      $data["namef"]=$name;
      $this->load->view('uploaded_form',$data);

    }
  }

}
?>
