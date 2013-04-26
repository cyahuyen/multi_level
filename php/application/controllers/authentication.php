<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Provides interface methods for user authentication
 * @author	Dean Gleeson <dean.gleeson@pragmaticsystems.com.au>
 * @date	21/04/2012
 */
class Authentication extends MY_Controller 
{

    function __construct() 
    {
    	parent::__construct();
		$this->load->model('user_model', 'user');
    }

    public function index() 
    {
        $this->navigation->loadSigninView();
    }

    public function signin() 
    {
    	$username = $this->input->post('username');
    	$password = $this->input->post('password');
    	
    	$validationErrors = array();
    	
    	/* check username val */
    	if ($username == null || trim($username) == "")
    		$validationErrors["username"] = "Sign-in name is required for sign-in authentication";

    	/* check password val */
    	if ($password == null || trim($password) == "")
    		$validationErrors["password"] = "Password is required for sign-in authentication";

    	/* verify username/password */
    	if (count($validationErrors) == 0) 
    	{
    		$usersForCreds = $this->user->verifySignin($username, $password);
    		if ($usersForCreds->num_rows() != 1) 
    		{
    			$validationErrors["username"] = "Sign-in name / password could not be verified";
    		} 
    		else 
    		{
    			foreach ($usersForCreds->result() as $row) 
    			{
    				$usertype = $row->usertype;
    				$id = $row->id;
    				$username = $row->username;
    				$password = $row->password;
    				$personname = $row->fullname;
    				$email = $row->password;
    			}
    			$sessiondata = array(
    					'usertype' => $usertype,
    					'userid' => $id,
    					'username' => $username,
    					'password' => $password,
    					'personname' => $personname,
    					'email' => $email,
    					'is_logged_in' => true
    			);
    			$this->session->set_userdata($sessiondata);
    		}
    	}
    	
    	if (count($validationErrors) == 0)
        {
        	$data['user'] = $this->user->getSessionUserDetails();
    		$this->navigation->loadHomeView($data);
    	}
    	else 
    	{
    		$this->navigation->loadSigninView(array(
    				'usermessage' => array('error', 'darkred', 'Sign-in unsuccessful', 'Sign-in name / password could not be verified'),
    				'fielderrors' => $validationErrors
    		));
    	}
    	
    }

    public function signout() {
        $this->session->sess_destroy();
        $this->navigation->loadSigninView(array(
            'usermessage' => array('success', 'green', 'Successful sign-out', 'We hope you enjoyed your experience')
        ));
    }

    public function resetpassword() {
        $signinName = $this->input->post('reset-username');
        $resetPassword = $this->user->resetPassword($signinName);
        if ($resetPassword == 'error') {
            $this->navigation->loadSigninView(array(
                'usermessage' => array('error', 'darkred', 'Password reset unsuccessful', 'Invalid sign-in name'),
                'fielderrors' => array('resetusername' => 'Invalid sign-in name')
            ));
        } else {
        	/*
            $this->load->library('email');
            $this->email->from('abhishek@gmail.com', 'Abhishek');
            $this->email->to($this->input->post('signin-reset-name'));
            $this->email->subject('New Password');
            $this->email->message("your new password is $resetPassword");
            $this->email->send();
			*/
            $this->navigation->loadSigninView(array(
                'usermessage' => array('success', 'green', 'Password reset successful', 'Reset password sent, please check your email')
            ));
        }
    }

}