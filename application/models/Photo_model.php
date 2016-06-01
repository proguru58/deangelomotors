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
}