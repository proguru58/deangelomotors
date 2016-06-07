<?php

class Admin_photos extends CI_Controller
{

  /**
   * Responsable for auto load the model
   * @return void
   */
  public function __construct()
  {
    parent::__construct();
    $this->load->model('photo_model');
    $this->load->model('user_model');

    if (!$this->session->userdata('is_logged_in')) {
      redirect('admin/login');
    }
  }

  /**
   * Load the main view with all the current model model's data.
   * @return void
   */
  public function index()
  {
    //all the posts sent by the view
    $participant_id = $this->input->post('participant_id');
    $search_string = $this->input->post('search_string');
    $order = $this->input->post('order');
    $order_type = $this->input->post('order_type');

    //pagination settings
    $config['per_page'] = 5;
    $config['base_url'] = base_url() . 'admin/photos';
    $config['use_page_numbers'] = TRUE;
    $config['num_links'] = 20;
    $config['full_tag_open'] = '<ul>';
    $config['full_tag_close'] = '</ul>';
    $config['num_tag_open'] = '<li>';
    $config['num_tag_close'] = '</li>';
    $config['cur_tag_open'] = '<li class="active"><a>';
    $config['cur_tag_close'] = '</a></li>';

    //limit end
    $page = $this->uri->segment(3);

    //math to get the initial record to be select in the database
    $limit_end = ($page * $config['per_page']) - $config['per_page'];
    if ($limit_end < 0) {
      $limit_end = 0;
    }

    //if order type was changed
    if ($order_type) {
      $filter_session_data['order_type'] = $order_type;
    } else {
      //we have something stored in the session?
      if ($this->session->userdata('order_type')) {
        $order_type = $this->session->userdata('order_type');
      } else {
        //if we have nothing inside session, so it's the default "Asc"
        $order_type = 'Asc';
      }
    }
    //make the data type var avaible to our view
    $data['order_type_selected'] = $order_type;


    //we must avoid a page reload with the previous session data
    //if any filter post was sent, then it's the first time we load the content
    //in this case we clean the session filter data
    //if any filter post was sent but we are in some page, we must load the session data

    //filtered && || paginated
    if ($participant_id !== false && $search_string !== false && $order !== false || $this->uri->segment(3) == true) {

      /*
      The comments here are the same for line 79 until 99

      if post is not null, we store it in session data array
      if is null, we use the session data already stored
      we save order into the the var to load the view with the param already selected
      */

      if ($participant_id !== 0) {
        $filter_session_data['participant_selected'] = $participant_id;
      } else {
        $participant_id = $this->session->userdata('participant_selected');
      }
      $data['participant_selected'] = $participant_id;

      if ($search_string || $search_string == '') {
        $filter_session_data['search_string_selected'] = $search_string;
      } else {
        $search_string = $this->session->userdata('search_string_selected');
      }
      $data['search_string_selected'] = $search_string;

      if ($order) {
        $filter_session_data['order'] = $order;
      } else {
        $order = $this->session->userdata('order');
      }
      $data['order'] = $order;

      //save session data into the session
      $this->session->set_userdata($filter_session_data);

      //fetch participants data into arrays
      $data['participants'] = $this->user_model->get_participants();

      $data['count_photos'] = $this->photo_model->count_photos($participant_id, $search_string, $order);
      $config['total_rows'] = $data['count_photos'];

      //fetch sql data into arrays
      if ($search_string) {
        if ($order) {
          $data['photos'] = $this->photo_model->get_photos($participant_id, $search_string, $order, $order_type, $config['per_page'], $limit_end);
        } else {
          $data['photos'] = $this->photo_model->get_photos($participant_id, $search_string, '', $order_type, $config['per_page'], $limit_end);
        }
      } else {
        if ($order) {
          $data['photos'] = $this->photo_model->get_photos($participant_id, '', $order, $order_type, $config['per_page'], $limit_end);
        } else {
          $data['photos'] = $this->photo_model->get_photos($participant_id, '', '', $order_type, $config['per_page'], $limit_end);
        }
      }

    } else {

      //clean filter data inside section
      $filter_session_data['participant_selected'] = null;
      $filter_session_data['search_string_selected'] = null;
      $filter_session_data['order'] = null;
      $filter_session_data['order_type'] = null;
      $this->session->set_userdata($filter_session_data);

      //pre selected options
      $data['search_string_selected'] = '';
      $data['participant_selected'] = 0;
      $data['order'] = 'id';

      //fetch sql data into arrays
      $data['participants'] = $this->user_model->get_participants();
      $data['count_photos'] = $this->photo_model->count_photos();
      $data['photos'] = $this->photo_model->get_photos('', '', '', $order_type, $config['per_page'], $limit_end);
      $config['total_rows'] = $data['count_photos'];

    }//!isset($participant_id) && !isset($search_string) && !isset($order)

    //initializate the panination helper
    $this->pagination->initialize($config);

    //load the view
    $data['main_content'] = 'admin/photos/list';
    $this->load->view('admin/includes/template', $data);

  }//index

  public function add()
  {
    //if save button was clicked, get the data sent via post
    if ($this->input->server('REQUEST_METHOD') === 'POST') {

      //form validation
      $this->form_validation->set_rules('file', 'file', 'required');
      $this->form_validation->set_rules('participant_id', 'participant_id', 'required');
      $this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');

      //if the form has passed through the validation
      if ($this->form_validation->run()) {
        $data_to_store = array(
          'name' => $this->input->post('file'),
          'participant_id' => $this->input->post('participant_id')
        );
        //if the insert has returned true then we show the flash message
        if ($this->photo_model->store_photo($data_to_store)) {
          $data['flash_message'] = TRUE;
        } else {
          $data['flash_message'] = FALSE;
        }

      }

    }
    //fetch users data to populate the select field
    $data['users'] = $this->user_model->get_participantrs();
    //load the view
    $data['main_content'] = 'admin/photos/add';
    $this->load->view('admin/includes/template', $data);
  }

  /**
   * Update item by his id
   * @return void
   */
  public function update()
  {
    //photo id
    $id = $this->uri->segment(4);

    //if save button was clicked, get the data sent via post
    if ($this->input->server('REQUEST_METHOD') === 'POST') {
      //form validation
      $this->form_validation->set_rules('file', 'file', 'required');
      $this->form_validation->set_rules('participant_id', 'participant_id', 'required');
      $this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
      //if the form has passed through the validation
      if ($this->form_validation->run()) {

        $data_to_store = array(
          'name' => $this->input->post('file'),
          'participant_id' => $this->input->post('participant_id')
        );
        //if the insert has returned true then we show the flash message
        if ($this->photo_model->update_photo($id, $data_to_store) == TRUE) {
          $this->session->set_flashdata('flash_message', 'updated');
        } else {
          $this->session->set_flashdata('flash_message', 'not_updated');
        }
        redirect('admin/photos/update/' . $id . '');

      }//validation run

    }

    //if we are updating, and the data did not pass trough the validation
    //the code below wel reload the current data

    //photo data
    $data['photo'] = $this->photo_model->get_photo_by_id($id);
    //fetch users data to populate the select field
    $data['participants'] = $this->user_model->get_participants();
    //load the view
    $data['main_content'] = 'admin/photos/edit';
    $this->load->view('admin/includes/template', $data);

  }//update

  /**
   * Delete photo by his id
   * @return void
   */
  public function delete()
  {
    //photo id
    $id = $this->uri->segment(4);
    $this->photo_model->delete_photo($id);
    redirect('admin/photos');
  }//edit

}