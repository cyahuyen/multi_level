<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Welcome extends CI_Controller {

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     * 	- or -  
     * 		http://example.com/index.php/welcome/index
     * 	- or -
     * Since this controller is set as the default controller in 
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see http://codeigniter.com/user_guide/general/urls.html
     */
    public function index() {
        if ($this->session->userdata('is_logged_in')) {
            $this->load->view('userarea');
        } else {
            // $this->load->view('login');
            $this->loadSigninView(null);
        }
    }

    private function loadSigninView($data) {
        $this->load->library('template');
        $this->template->load('public', 'signin', $data);
    }

    public function login() {
        if ($this->session->userdata('is_logged_in')) {
            $this->load->view('userarea');
        } else {
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            if ($username == '') {
                $data = array(
                    'msg' => "Username can't be blank",
                    'usermessage' => array('error', 'darkred', 'Sign-in unsuccessful', 'Sign-in name cannot be blank'),
                    'fielderrors' => array('signin-name' => 'Sign-in name cannot be blank')
                );
                $this->load->view('login', $data);
                return false;
            } elseif ($password == '') {
                $data = array(
                    'msg' => "Password can't be blank",
                    'usermessage' => array('error', 'darkred', 'Sign-in unsuccessful', 'Password cannot be blank'),
                    'fielderrors' => array('signin-pass' => 'Password cannot be blank')
                );
                $this->load->view('login', $data);
                return false;
            } else {
                $this->load->model('userlogin');
                $login = $this->userlogin->verifylogin();
                if ($login->num_rows() == 1) {
                    $email = '';
                    foreach ($login->result() as $row) {
                        $username = $row->username;
                        $password = $row->password;
                        $email = $row->password;
                    }
                    $data = array(
                        'name' => $username,
                        'email' => $email,
                        'is_logged_in' => true
                    );
                    $this->session->set_userdata($data);
                    $this->load->view('userarea', $data);
                } else {
                    $data = array(
                        'msg' => "Invalid username password..",
                        'usermessage' => array('error', 'darkred', 'Sign-in unsuccessful', 'Invalid sign-in name or password')
                    );
                    $this->load->view('login', $data);
                    return false;
                }
            }
        }
    }

    function forgotpass() {
        $this->load->model('userlogin');
        $login = $this->userlogin->changepass();
        if ($login == 'error') {
            $data = array(
                'msg' => "Invalid email-id..",
                'usermessage' => array('error', 'darkred', 'Password reset unsuccessful', 'Invalid email address'),
                'fielderrors' => array('signin-reset-name' => 'Invalid email address')
            );
            $this->load->view('login', $data);
            return false;
        } else {
            $this->load->library('email');
            $this->email->from('abhishek@gmail.com', 'Your Name');
            $this->email->to($this->input->post('email'));
            $this->email->subject('New Password');
            $this->email->message('your new password is $login');
            $this->email->send();
            $data = array(
                'fsmsg' => "New password sent to your email-id..",
                'usermessage' => array('success', 'green', 'Password reset successful', 'Your new password has been sent to you email')
            );
            $this->load->view('login', $data);
            return false;
        }
    }

    function logout() {
        $this->session->sess_destroy();
        $data = array(
            'msg' => 'Successfully Logged out...',
            'usermessage' => array('success', 'green', 'Successful sign-out', 'We hope you enjoyed your experience')
        );
        $this->load->view('login', $data);
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */