<?php

/**
 * Created by PhpStorm.
 * User: Daniel
 * Date: 5/20/16
 * Time: 4:34 AM
 */
class User_model extends CI_Model
{

  public function __construct()
  {
    // Call the CI_Model constructor
    parent::__construct();
  }

  function register($email, $code, $limit)
  {
    $new_user = array(
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
    $query = $this->db->get_where('users', array('email' => $email, 'code' => $code));

    if ($query->num_rows() == 0) return false;
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
    $query = $this->db->get_where('users', array('id' => $id));

    if ($query->num_rows() == 0) return false;
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
    $query = $this->db->get_where('users', array('id' => $id));

    if ($query->num_rows() == 0) return false;
    else {
      $result = $query->result();
      $code = $result[0]->code;

      return $code;
    }
  }

  function get_code_by_email($email)
  {
    $query = $this->db->get_where('users', array('email' => $email));

    if ($query->num_rows() == 0) return false;
    else {
      $result = $query->result();
      $code = $result[0]->code;

      return $code;
    }
  }

  function get_email($id)
  {
    $query = $this->db->get_where('users', array('id' => $id));

    if ($query->num_rows() == 0) return false;
    else {
      $result = $query->result();
      $email = $result[0]->email;

      return $email;
    }
  }

  function get_limit($id)
  {
    $query = $this->db->get_where('users', array('id' => $id));

    if ($query->num_rows() == 0) return 0;
    else {
      $result = $query->result();
      $limit = $result[0]->limit;

      return $limit;
    }
  }

  function check_email($email)
  {
    $query = $this->db->get_where('users', array('email' => $email));
    if ($query->num_rows() == 0)
      return true;
    else
      return false;
  }

  /* admin */
  /**
   * Get product by his is
   * @param int $product_id
   * @return array
   */
  public function get_participant_by_id($id)
  {
    $this->db->select('*');
    $this->db->from('users');
    $this->db->where('id', $id);
    $query = $this->db->get();
    return $query->result_array();
  }

  /**
   * Fetch participantrs data from the database
   * possibility to mix search, filter and order
   * @param string $search_string
   * @param strong $order
   * @param string $order_type
   * @param int $limit_start
   * @param int $limit_end
   * @return array
   */
  public function get_participants($search_string = null, $order = null, $order_type = 'Asc', $limit_start = null, $limit_end = null)
  {

    $this->db->select('*');
    $this->db->from('users');

    if ($search_string) {
      $this->db->like('email', $search_string);
    }
    $this->db->group_by('id');

    if ($order) {
      $this->db->order_by($order, $order_type);
    } else {
      $this->db->order_by('id', $order_type);
    }

    if ($limit_start && $limit_end) {
      $this->db->limit($limit_start, $limit_end);
    }

    if ($limit_start != null) {
      $this->db->limit($limit_start, $limit_end);
    }

    $query = $this->db->get();

    return $query->result_array();
  }

  /**
   * Count the number of rows
   * @param int $search_string
   * @param int $order
   * @return int
   */
  function count_participants($search_string = null, $order = null)
  {
    $this->db->select('*');
    $this->db->from('users');
    if ($search_string) {
      $this->db->like('email', $search_string);
    }
    if ($order) {
      $this->db->order_by($order, 'Asc');
    } else {
      $this->db->order_by('id', 'Asc');
    }
    $query = $this->db->get();
    return $query->num_rows();
  }

  /**
   * Store the new item into the database
   * @param array $data - associative array with data to store
   * @return boolean
   */
  function store_participant($data)
  {
    $insert = $this->db->insert('users', $data);
    return $insert;
  }

  /**
   * Update participant
   * @param array $data - associative array with data to store
   * @return boolean
   */
  function update_participant($id, $data)
  {
    $this->db->where('id', $id);
    $this->db->update('users', $data);
    $report = array();
    $report['error'] = $this->db->_error_number();
    $report['message'] = $this->db->_error_message();
    if ($report !== 0) {
      return true;
    } else {
      return false;
    }
  }

  /**
   * Delete participantr
   * @param int $id - participant id
   * @return boolean
   */
  function delete_participant($id)
  {
    $this->db->where('id', $id);
    $this->db->delete('users');
  }
}