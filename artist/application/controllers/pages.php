<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pages extends CI_Controller
{
   public function __construct()
   {
     // if (ini_get('display_errors')) {
      //   ini_set('display_errors', 0);
     // }
      parent::__construct();
      $this->load->model('home_model');
   }
   
   public function view($page = "home")
   {
      if(!file_exists('application/views/pages/' . $page . '.php'))
      {
         //don't have a page for that
         show_404();
      }
      $data['page'] = $page;
      
      if($page == "link")
      {
         $data['title'] = "TADs links";
      }
      if($page == "resume")
      {
         $data['title'] = "resume";
      }
      if($page == "home")
      {
         $data['page'] = "home";
         $data['title'] = "Welcome to the Creative Works of Tomi Ajayi-Dopemu";
         $data['featured'] = $this->home_model->get_home_featured();
      }
      
      if($page == "art")
      {
         $data['page'] = $page;
         $data['title'] = "2D art- 3D art - sketchbook";
         $data['thumbs2d'] = $this->home_model->get_art_2dthumbs();
         $data['thumbs3d'] = $this->home_model->get_art_3dthumbs();
         $data['thumbssb'] = $this->home_model->get_art_sbthumbs();
      }
      
      if($page == "photos")
      {
         $data['page'] = $page;
         $data['title'] = "photos";
         $data['thumbsphotos'] = $this->home_model->get_photos();
      }
      $this->load->view('templates/main_header',$data);
      $this->load->view('templates/navbar',$data);
      $this->load->view('pages/' . $page, $data);
      $this->load->view('templates/footer',$data);
      
   }
}
?>