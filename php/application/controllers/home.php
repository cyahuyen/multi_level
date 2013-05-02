<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Home page controller
 * @author	Dean Gleeson <dean.gleeson@pragmaticsystems.com.au>
 * @date	21/04/2013
 */
class Home extends MY_Controller 
{

    public function __construct() 
    {
        
        parent::__construct();
        if (!$this->session->userdata('is_logged_in')) 
        {
            redirect('authentication');
        } 
        else 
        {
            $this->load->model('user_model', 'user');
        }
    }

    public function index() 
    {
    	$data['user'] = $this->user->getSessionUserDetails();
    	$this->navigation->loadHomeView($data);
    }
    
}

?>