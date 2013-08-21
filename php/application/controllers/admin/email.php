<?php


/**
 * Description of email
 *
 * @author ngoalongkt
 */
class Email extends MY_Controller{
    
    var $navstack = null;
    var $emails = 'Email Config';
    
    public function __construct() {

        parent::__construct();
        
        $this->load->model('emailtemplate_model', 'emailtemplate');
        $this->data['menu_config'] = $this->menu_config_7;
        
       
        $user_session = $this->session->userdata('user');
        $this->data['user_session'] = $user_session;
        if (empty($user_session) || $user_session['permission'] != 'administrator') {
            redirect(site_url('home'));
        }
        
        
    }  
    
    public function manager(){
        $this->data['title'] = 'Manager Email';
        $this->view('admin/email/manager', 'admin');
    }
    
    
    public function emaillist($start = 0) {
        $posts = $this->input->post();
        $this->config->load('cya_config', TRUE);
        
        $dataWhere['searchby'] = $posts['searchby'];
        $limit = $this->config->item('limit_page');
        
        if (!empty($posts['asc'])) {
            $sort[$posts['sort']] = 'ASC';
        } else {
            $sort[$posts['sort']] = 'DESC';
        }
//       Begin pagination
        $this->load->library("pagination");
        $config = array();
        $config["total_rows"] = $this->emailtemplate->totalEmail($dataWhere);
        $config["base_url"] = admin_url('email/emaillist');
        $config["per_page"] = $limit;
        $page = $start;
        $config["uri_segment"] = 4;
        $config['num_links'] = 2;

        $config['first_link'] = "<img src=" . base_url() . "/img/datalist/nav_first.jpg />";
        $config['first_tag_open'] = '<div class="nav-button">';
        $config['first_tag_close'] = '</div>';
        $config['last_link'] = "<img src=" . base_url() . "/img/datalist/nav_last.jpg />";
        $config['last_tag_open'] = '<div class="nav-button">';
        $config['last_tag_close'] = '</div>';
        $config['cur_tag_open'] = "<div class='nav-button'><div class='nav-page nav-page-selected'>";
        $config['cur_tag_close'] = '</div></div>';
        $config['num_tag_open'] = "<div class='nav-button'><div class='nav-page'>";
        $config['num_tag_close'] = '</div></div>';
        $config['prev_tag_open'] = "<div class='nav-button'>";
        $config['prev_link'] = "<img src=" . base_url() . "/img/datalist/nav_prev.jpg />";
        $config['prev_tag_close'] = '</div>';
        $config['next_link'] = "<img src=" . base_url() . "/img/datalist/nav_next.jpg />";
        $config['next_tag_open'] = "<div class='nav-button'>";
        $config['next_tag_close'] = '</div>';
        $this->pagination->initialize($config);
        $json["links"] = $this->pagination->create_links();
//       End pagination

        $this->data['emails'] = $this->emailtemplate->listEmail($dataWhere, $limit, $start, $sort);
        $json['emails'] = $this->load->view('admin/email/emaillist', $this->data, true);
        echo json_encode($json);
    }
    
    public function profile($id = 0){
        $this->data['title'] = 'Manager Email';
        if (!empty($id))
            $this->data['emaildata'] = $this->emailtemplate->getEmailById($id);

        $msg = $this->session->flashdata('usermessage');
        if ($msg) {
            $this->data['usermessage'] = $msg;
        }
        $this->data['posts'] = array();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $posts = $this->input->post();
            $validationErrors = array();
            if ($posts['code'] == '') {
                $validationErrors['code'] = "Code cannot be blank";
            }
            if ($posts['subject'] == '') {
                $validationErrors['subject'] = "Subject cannot be blank";
            }
            
            $this->data['posts'] = $posts;
            foreach ($posts as $key => $val) {
                $this->data['emaildata']->$key = $val;
            }
            if (count($validationErrors) != 0) {
                $this->data['usermessage'] = array('error', 'darkred', 'Validation errors found', 'Please see below');
                $this->data['fielderrors'] = $validationErrors;
            } else {
                unset($posts['save-btn']);
                unset($posts['repassword']);
                $id = (int) $id;
                if (empty($id)) {
                    $id = $this->emailtemplate->insert($posts);
                    if (!empty($id))
                        $this->data['usermessage'] = array('success', 'green', 'Successfully saved ', '');
                    else
                        $this->data['usermessage'] = array('error', 'darkred', 'Error saved', '');
                    $this->session->set_flashdata(array('usermessage' => $this->data['usermessage']));
                    redirect(admin_url('email/profile/' . $id));
                } else {
                   
                    if ($this->emailtemplate->update($id, $posts))
                        $this->data['usermessage'] = array('success', 'green', 'Successfully saved', '');
                    else
                        $this->data['usermessage'] = array('error', 'darkred', 'Error saved', '');
                    $this->session->set_flashdata(array('usermessage' => $this->data['usermessage']));
                    redirect(admin_url('email/profile/' . $id));
                }
            }
        }
        $this->data['main_content'] = 'email/profile';
        $this->view('admin/email/profile', 'admin');
    }
}

?>
