<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_login extends CI_Controller
{ 
   public function __construct()
   {
      parent::__construct();
      $this->load->model('home_model');
   }
   
   public function index()
   {
      //load
      $this->load->library('form_validation');

      if($this->form_validation->run('login') == FALSE ) {
         //display login form
         $data['title'] = "Login";
         
         $this->load->view('templates/loginheader',$data);
         $this->load->view('admin_login/login');
      }
      else if($this->home_model->do_login())
      {
         //set session data to allow checking in any protected controllers
         $newdata = array(
               'username'  => $this->input->post('username'),
               'logged_in' => 'YES'
         );
         $this->session->set_userdata($newdata);
            
         //load pertinent view
         //$this->form_validation->unset_field_data();

         redirect('dashboard');
      }
      //just in case 
      else
      {
         //display login form
         $data['title'] = "Login, Try Again!";
         $this->load->view('templates/loginheader',$data);
         $this->load->view('admin_login/login');
      }
   }
   
   public function logout()
   {
      $this->session->unset_userdata('logged_in');
      $this->session->unset_userdata('username');
      $this->session->sess_destroy();
      $this->index();
   }
}
?>
