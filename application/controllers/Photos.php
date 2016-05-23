<?php

class Photos extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('user_model');
    $this->load->model('photo_model');
    $this->load->helper('file');

    $this->userid = $this->session->userdata('userid');
    if (!isset($this->userid) or $this->userid == '') redirect('users/login');
  }

  function index()
  {
    $data['photos'] = $this->photo_model->get($this->userid);
    $this->load->view('layout/header');
    $this->load->view('photos/index', $data);
    $this->load->view('layout/footer');
  }

  function upload()
  {
    $this->load->view('layout/header');
    $this->load->view('photos/upload');
    $this->load->view('layout/footer');
  }

  // upload file post
  function go()
  {

    $image_file_types = array('image/png', 'image/gif', 'image/jpeg');

    // check size limist 10MB and presence and type
    if ($_FILES['photo']['size'] <= 0)
      $this->session->set_flashdata('result', array('message' => 'Choose photo file to uploads.','class' => 'danger'));
    elseif (!in_array($_FILES['photo']['type'], $image_file_types))
      $this->session->set_flashdata('result', array('message' => 'Image file must be one of the following types: png, gif, jpeg.','class' => 'danger'));
    elseif ($_FILES['photo']['size'] > 10000000)
      $this->session->set_flashdata('result', array('message' => 'Choose your photo file less than 10MB.','class' => 'danger'));

    elseif (isset($_FILES['photo'])) {

      $file = read_file($_FILES['photo']['tmp_name']);
      $name = basename($_FILES['photo']['name']);

      write_file('photos/' . $name, $file);

      $this->photo_model->add($name);
      $this->session->set_flashdata('result', array('message' => 'Photo has been uploaded successfully.','class' => 'success'));
      redirect('photos/index');
      return;
    }

    redirect('photos/upload');
  }

  function delete($id)
  {
    //This deletes the file from the database, before returning the name of the file.
    $name = $this->photo_model->delete($id);
    unlink('photos/' . $name);
    redirect('photos/index');
  }
}