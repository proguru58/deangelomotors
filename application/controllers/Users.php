<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('user_model');
  }

  function index()
  {
    $this->load->view('layout/header');
    $this->load->view('users/login');
    $this->load->view('layout/footer');
  }

  function login()
  {
    $this->load->view('layout/header');
    $this->load->view('users/login');
    $this->load->view('layout/footer');
  }

  function verify_email()
  {
    if (isset($_POST['email'])) {
      // get and update user info through session
      $email = $_POST['email'];
      $this->userid = $this->session->userdata('userid');
      $this->user_model->update_email($this->userid, $email);
      $code = $this->user_model->get_code($this->userid);

      // resend email
      $this->send_welcome_email($email, $code);
      $this->session->set_flashdata('result', array('message' => 'Email has been resent successfully.','class' => 'success'));

      redirect('users/verify_email');
    } else {
      $this->load->view('layout/header');
      $this->load->view('users/verify_email');
      $this->load->view('layout/footer');
    }
  }

  function register()
  {
    if (isset($_POST['email'])) {
      $current_user = NULL;
      $email = $_POST['email'];
      $credit_card_number = $_POST['credit_card']['credit_card_number'];
      $credit_card_expiration_month = $_POST['credit_card']['credit_card_expiration_month'];
      $credit_card_expiration_year = $_POST['credit_card']['credit_card_expiration_year'];
      $cvv = $_POST['credit_card']['cvv'];

      // submit payment via authorize.net
      $this->load->library('authorize_net');
      $auth_net = array(
        'x_card_num'			=> $credit_card_number,
        'x_exp_date'			=> $credit_card_expiration_month . '/' . $credit_card_expiration_year,
        'x_card_code'			=> $cvv,
        'x_description'		=> 'participant join competition billing',
        'x_amount'				=> '20',
      );
      $this->authorize_net->setData($auth_net);
      if( $this->authorize_net->authorizeAndCapture() )
      {
        $code = $this->generate_random_string(32);
        $current_user = $this->user_model->register($email, $code);

        // set session current user.
        $this->session->set_userdata(array('userid' => $current_user));

        // send email
        $this->send_welcome_email($email, $code);

        $this->session->set_flashdata('result', array('message' => 'Payment has been processed successfully.','class' => 'success'));
        redirect('users/verify_email');
      }
      else
      {
        $this->session->set_flashdata('result', array('message' => 'Unable to process the payment. Messages: '.$this->authorize_net->getError(),'class' => 'danger'));
        redirect('users/register');
      }

    } else {
      $this->load->view('layout/header');
      $this->load->view('users/register');
      $this->load->view('layout/footer');
    }
  }

  function go()
  {
    $email = $_POST['email'];
    $code = $_POST['code'];

    $results = $this->user_model->login($email, $code);

    if ($results == false)
    {
      $this->session->set_flashdata('result', array('message' => 'Unable to login. Please enter correct email and verification code.','class' => 'danger'));
      redirect('users/login');
    }
    else {
      $this->session->set_userdata(array('userid' => $results));
      $this->session->set_flashdata('result', array('message' => 'You have been successfully logged in.','class' => 'success'));
      redirect('photos/index');
    }
  }

  function check_email()
  {
    $email = $_GET['email'];
    $email_exist = $this->user_model->check_email($email);
    header('Content-Type: application/json');
    echo json_encode($email_exist);
  }

  function logout()
  {
    $this->session->set_userdata(array('userid' => ''));
    redirect('users/login');
  }

  function generate_random_string($length = 32) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
      $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
  }

  function send_welcome_email($email, $code)
  {
    $msg = <<<EOT
<!DOCTYPE html>
<html>
  <head>
      <meta content='text/html; charset=UTF-8' http-equiv='Content-Type' />
    </head>
  <body>
    <h1>Welcome to Our Photoshoot Competition</h1>
    <p>
        You have been successfully subscribed to deangelomotors.com,
        your participant verification code is : $code.<br>
      </p>
    <p>
        To upload your photo in the contest, just follow this link: <%= @url %>.
      </p>
    <p>Thanks for joining and have a great day!</p>
  </body>
</html>
EOT;

    // send welcome email to users with code
    $this->load->library('email');

    $this->email->from('info@deangelomotors.com', 'DeAngeloMotors');
    $this->email->to($email);
    $this->email->subject('Welcome to International Photoshoot Competition');
    $this->email->message($msg);

    $this->email->send();
    $this->email->print_debugger();
  }
}
