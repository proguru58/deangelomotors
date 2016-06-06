<?php

class Admin_model extends CI_Model {

  /**
   * Validate the login's data with the database
   * @param string $adminname
   * @param string $password
   * @return void
   */
  function validate($adminname, $password)
  {
    $this->db->where('adminname', $adminname);
    $this->db->where('password', $password);
    $query = $this->db->get('admins');

    if(count($query->result()) == 1)
    {
      return true;
    }
  }

  /**
   * Serialize the session data stored in the database,
   * store it in a new array and return it to the controller
   * @return array
   */
  function get_db_session_data()
  {
    $query = $this->db->select('admin_data')->get('ci_sessions');
    $admin = array(); /* array to store the admin data we fetch */
    foreach ($query->result() as $row)
    {
      $udata = unserialize($row->admin_data);
      /* put data in array using adminname as key */
      $admin['adminname'] = $udata['adminname'];
      $admin['is_logged_in'] = $udata['is_logged_in'];
    }
    return $admin;
  }

  /**
   * Store the new admin's data into the database
   * @return boolean - check the insert
   */
  function create_member()
  {

    $this->db->where('adminname', $this->input->post('adminname'));
    $query = $this->db->get('admins');

    if($query->num_rows > 0){
      echo '<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>';
      echo "Adminname already taken";
      echo '</strong></div>';
    }else{

      $new_member_insert_data = array(
        'email_address' => $this->input->post('email_address'),
        'adminname' => $this->input->post('adminname'),
        'password' => md5($this->input->post('password'))
      );
      $insert = $this->db->insert('admins', $new_member_insert_data);
      return $insert;
    }

  }//create_member
}
