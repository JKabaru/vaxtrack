<?php
class Register extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('user_model');
    }

    public function index() {
        $this->load->view('register_form');
    }

    public function process() {
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        // Add more validation rules as needed

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('register_form');
        } else {
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            // Get other form input values as needed

            // Call the user_model to register the user
            $user_id = $this->user_model->register($username, $password);

            // Redirect or show success message
            if ($user_id) {
                redirect('login');
            } else {
                // Registration failed, show an error message
                // ...
            }
        }
    }
}
?>
