<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Faq manager page controller
 * @author	Dean Gleeson <dean.gleeson@pragmaticsystems.com.au>
 * @date	21/04/2013
 */
class Adminfaq extends MY_Controller {

    var $navstack = null;

    public function __construct() {

        parent::__construct();

        $this->load->model('user_model', 'user');
        $this->data['menu_config'] = $this->menu_config_10;

        $this->load->model('question_model', 'question');
        $this->load->model('answer_model', 'answer');


        $user_session = $this->session->userdata('user');
        $this->data['user_session'] = $user_session;
        if (empty($user_session) || $user_session['permission'] != 'administrator') {
            redirect(site_url('home'));
        }
    }

    public function index() {
        $this->data['main_content'] = 'adminfaq/index';
        $this->data['title'] = 'Multi Level Marketing';
        $this->load->View('administrator', $this->data);
    }

    public function questionlist($page = 0) {
        $posts = $this->input->post();
        $json = array();
        if ($posts) {
            $dataWhere = array();
            $sort = array();
            if (isset($posts['status']) && $posts['status'] != 'all') {
                $dataWhere['admin_status'] = $posts['status'];
            }
            $limit = $this->config->item('limit_page', 'my_config');
            $start = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
            if (!empty($posts['asc'])) {
                $sort[$posts['sort']] = 'ASC';
            } else {
                $sort[$posts['sort']] = 'DESC';
            }

//          Begin pagination
            $this->load->library("pagination");
            $config = array();
            $config["total_rows"] = $this->question->totalQuestion($dataWhere);
            $config["base_url"] = site_url('adminfaq/questionlist');
            $config["per_page"] = $limit;
            $page = $start;
            $config["uri_segment"] = 3;
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

            $this->data['questions'] = $this->question->getQuestions($dataWhere, $limit, $start, $sort);
            $json['questions'] = $this->load->view('adminfaq/questionlist', $this->data, true);
        }

        echo json_encode($json);
    }

    public function ajax_search() {
        $this->load->model('user_model', 'user');
        $user = $_GET['part'];
        $data = $this->user->searchUser($user);

        $results = array();
        foreach ($data as $sub) {
            $results[$sub->email] = $sub->email;
        }
        echo json_encode($results);
    }

    public function answer($id = 0) {
        $question = $this->question->getQuestionById($id);
        if (!$question)
            redirect(site_url('faq'));

        $msg = $this->session->flashdata('usermessage');
        if ($msg) {
            $this->data['usermessage'] = $msg;
        }
        $answer = $this->answer->getAnswersByquestionId($id);
        $validationErrors = array();
        $posts = $this->input->post();
        if ($posts) {
            if (trim($posts['answer_content']) == '') {
                $validationErrors['answer_content'] = "Answer not null";
            }
            if (count($validationErrors) != 0) {
                $this->data['usermessage'] = array('error', 'darkred', 'Validation errors found', 'Please see below');
                $this->data['fielderrors'] = $validationErrors;
            } else {

                if (!$answer) {
                    $dataAnswer = array(
                        'answer_content' => trim($posts['answer_content']),
                        'question_id' => $question->id
                    );
                    $this->answer->addAnswer($dataAnswer);

                    $dataQuestion = array(
                        'admin_status' => 1,
                        'user_status' => 0
                    );
                    $this->question->updateQuestion($question->id, $dataQuestion);

                    $dataUserMail = array(
                        'fullname' => $question->firstname . ' ' . $question->lastname,
                        'question' => $question->title,
                        'link' => site_url('faq/answer/' . $question->id)
                    );
                    sendmailform($question->email, 'add_answer_admin', $dataUserMail);
                    $data['usermessage'] = array('success', 'green', 'Successfully saved ', '');
                    $this->session->set_flashdata(array('usermessage' => $data['usermessage']));
                    redirect(site_url('adminfaq/answer/'.$question->id));
                } else {
                    $dataAnswer = array(
                        'answer_content' => trim($posts['answer_content']),
                    );
                    $this->answer->updateAnswer($question->id, $dataAnswer);

                    $dataQuestion = array(
                        'admin_status' => 1,
                    );
                    $this->question->updateQuestion($question->id, $dataQuestion);
                    $data['usermessage'] = array('success', 'green', 'Successfully saved ', '');
                    $this->session->set_flashdata(array('usermessage' => $data['usermessage']));
                    redirect(site_url('adminfaq/answer/'.$question->id));
                }
            }
        }

        $this->data['question'] = $question;
        $this->data['answer'] = $answer;

        $this->data['main_content'] = 'adminfaq/answer';
        $this->data['title'] = 'Answer faq';
        $this->load->View('administrator', $this->data);
    }

}

?>
