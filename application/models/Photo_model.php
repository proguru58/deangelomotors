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

    function add($photo)
    {
        $this->db->insert('photos', array(
            'owner'=>$this->session->userdata('userid'),
            'name'=>$photo
        ));
    }

    function delete($photoid)
    {
        $query = $this->db->get_where('photos', array('id'=>$photoid));
        $result = $query->result();
        $this->db->delete('photos', array('id'=>$photoid));
        return $result[0]->name;
    }
}