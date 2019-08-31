<?php
if(!empty($_POST['sort']))
{
   $this->load->library("tomilib");
   
   if($_POST['sort'] == "down")
   {
      $r = FALSE;
     
      //$r = $this->tomilib->set_photo_pos("2d",$_POST['ceiling'],$_POST['floor']);
      for($i = $_POST['floor']; $i < $_POST['ceiling']; $i++)
      {
         //superflously set photo pos without id for floor
        // if($i == $_POST['floor'])
           // $r = $this->tomilib->set_photo_pos("2d",$i,$i+1,$_POST['itemID']);
        // else
           // $r = $this->tomilib->set_photo_pos("2d",$i,$i+1);
      }
      $return['error'] = $r;
      $return['msg'] = "good job it worked";
   }
   
}
echo json_encode($return);
?>