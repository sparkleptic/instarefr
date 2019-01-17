<?php
class WelcomeModel extends CI_Model {
 
 function getUser(){
  $this->db->select("insta_user_id,Insta_user_registered_date"); 
  $this->db->from('insta_user');
  $query = $this->db->get();
  return $query->result();
 }
 
}
?>