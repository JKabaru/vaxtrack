<?php
class User_model extends CI_Model {
    public function authenticate($username, $password) {
        // Query the database to check if the username and password combination is valid
        $query = $this->db->get_where('users', ['username' => $username, 'password' => $password]);
        $user = $query->row();

        if ($user) {
            // Authentication successful
            return $user->id;
        } else {
            // Authentication failed
            return false;
        }
    }
}
?>
