<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Live extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('photoshoot_model');
  }

  function counter()
  {
    $counter = 25000 + $this->photoshoot_model->counter();
    header('Content-Type: application/json');
    echo json_encode($counter);
  }
}
