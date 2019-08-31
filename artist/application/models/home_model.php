<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home_model extends CI_Model {

   public function __construct()
   {
      $this->load->database();
   }
   
   public function get_home_featured($id = 1)
   {
      $this->db->select('*')->from('photo_gallery')->where('section','featured')->order_by('position','asc')->having('position >=',0);
      $query = $this->db->get();
      return $query->result_array();
      
      return $query->row_array();
   }
   
   public function get_trash($section)
   {
      $query = $this->db->get_where('photo_gallery', array('section' => $section, 'position' => -1));
      return $query->result_array();  
   }
   
   public function add_new_photo($lrg, $thumb, $title, $section, $pos = -1)
   {
      $sql = "INSERT INTO photo_gallery(section,orig_src,thumb_src,title,position)";
      $sql .= " VALUES ( " . 
                           $this->db->escape($section). ",". 
                           $this->db->escape($lrg).",".
                           $this->db->escape($thumb).",".
                           $this->db->escape($title).
                           ", -1)";
      $return = $this->db->query($sql);
      return $return;
   }
   
   public function save_temp_photo_data($lrg, $thumb)
   {
       $sql = "INSERT INTO temporary_bin(string_field,string_field_two) ";
       $sql .= "VALUES ( " . $this->db->escape($lrg) . "," . $this->db->escape($thumb) . ")";
       $return = $this->db->query($sql);
   }
   
   public function empty_temp()
   {
      $this->db->empty_table("temporary_bin");
   }
   
   public function get_uploaded_imgs()
   {
      $this->db->select('*')->from('temporary_bin');
      $query = $this->db->get();
      return $query->result_array();
   }
   
   public function get_art_2dthumbs()
   {
      $this->db->select('*')->from('photo_gallery')->where('section','2d')->order_by('position','asc')->having('position >=',0);
      $query = $this->db->get();
      return $query->result_array();
   }
   
   public function get_featured_thumbs()
   {
      $this->db->select('*')->from('photo_gallery')->where('section','featured')->order_by('position','asc')->having('position >=',0);
      $query = $this->db->get();
      return $query->result_array();
   }
   
   public function get_art_3dthumbs()
   {
      $this->db->select('*')->from('photo_gallery')->where('section','3d')->order_by('position','asc')->having('position >=',0);
      $query = $this->db->get();
      return $query->result_array();
   }
   
   public function get_photos_thumbs()
   {
      $this->db->select('*')->from('photo_gallery')->where('section','photos')->order_by('position','asc')->having('position >=',0);
      $query = $this->db->get();
      return $query->result_array();
   }
   
   public function get_art_sbthumbs()
   {
      $this->db->select('*')->from('photo_gallery')->where('section','sb')->order_by('position','asc')->having('position >=',0);
      $query = $this->db->get();
      return $query->result_array();
   }
   
   public function get_photos()
   {
     $query = $this->db->get_where('photo_gallery', array('section' => 'photos','position !=' => -1));
      return $query->result_array();
   }
   
   public function add_photo($section,$pos = -1)
   {
      
   }
   
   public function set_photo_pos($section,$newpos,$oldpos,$id = -1)
   {
      $sql ='';
      if($id != -1)
         $sql = 'UPDATE photo_gallery SET position = ' . $newpos . ' WHERE section = \''. $section .'\' AND id = ' . $id;
      else
         $sql = 'UPDATE photo_gallery SET position = ' . $newpos . ' WHERE position = ' . $oldpos . ' AND section = \''. $section .'\'';
      $query = $this->db->query($sql);
      return $query;
   }
   
   public function trash_photo($id)
   {
      $sql = 'UPDATE photo_gallery SET position = -1 WHERE id = ' . $id;
      $query = $this->db->query($sql);
      return $query;
   }
   
   public function recycle_photo($id,$count)
   {
      $sql = 'UPDATE photo_gallery SET position = '. $count . ' WHERE id = ' . $id;
      $query = $this->db->query($sql);
      return $query;
   }
   
   public function empty_trash($section)
   {
      $this->db->where('position' ,-1)->where('section', $section);
      $this->db->delete('photo_gallery');
   }
   
   public function do_login()
   { 
      $query = $this->db->get('login_data');
      $result = $query->row_array();
      if($result['username'] == $this->input->post('username') && $result['password'] == $this->input->post('password'))
      {
         return TRUE;
      }
      else 
      {
         return FALSE;
      }
   }
}

?>