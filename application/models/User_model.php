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

    function register($email, $code, $limit)
    {
        $new_user = array (
            'email' => $email,
            'code' => $code,
            'limit' => $limit
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

    function increase_limit($id, $count)
    {
        $query = $this->db->get_where('users', array('id'=>$id));

        if($query->num_rows()==0) return false;
        else {
            $result = $query->result();
            $limit = $result[0]->limit;

            $data = array(
              'limit' => $limit + $count
            );

            $this->db->where('id', $id);
            $this->db->update('users', $data);
        }
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

    function get_email($id)
    {
        $query = $this->db->get_where('users', array('id'=>$id));

        if($query->num_rows()==0) return false;
        else {
            $result = $query->result();
            $email = $result[0]->email;

            return $email;
        }
    }

    function get_limit($id)
    {
        $query = $this->db->get_where('users', array('id'=>$id));

        if($query->num_rows()==0) return 0;
        else {
            $result = $query->result();
            $limit = $result[0]->limit;

            return $limit;
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