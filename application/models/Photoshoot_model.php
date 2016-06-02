<?php
/**
 * Created by PhpStorm.
 * User: Daniel
 * Date: 5/20/16
 * Time: 4:39 AM
 */

class Photoshoot_model extends CI_Model {

    public function __construct()
    {
        // Call the CI_Model constructor
        parent::__construct();
    }

    // delete record and return file name to be used to store file in photo folder
    function counter()
    {
        $query = $this->db->get_where('photoshoot', array('id'=>1));
        $result = $query->result();
        return $result[0]->counter;
    }
}