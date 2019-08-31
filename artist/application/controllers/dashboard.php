<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller
{ 
   public function __construct()
   {
      if (ini_get('display_errors')) {
         ini_set('display_errors', 0);
      }
      parent::__construct();
      $this->load->model('home_model');
      $this->load->helper(array('form'));
      $this->load->library('unit_test');
      
      
   }
   
   private function verify()
   {
      $li = $this->session->userdata('logged_in');
      if($li == 'YES')
         return TRUE;
      else
         return FALSE;
   }
   
   public function index()
   {
      if(!$this->verify())
         redirect(site_url('admin_login'));
      
      //load pertinent view
      $data['title'] = 'Admin Dashboard';
      
      $this->load->view('templates/dashboardheader',$data);
      $this->load->view('templates/dashboard-menu',array('section' => "2d"));
      $this->load->view('dashboard/dashboard-main');
   }
   
   public function art()
   {
      if(!$this->verify())
         redirect(site_url('admin_login'));
      
      $data['title'] = 'Admin Dashboard - Edit Art Page';
      $data['thumbs2d'] = $this->home_model->get_art_2dthumbs();
      $data['trash'] = $this->home_model->get_trash("2d");
      
      $this->load->view('templates/dashboardheader',$data);
      $this->load->view('templates/dashboard-menu',array('section' => "2d"));
      $this->load->view('dashboard/dashboard-art');
   }
   
   public function art3d()
   {
      if(!$this->verify())
         redirect(site_url('admin_login'));
      
      $data['title'] = 'Admin Dashboard - Edit Art Page';
      $data['thumbs3d'] = $this->home_model->get_art_3dthumbs();
      $data['trash'] = $this->home_model->get_trash("3d");
      
      $this->load->view('templates/dashboardheader',$data);
      $this->load->view('templates/dashboard-menu',array('section' => "3d"));
      $this->load->view('dashboard/dashboard-3d');
   }
   
   public function artsb()
   {
      if(!$this->verify())
         redirect(site_url('admin_login'));
      
      $data['title'] = 'Admin Dashboard - Edit Art Page';
      $data['thumbssb'] = $this->home_model->get_art_sbthumbs();
      $data['trash'] = $this->home_model->get_trash("sb");
       
      $this->load->view('templates/dashboardheader',$data);
      $this->load->view('templates/dashboard-menu',array('section' => "sb"));
      $this->load->view('dashboard/dashboard-sb');
   }
   
   public function photos()
   {
      if(!$this->verify())
         redirect(site_url('admin_login'));
      
      $data['title'] = 'Admin Dashboard - Edit Art Page';
      $data['thumbsphotos'] = $this->home_model->get_photos_thumbs();
      $data['trash'] = $this->home_model->get_trash("photos");
       
      $this->load->view('templates/dashboardheader',$data);
      $this->load->view('templates/dashboard-menu',array('section' => "photos"));
      $this->load->view('dashboard/dashboard-photos');
   }
   
   public function featured()
   {
      if(!$this->verify())
         redirect(site_url('admin_login'));
   
      $data['title'] = 'Admin Dashboard - Edit Featured on Home page';
      $data['featphotos'] = $this->home_model->get_featured_thumbs();
      $data['trash'] = $this->home_model->get_trash("featured");
       
      $this->load->view('templates/dashboardheader',$data);
      $this->load->view('templates/dashboard-menu',array('section' => "featured"));
      $this->load->view('dashboard/dashboard-featured');
   }
   
   public function emptyTrash($section)
   {
      $this->home_model->empty_trash($section);
      switch($section)
      {
         case '2d': $this->art();break;
         case '3d': $this->art3d();break;
         case 'sb': $this->artsb();break;
         case 'photos': $this->photos();break;
         case 'featured': $this->featured();break;
      }
      
   }
   //includes sort function (a bit bumped up) that will sort any pages data or send it to the bin
   public function submit()
   {
      $section = null;
      if(!$this->verify())
         redirect(site_url('admin_login'));
      
      if(!empty($_POST['sort']))
      { 
         switch($_POST['page'])
         {
            case 'art': $section = '2d';break;
            case 'art3d': $section = '3d';break;
            case 'sb': $section = 'sb';break;
            case 'photo': $section = 'photos';break;
            case 'feat': $section = 'featured';break;
         }
         //sort down
         if($_POST['sort'] == "down")
         {
            $r = false;
            $r = $this->sortDown(intval($_POST['floor']),intval($_POST['ceiling']),intval($_POST['itemID']),$section);
           // $this->unit->run($r,TRUE,"Else if from submit sort down","may be due to internal db call");
           // $this->unit->run(intval($_POST['ceiling']),3,"intval conversion for ceiling","may be due to type mismatch on ajax transfer");
           // $this->unit->run(intval($_POST['floor']),1,"intval conversition for floor","may be due to type mismatch on ajax transfer");
            //$this->unit->run($section,1,"section entry","may be due to type mismatch on ajax transfer");
            //$r = TRUE;
            $return['success'] = $r;
            //$return['msg'] = $this->unit->report();
            $return['msg'] = "sort down";
         }
         //sort up
         else if($_POST['sort'] == "up")
         {
            $r = false;
            $r = $this->sortUp($_POST['ceiling'],$_POST['floor'],$_POST['itemID'],$section);
            //$this->unit->run($r,TRUE,"Elseif from submit sort up","may be due to internal db call");
            
            $return['success'] = $r;
            $return['msg'] = "sort up";
         }
         else if($_POST['sort'] == "trash")
         {
            $r = $this->home_model->trash_photo($_POST['itemID']);
            //sort down
            for($i = $_POST['floor']; $i < $_POST['count']; $i++)
            {
               $r = $this->home_model->set_photo_pos($section,$i,$i+1);
            }
            $return['success'] = $r;
            $return['msg'] = "Sort Error: Trash";
         }
         else if($_POST['sort'] == "recycle")
         {
            
            $r = $this->home_model->recycle_photo($_POST['itemID'],$_POST['count']);
            $return['success'] = $r;
            $return['msg'] = "Sort Error: Recycle";
         }
         else 
         {
            $return['success'] = FALSE;
            $return['msg'] = "Sort Error: Post";
         }
      }
      echo json_encode($return);
   }
   
   private function sortUp($ceiling,$floor,$itemID,$section)
   {
      //loop from floor up to avoid matching position as loop iterates to top
      for($i = $floor; $i < $ceiling; $i++)
      {
      $r = $this->home_model->set_photo_pos($section,$i,$i+1);
      }
      //switch item to new position
      $r = $this->home_model->set_photo_pos($section,$ceiling,$floor,$itemID);
      //$this->unit->run($r,TRUE,"Sort up return from home model call sortup","may be due to internal db call");
      return $r;
   }
   
   private function sortDown($floor,$ceiling,$itemID,$section)
   {
      //loop from ceiling down to avoid conflict with matching positions as loop iterates
      for($i = $ceiling-1; $i >= $floor; $i--)
      {
      $r = $this->home_model->set_photo_pos($section,$i+1,$i);
      }
      //switch item to new position
      $r = $this->home_model->set_photo_pos($section,$floor,$ceiling,$itemID);
      //$this->unit->run($r,TRUE,"Sort up return from home model call sort down","may be due to internal db call");
      return $r;
   }
   
   public function do_upload($section, $ret = false)
   {
     // if(!is_dir($_SERVER['DOCUMENT_ROOT']. "/Tomis_Website/public/files/"))
		//	mkdir($_SERVER['DOCUMENT_ROOT']. "/Tomis_Website/public/files/", 0777, true);
		
		//$handle = fopen($_SERVER['DOCUMENT_ROOT'] . "/Tomis_Website/public/files/" . $filename, "w") or exit("cannot open path");
      if(!$this->verify())
         redirect(site_url('admin_login'));
      
      if($ret == "return")
      {
         $next_page = NULL;
         switch($section)
         {
            case "2d":
               $next_page = 'art';
               break;
            case "3d":
               $next_page = 'art3d';
               break;
            case "sb":
               $next_page = 'artsb';
               break;
            case "photos":
               $next_page = 'photos';
               break;
            case "featured":
               $next_page = 'featured';
               break;
         }
         $this->home_model->empty_temp();
         redirect(site_url("dashboard/" . $next_page));
      }
      $config['upload_path'] = './upload/';
      $config['allowed_types'] = 'gif|jpg|png';
      $config['max_size']	= '3000';
      $config['max_width']  = '1800';
      $config['max_height']  = '1800';
      
      $this->load->library('upload', $config);
      $this->load->library('form_validation');
      
      $error = false;
      if($this->upload->do_upload('smallimg'))
      {
         
         $tmpdata = $this->upload->data();
         $thumb = $tmpdata['file_name'];
        
         if(!$this->upload->do_upload('lrgimg'))
         {
            $error = $this->upload->display_errors();
            $this->view_form($error,$section);
            return;
         }
         
        
         $tmpdata = $this->upload->data();
         $lrg = $tmpdata['file_name'];
         //initialize data for transfer to success page and do final save file from data
         $data['section'] = $section;
         $data['title'] = "Dashboard - Successfully uploadeded file";
         
         $title = $this->input->post('title');
         
         $smalldestination = base_url("upload/" . $thumb);

         $lrgdestination = base_url("upload/" . $lrg );
         $this->home_model->save_temp_photo_data($lrg, $thumb);
         $data['ulimgs'] = $this->home_model->get_uploaded_imgs();
         $this->home_model->add_new_photo($lrgdestination,$smalldestination,$title,$section);
         
         $this->load->view('dashboard/success',$data);
      }
      else
      {
         $error = $this->upload->display_errors();
         $this->view_form($error,$section);
         return;
      }
   }
   
   private function view_form($error,$section)
   {
      $data['error'] = $error;
       
      $data['section'] = $section;
       
      $this->load->view('dashboard/upload_form', $data);
       
      return;
   }
}

?>