<?php
class Login extends CI_Controller {
    public function index() {
        // Display the login form view
        $this->load->view('login_view');
    }

    public function process_login() {
        $username = $this->input->post('username');
        $password = $this->input->post('password');
    
        // Load the User_model
        $this->load->model('User_model');
    
        // Call the authenticate method in the User_model
        $user_id = $this->User_model->authenticate($username, $password);
    
        if ($user_id !== false) {
            // Authentication successful, redirect to the authenticated user's dashboard or home page
            redirect('dashboard');
        } else {
            // Authentication failed, show an error message or redirect back to the login form
            // ...
        }
    }
    
    
}
?>
