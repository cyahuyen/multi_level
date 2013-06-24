<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Faq page controller
 * @author	Khiem Pham <khiemktqd@gmail.com>
 * @date	20/06/2013
 */
class Faq extends MY_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('user_model', 'user');
        $this->load->model('question_model', 'question');
        $this->load->model('answer_model', 'answer');
        $this->data['menu_config'] = $this->menu_config_6;
        $msg = $this->session->flashdata('usermessage');
        if ($msg) {
            $this->data['usermessage'] = $msg;
        }
        if (!$this->session->userdata('user')) {
            redirect('authentication', 'refresh');
        }
        $this->data['user_session'] = $this->session->userdata('user');
        $user_session = $this->session->userdata('user');
        if (!empty($user_session) && $user_session['permission'] == 'administrator') {
            redirect(site_url('admin'));
        }
    }

    public function question($id = 0) {
        $question = $this->question->getQuestionById($id);

        $posts = $this->input->post();
        $user_session = $this->session->userdata('user');

        if ($question && ($user_session['main_id'] != $question->main_user_id))
            redirect(site_url('faq/question'));

        $validationErrors = array();
        if ($posts) {
            $dataUpdate['title'] = trim($posts['title']);
            $dataUpdate['content'] = $posts['content'];
            if (strlen($dataUpdate['title']) <= 6) {
                $validationErrors['title'] = "Question greater than 6 character";
            }
            if (strlen($dataUpdate['content']) == '') {
                $validationErrors['content'] = "Question content not null";
            }


            if (count($validationErrors) != 0) {
                $this->data['usermessage'] = array('error', 'darkred', 'Validation errors found', 'Please see below');
                $this->data['fielderrors'] = $validationErrors;
            } else {
                if ($question) {
                    if ($this->question->updateQuestion($id, $dataUpdate)) {
                        $this->activity->addActivity($user_session['main_id'], 'Updated question "' . $dataUpdate['title'] . '"');
                        $dataUserMail = array(
                            'fullname' => $user_session['firstname'] . ' ' . $user_session['lastname'],
                            'question' => $dataUpdate['title'],
                        );
                        sendmailform($user_session['email'], 'update_question', $dataUserMail);
                        $this->data['usermessage'] = array('success', 'green', 'Successfully saved', '');
                    }
                } else {
                    $dataUpdate['main_user_id'] = $user_session['main_id'];
                    $id = $this->question->addQuestion($dataUpdate);
                    if ($id) {
                        $this->activity->addActivity($user_session['main_id'], 'Sent a question: "' . $dataUpdate['title'] . '"');
                        $dataUserMail = array(
                            'fullname' => $user_session['firstname'] . ' ' . $user_session['lastname'],
                            'question' => $dataUpdate['title'],
                        );
                        sendmailform($user_session['email'], 'add_question', $dataUserMail);

                        $dataAdminMain = array(
                            'fullname' => $user_session['firstname'] . ' ' . $user_session['lastname'],
                            'question' => $dataUpdate['title'],
                        );
                        sendmailform(null, 'admin_add_question', $dataAdminMain);
                        $this->data['usermessage'] = array('success', 'green', 'Successfully saved', '');
                    }
                }
            }
        }
        $this->data['question'] = $question;
        $this->data['main_content'] = 'faq/question';
        $this->data['title'] = 'Question';
        $this->load->View('home', $this->data);
    }

    public function list_question() {
        $limit = $this->config->item('limit_page');
        $start = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $user_session = $this->session->userdata('user');
        $dataWhere = array(
            'main_user_id' => $user_session['main_id']
        );

//       Begin pagination
        $this->load->library("pagination");
        $config = array();
        $config["total_rows"] = $this->question->totalQuestion($dataWhere);
        $config["base_url"] = site_url('faq/list_question/');
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
        $this->data['questions'] = $this->question->getQuestions($dataWhere, $limit, $start);
        $json['questions'] = $this->load->view('faq/list_question', $this->data, true);
        echo json_encode($json);
    }

    public function answer($id = 0) {
        $this->load->model('question_model', 'question');
        $this->load->model('answer_model', 'answer');
        $question = $this->question->getQuestionById($id);
        if (!$question)
            redirect(site_url('faq/question'));
        $user_session = $this->session->userdata('user');

        if ($question->main_user_id != $user_session['main_id']) {
            redirect(site_url('faq/question'));
        }
        $answer = $this->answer->getAnswersByquestionId($id);
        $this->data['question'] = $question;
        $this->data['answer'] = $answer;


        $this->data['main_content'] = 'faq/answer';
        $this->data['title'] = 'Answer';
        $this->load->View('home', $this->data);
    }

}