<!-- Controller -->
<?php
class Images extends CI_Controller{

  public function __construct(){

    parent::__construct();
    $this->load->helper(array('form','url'));
    $this->load->library('session');
    $this->load->model('images_model');
    $this->load->database();
  
  }

  public function index(){
    
    system("rm test.jpg");
    system("rm test.png");
    system("mkdir uploads");
    chmod("./uploads",0777);

    if(!isset($_SESSION['user'])){
    
      $x=fopen("visit.txt",'r');
      $_SESSION['user']=fread($x, filesize("visit.txt"));
      fclose($x);
      $_SESSION['user']= $_SESSION['user']+1;
      $x=fopen("visit.txt",'w');
      fwrite($x,$_SESSION['user']);
      fclose($x);
    
    }
    
    else{
    
      $x=fopen("visit.txt",'r');
      $_SESSION['user']=fread($x, filesize("visit.txt"));
      fclose($x);
    
    }
    $this->load->view('upload_form');

  }

  public function show(){

    $query=$this->db->get('userimage');
    $data['records'] = $query->result();
    $this->load->view('finished',$data);
  
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
        list($width,$height)=getimagesize($source);
        $dst=imagecreatetruecolor(600,($height/$width)*600);
        list($width,$height)=getimagesize($source);
        imagecopyresampled($dst,$image,0,0,0,0,600,($height/$width)*600,$width,$height);
        imagejpeg($dst,"test.jpg",50);
        chmod("./test.jpg", 0777);
        $name="test.jpg";
        $size=filesize ("./test.jpg");
    
      }
    
      elseif($info['file_ext']==".png"){
    
        $image=imagecreatefrompng($source);
        list($width,$height)=getimagesize($source);
        $dst=imagecreatetruecolor(600,($height/$width)*600);
        imagecopyresampled($dst,$image,0,0,0,0,600,($height/$width)*600,$width,$height);
        imagepng($dst,"test.png",1);
        chmod("./test.png", 0777);
        $name="test.png";
        $size=filesize ("./test.png");
    
      }
    
      $data=array('upload_data'=> $this->upload->data());
      $data["im_size"]=100-$size/($info["file_size"]*10.00);
      $data["namef"]=$name;
      $x=fopen("visit.txt",'r');
      $vno=fread($x, filesize("visit.txt"));
      fclose($x);
      $toins['user']="user".$vno;
      $toins['url']=$source;
      $this->images_model->create($toins);
      $this->load->view('uploaded_form',$data);

    }
  }
}
?>
