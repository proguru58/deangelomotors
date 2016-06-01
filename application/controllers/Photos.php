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
    if($this->photo_model->count($this->userid) >= $this->user_model->get_limit($this->userid)) {
      $this->session->set_flashdata('result', array('message' => 'You have already reached to your limit. Please pay again to upload more photos.', 'class' => 'info'));
      redirect('users/paymore');
      return;
    }

    $this->load->view('layout/header');
    $this->load->view('photos/upload');
    $this->load->view('layout/footer');
  }

  function upload_success()
  {
    $this->load->view('layout/header');
    $this->load->view('photos/upload_success');
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

      $this->load->library('Utils');

      $file = read_file($_FILES['photo']['tmp_name']);
      $name = $this->utils->generate_random_string(12).'_'.basename($_FILES['photo']['name']);

      write_file('photos/' . $name, $file);

      $this->photo_model->add($name);
      $this->session->set_flashdata('result', array('message' => 'Photo has been uploaded successfully.','class' => 'success'));
      redirect('photos/upload_success');
      return;
    }

    redirect('photos/upload');
  }

  function delete($id)
  {
    //This deletes the file from the database, before returning the name of the file.
    $slug = $this->photo_model->delete($id);
    unlink('photos/' . $slug);
    redirect('photos/index');
  }
}