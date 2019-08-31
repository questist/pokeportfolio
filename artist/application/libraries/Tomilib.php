<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

 class Tomilib {

     public function set_photo_pos($section,$oldpos,$newpos)
     {
        $CI =& get_instance();
        
        $CI->load->model('home_model');
        return $CI->home_model->set_photo_pos($section,$oldpos,$newpos);
     }
 }

 /* End of file Tomilib.php */