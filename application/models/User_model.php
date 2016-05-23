<?php
/**
 * Created by PhpStorm.
 * User: Daniel
 * Date: 5/20/16
 * Time: 4:34 AM
 */

class User_model extends CI_Model {

    public function __construct()
    {
        // Call the CI_Model constructor
        parent::__construct();
    }

    function register($email, $code)
    {
        $new_user = array (
            'email' => $email,
            'code' => $code
        );

        $this->db->insert('users', $new_user);
        $user_id = $this->db->insert_id();

        return $user_id;
    }

    function login($email, $code)
    {
        $query = $this->db->get_where('users', array('email'=>$email, 'code'=>$code));

        if($query->num_rows()==0) return false;
        else {
            $result = $query->result();
            $userid = $result[0]->id;

            return $userid;
        }
    }

    function update_email($id, $email)
    {
        $data = array(
          'email' => $email
        );

        $this->db->where('id', $id);
        $this->db->update('users', $data);
    }

    function get_code($id)
    {
        $query = $this->db->get_where('users', array('id'=>$id));

        if($query->num_rows()==0) return false;
        else {
            $result = $query->result();
            $code = $result[0]->code;

            return $code;
        }
    }

    function check_email($email)
    {
        $query = $this->db->get_where('users', array('email'=>$email));
        if($query->num_rows()==0)
            return true;
        else
            return false;
    }
}