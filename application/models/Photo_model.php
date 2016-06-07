<?php
/**
 * Created by PhpStorm.
 * User: Daniel
 * Date: 5/20/16
 * Time: 4:39 AM
 */

class Photo_model extends CI_Model {

    public function __construct()
    {
        // Call the CI_Model constructor
        parent::__construct();
    }

    function get($userid)
    {
        $query = $this->db->get_where('photos', array('owner'=>$userid));
        return $query->result();
    }

    function count($userid)
    {
        $query = $this->db->get_where('photos', array('owner'=>$userid));
        $result = $query->result();
        return count($result);
    }

    function add($name)
    {
        $this->db->insert('photos', array(
            'owner'=>$this->session->userdata('userid'),
            'name'=>$name
        ));
    }

    // delete record and return file name to be used to store file in photo folder
    function delete($photoid)
    {
        $query = $this->db->get_where('photos', array('id'=>$photoid));
        $result = $query->result();
        $this->db->delete('photos', array('id'=>$photoid));
        return $result[0]->name;
    }

    /* admin */

    /**
     * Get photo by his is
     * @param int $photo_id
     * @return array
     */
    public function get_photo_by_id($id)
    {
        $this->db->select('*');
        $this->db->from('photos');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->result_array();
    }

    /**
     * Fetch photos data from the database
     * possibility to mix search, filter and order
     * @param int $manufacuture_id
     * @param string $search_string
     * @param strong $order
     * @param string $order_type
     * @param int $limit_start
     * @param int $limit_end
     * @return array
     */
    public function get_photos($participant_id=null, $search_string=null, $order=null, $order_type='Asc', $limit_start, $limit_end)
    {

        $this->db->select('photos.id');
        $this->db->select('photos.name');
        $this->db->select('photos.owner');
        $this->db->select('users.email as participant_email');
        $this->db->from('photos');
        if($participant_id != null && $participant_id != 0){
            $this->db->where('owner', $participant_id);
        }
        if($search_string){
            $this->db->like('name', $search_string);
        }

        $this->db->join('users', 'photos.owner = users.id', 'left');

        $this->db->group_by('photos.id');

        if($order){
            $this->db->order_by($order, $order_type);
        }else{
            $this->db->order_by('id', $order_type);
        }


        $this->db->limit($limit_start, $limit_end);
        //$this->db->limit('4', '4');


        $query = $this->db->get();

        return $query->result_array();
    }

    /**
     * Count the number of rows
     * @param int $participant_id
     * @param int $search_string
     * @param int $order
     * @return int
     */
    function count_photos($participant_id=null, $search_string=null, $order=null)
    {
        $this->db->select('*');
        $this->db->from('photos');
        if($participant_id != null && $participant_id != 0){
            $this->db->where('owner', $participant_id);
        }
        if($search_string){
            $this->db->like('name', $search_string);
        }
        if($order){
            //$this->db->order_by($order, 'Asc');
        }else{
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
    function store_photo($data)
    {
        $insert = $this->db->insert('photos', $data);
        return $insert;
    }

    /**
     * Update photo
     * @param array $data - associative array with data to store
     * @return boolean
     */
    function update_photo($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('photos', $data);
        $report = array();
        $report['error'] = $this->db->_error_number();
        $report['message'] = $this->db->_error_message();
        if($report !== 0){
            return true;
        }else{
            return false;
        }
    }

    /**
     * Delete photo
     * @param int $id - photo id
     * @return boolean
     */
    function delete_photo($id){
        $this->db->where('id', $id);
        $this->db->delete('photos');
    }
}