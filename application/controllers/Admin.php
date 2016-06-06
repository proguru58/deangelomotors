<?php

class Admin extends CI_Controller {

  /**
   * Check if the user is logged in, if he's not,
   * send him to the login page
   * @return void
   */
  function index()
  {
    if($this->session->userdata('is_logged_in')){
      redirect('admin/photos');
    }else{
      $this->load->view('admin/login');
    }
  }

  function login()
  {
    $this->load->view('admin/login');
  }

  /**
   * encript the password
   * @return mixed
   */
  function __encrip_password($password) {
    return md5($password);
  }

  /**
   * check the username and the password with the database
   * @return void
   */
  function validate_credentials()
  {
    $this->load->model('Admin_model');

    $adminname = $this->input->post('adminname');
    $password = $this->__encrip_password($this->input->post('password'));

    $is_valid = $this->Admin_model->validate($adminname, $password);

    if($is_valid)
    {
      $data = array(
        'adminname' => $adminname,
        'is_logged_in' => true
      );
      $this->session->set_userdata($data);
      redirect('admin/photos');
    }
    else // incorrect adminname or password
    {
      $data['message_error'] = TRUE;
      $this->load->view('admin/login', $data);
    }
  }

  /**
   * The method just loads the signup view
   * @return void
   */
  function signup()
  {
    $this->load->view('admin/signup_form');
  }

  /**
   * Create new user and store it in the database
   * @return void
   */
  function create_member()
  {
    $this->load->library('form_validation');

    // field name, error message, validation rules
    $this->form_validation->set_rules('email_address', 'Email Address', 'trim|required|valid_email');
    $this->form_validation->set_rules('adminname', 'Adminname', 'trim|required|min_length[4]');
    $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[4]|max_length[32]');
    $this->form_validation->set_rules('password2', 'Password Confirmation', 'trim|required|matches[password]');
    $this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');

    if($this->form_validation->run() == FALSE)
    {
      $this->load->view('admin/signup_form');
    }

    else
    {
      $this->load->model('Admin_model');

      if($query = $this->Admin_model->create_member())
      {
        $this->load->view('admin/signup_successful');
      }
      else
      {
        $this->load->view('admin/signup_form');
      }
    }
  }

  /**
   * Destroy the session, and logout the user.
   * @return void
   */
  function logout()
  {
    $this->session->sess_destroy();
    redirect('admin');
  }

}