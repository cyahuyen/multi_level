<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Register extends MY_Controller {

    var $usertype = array('0' => 'Member', '1' => 'Silver', '2' => 'Gold');

    function __construct() {
        parent::__construct();

        $this->load->library('form_validation');
        $this->load->database();
        $this->load->library('session');
        $this->load->helper('form');
        $this->load->helper('url');
        $this->load->library('recaptcha');
        $this->lang->load('recaptcha');
        $this->load->model('register_model', '', TRUE);
        $this->load->model('transaction_model', 'transaction', TRUE);
        $this->data['user_session'] = $this->session->userdata('user');
        $this->data['menu_config'] = $this->menu_config_2;
        $this->load->model('country_model', 'country');
        $this->load->model('zones_model', 'zones');

        $msg = $this->session->flashdata('usermessage');
        if ($msg) {
            $this->data['usermessage'] = $msg;
        }
    }

    public function get_zones($country_id = 0) {
        $zones = $this->zones->getZones(array('country_id' => $country_id));
        $json = array();
        if ($zones) {
            foreach ($zones as $zone) {
                $json[$zone->zone_id] = $zone->name;
            }
        }

        echo json_encode($json);
    }

    public function index() {
        $this->load->model('user_model', 'user');
        $this->data['title'] = 'Sign Up';
        $this->data['countries'] = $this->country->getCountries();
        $posts = $this->input->post();
        $this->load->model('config_model', 'configs');
        $dataConfig['return'] = site_url('register/paypal_return');
        $dataConfig['cancel_return'] = site_url('register/cancel_return');
        $dataConfig['notify_url'] = site_url('home');
        $dataConfig['transaction_fees'] = $this->configs->getConfigs('transaction_fees');
        $dataConfig['title'] = 'Register';
        $this->data['transaction_fees'] = $dataConfig['transaction_fees'];
        $payments = $this->configs->listActivepayment();
        $data['payments'] = array();
        foreach ($payments as $code => $config) {
            $dataConfig['config'] = $config;
            $this->data['payments'][$code] = $config['title'];
        }
        $session = $this->session->flashdata('message');
        if (isset($session)) {
            $this->data['success'] = $session;
        } else {
            $this->data['success'] = '';
        }

        $posts = $this->input->post();

        $this->data['posts'] = $posts;
        if ($posts) {
            $validationErrors = array();

            if (strlen($posts['username']) < 6) {
                $validationErrors['username'] = "Username at least 6 character";
            } else {
                $user = $this->user->getMainUserByUsername($posts['username']);
                if ($user) {
                    $validationErrors['username'] = "Username is exists";
                }
            }

            if (strlen($posts['password']) < 6) {
                $validationErrors['password'] = "Password at least 6 character";
            } elseif ($posts['password'] != $posts['repassword']) {
                $validationErrors['repassword'] = "RePassword incorrect";
            }

            if ($posts['firstname'] == '') {
                $validationErrors['firstname'] = "Firstname cannot be blank";
            }
            if ($posts['lastname'] == '') {
                $validationErrors['lastname'] = "Lastname cannot be blank";
            }
            $this->load->helper('email');
            if ($posts['email'] == '') {
                $validationErrors['email'] = "Email cannot be blank";
            } elseif (!valid_email($posts['email'])) {
                $validationErrors['email'] = "Email incorrect";
            } elseif ($posts['email'] != $posts['email_repeat']) {
                $validationErrors['email_repeat'] = "Email repeat incorrect";
            }

            if (empty($posts['country'])) {
                $validationErrors['country'] = "Country cannot be blank";
            }
            if (empty($posts['state'])) {
                $validationErrors['state'] = "State cannot be blank";
            }
            if (empty($posts['zip_code'])) {
                $validationErrors['zip_code'] = "Postal/zip code cannot be blank";
            }

            if (empty($posts['payment'])) {
                $validationErrors['payment'] = "You haven't yet payment method";
            }
            if (empty($posts['referring'])) {
                $validationErrors['referring'] = "Referring cannot be blank";
            } else {
                $referring = $this->user->getUserByGoldAcount($posts['referring']);
                if (!$referring) {
                    $validationErrors['referring'] = "Referring is not exists";
                }
            }
            if (!empty($posts['entry_amount'])) {
                if (!is_numeric($posts['entry_amount']) && !is_float($posts['entry_amount'])) {
                    $validationErrors['entry_amount'] = "Amount is numeric";
                } elseif ($posts['entry_amount'] < $dataConfig['transaction_fees']['min_enrolment_entry_amount'] || $posts['entry_amount'] > $dataConfig['transaction_fees']['max_enrolment_entry_amount'] || $posts['entry_amount'] % 100 != 0) {
                    $validationErrors['entry_amount'] = "Amount divisible 100, greater than {$dataConfig['transaction_fees']['min_enrolment_entry_amount']} and litter than {$dataConfig['transaction_fees']['max_enrolment_entry_amount']}";
                }
            }


            if (count($validationErrors) != 0) {
                $this->data['usermessage'] = array('error', 'darkred', 'Validation errors found', 'Please see below');
                $this->data['fielderrors'] = $validationErrors;
            } else {
                $register_info = base64_encode(json_encode($posts));
                $this->session->set_userdata('register_info', $register_info);

                redirect(site_url('register/' . $posts['payment']));
            }
        }

        $this->data['main_content'] = 'register/register.php';

        $this->load->view('home', $this->data);
    }

    public function paypal_return() {
        if ($_SERVER['REQUEST_METHOD'] != 'POST')
            redirect('register');
        $this->load->model('user_model', 'user');
        $this->load->model('balance_model', 'balance');

//      BOF get data from paypal
        $url = 'https://www.sandbox.paypal.com/cgi-bin/webscr';
        $url_parsed = parse_url($url);
        $fp = fsockopen($url_parsed['host'], "80", $err_num, $err_str, 30);
        if (!$fp) {
            $error = array('error', 'darkred', 'Register errors', 'Connection to ' . $url_parsed['host'] . " failed.fsockopen error no. $errnum: $errstr");
            $this->session->set_flashdata(array('usermessage' => $error));
            redirect('register');
        }

        $posts = $this->input->post();
        if ($posts['mc_gross'] < $this->config_data['open_fee']) {
            $error = array('error', 'darkred', 'Register errors', 'Transaction fees litter than open fees');
            $this->session->set_flashdata(array('usermessage' => $error));
            redirect('register');
        }

        $custom = $posts['custom'];
        $custom_list = explode('|', $custom);
        $postsData = array();
        foreach ($custom_list as $val) {
            $custom_post = explode('=', $val);
            $postsData[$custom_post[0]] = $custom_post[1];
        }

        if ($posts['business'] != $this->config_data['business']) {
            $error = array('error', 'darkred', 'Register errors', 'Transaction email error');
            $this->session->set_flashdata(array('usermessage' => $error));
            redirect('register');
        }
//      EOF get data from paypal
//      Duplicate transaction  
        if ($this->transaction->checkTransactionExists($posts['txn_id'])) {
            $data['usermessage'] = array('success', 'green', 'Thank you for registering!', '');
            $this->session->set_flashdata('usermessage', $data['usermessage']);
            redirect('home');
        }

//      BOF Create Main Account
        $password = hash_hmac('crc32b', time() . $this->config->item('prefix_key'), 'secret');
        $acount_number = generate_account_number();
        $dataMainUser = array(
            'firstname' => $postsData['firstname'],
            'lastname' => $postsData['lastname'],
            'email' => $postsData['email'],
            'password' => md5($password),
            'main_account_number' => $acount_number,
            'phone' => $postsData['phone'],
            'address' => $postsData['address'],
        );
        $main_user_id = $this->user->createMainAcount($dataMainUser);
        $this->activity->addActivity($main_user_id, 'Registed');
//      EOF Create Main Account
//      Update Admin Balance
        $this->balance->updateAdminBalance($posts['mc_gross'], '+');

//      BOF Check/Create Gold Account
        $min_enrolment_entry_amount = $this->config_data['min_enrolment_entry_amount'] + $this->config_data['open_fee'] + $this->config_data['transaction_fee'];
        $open_fees = $this->config_data['open_fee'];
        $dataGoldAcount = array(
            'main_user_id' => $main_user_id,
            'acount_number' => 'G' . $acount_number,
        );
        $gold_user_id = $this->user->createGoldAcount($dataGoldAcount);
        $this->activity->addActivity($main_user_id, 'Created gold account number ' . $dataGoldAcount['acount_number']);

        if (($posts['mc_gross'] >= $min_enrolment_entry_amount)) {
            $open_fees += $this->config_data['transaction_fee'];

//      Update Balance 
            $balance_user_amount = $posts['mc_gross'] - ($this->config_data['open_fee'] + $this->config_data['transaction_fee']);
            $dataBalanceUpdate = array(
                'user_id' => $gold_user_id,
                'balance' => $balance_user_amount,
            );
            $dataTransaction = $this->balance->updateBalance($dataBalanceUpdate);
            $this->activity->addActivity($main_user_id, 'Deposited to the acount ' . $dataGoldAcount['acount_number'] . ' with amount : $' . ($dataBalanceUpdate['balance']), '+', $dataBalanceUpdate['balance']);
//      Update Widthdraw date
            $this->user->updateWithdrawalDate($gold_user_id);
        }
//      EOF Check/Create Gold Account
//      BOF Update Transaction
        $dataTransactionUpdate = array(
            'user_id' => !empty($gold_user_id) ? $gold_user_id : NULL,
            'main_user_id' => $main_user_id,
            'fees' => $open_fees,
            'total' => $posts['mc_gross'],
            'transaction_id' => $posts['txn_id'],
            'payment_status' => $posts['payment_status'],
            'transaction_type' => 'register',
            'transaction_text' => '+',
            'transaction_source' => 'paypal',
            'status' => '1',
        );
        $this->transaction->upadateTransaction($dataTransactionUpdate);

//      EOF Update Transaction
//      BOF Check Reffering Member
        if ($postsData['referring']) {
            $mainUser = $this->user->getMainUserByEmail($postsData['referring']);
        }
        if (!empty($mainUser)) {
            $userSilverReffering = $this->user->getUserByEmail($postsData['referring'], 1);
            if (empty($userSilverReffering)) {
                $dataSilverAcount = array(
                    'main_user_id' => $mainUser->main_id,
                    'acount_number' => 'S' . $mainUser->main_account_number,
                );
                $rsilver_user_id = $this->user->createSilverAcount($dataSilverAcount);
                $userSilverReffering = $this->user->getMainUserById($rsilver_user_id);
                $this->activity->addActivity($mainUser->main_id, 'Created silver account number ' . $userSilverReffering->acount_number);
            }
            $this->activity->addActivity($mainUser->main_id, 'You referred a new member "' . $dataMainUser['firstname'] . ' ' . $dataMainUser['lastname'] . '"');
            $this->user->updateMainAcount($main_user_id, array('referring' => $mainUser->main_id));
        } else {
            $referringUserConfig = $this->config_data['default_referral_user'];
            $mainUser = $this->user->getMainUserByEmail($referringUserConfig);
            if (!empty($mainUser)) {
                $userSilverReffering = $this->user->getUserByEmail($this->config_data['default_referral_user'], 1);
                if (empty($userSilverReffering)) {
                    $dataSilverAcount = array(
                        'main_user_id' => $mainUser->main_id,
                        'acount_number' => 'S' . $mainUser->main_account_number,
                    );
                    $rsilver_user_id = $this->user->createSilverAcount($dataSilverAcount);
                    $userSilverReffering = $this->user->getMainUserById($rsilver_user_id);
                    $this->activity->addActivity($mainUser->main_id, 'Created silver account number ' . $userSilverReffering->acount_number);
                }
                $this->activity->addActivity($mainUser->main_id, 'You referred a new member "' . $dataMainUser['firstname'] . ' ' . $dataMainUser['lastname'] . '"');
                $this->user->updateMainAcount($main_user_id, array('referring' => $mainUser->main_id));
            }
        }


        if (!empty($userSilverReffering)) {

//      BOF Update Balance
            $this->balance->updateAdminBalance($this->config_data['referral_fees'], '-');

            $dataBalanceSilverReferralUpdate = array(
                'user_id' => $userSilverReffering->user_id,
                'balance' => $this->config_data['referral_fees'],
            );
            $dataTransaction = $this->balance->updateBalance($dataBalanceSilverReferralUpdate);
            $this->activity->addActivity($userSilverReffering->main_id, 'Your Silver account ' . $userSilverReffering->acount_number . '  received a referral fee with amount : $' . ($this->config_data['referral_fees']), '+', $this->config_data['referral_fees']);
//      EOF Update Balance
//      BOF Update Transaction
            $dataTransactionUpdate = array(
                'user_id' => $userSilverReffering->user_id,
                'main_user_id' => $userSilverReffering->main_id,
                'fees' => 0,
                'total' => $this->config_data['referral_fees'],
                'payment_status' => 'Completed',
                'transaction_type' => 'refere',
                'transaction_text' => '+',
                'transaction_source' => 'system',
                'status' => '0',
                'description' => 'User reffered the user "' . $dataMainUser['firstname'] . ' ' . $dataMainUser['lastname'] . '" succesfull'
            );
            $this->transaction->upadateTransaction($dataTransactionUpdate);

//      Update Widthdraw date
            if (empty($userSilverReffering->withdrawal_date)) {
                $this->user->updateWithdrawalDate($userSilverReffering->user_id);
            }

//      EOF Update Transaction
        }

        if (!empty($gold_user_id) && !empty($mainUser)) {
            $userGoldReffering = $this->user->getUserByEmail($postsData['referring'], 2);
            if (!empty($userGoldReffering)) {

                //              get banlane gold account
                $balanceGoldAcount = $this->balance->getBalance($userGoldReffering->user_id);
                if (!empty($balanceGoldAcount->balance) && $balanceGoldAcount->balance > 0 && ($balance_user_amount >= $this->config_data['min_enrolment_entry_amount'])) {
                    $refereFees = $dataBalanceUpdate['balance'] * $this->config_data['percentage_gold'] / 100;
                    //      BOF Update Balance
                    $this->balance->updateAdminBalance($refereFees, '-');

                    $dataBalanceGoldRefferingUpdate = array(
                        'user_id' => $userGoldReffering->user_id,
                        'balance' => $refereFees,
                    );
                    $this->balance->updateBalance($dataBalanceGoldRefferingUpdate);
                    $this->activity->addActivity($userGoldReffering->main_id, 'Your Gold account ' . $userSilverReffering->acount_number . '  received a referral fee with amount: $' . ($refereFees), '+', $refereFees);
                    //      EOF Update Balance
                    //      BOF Update Transaction
                    $dataTransactionUpdate = array(
                        'user_id' => $userGoldReffering->user_id,
                        'main_user_id' => $userGoldReffering->main_id,
                        'fees' => 0,
                        'total' => $refereFees,
                        'payment_status' => 'Completed',
                        'transaction_type' => 'refere',
                        'transaction_text' => '+',
                        'transaction_source' => 'system',
                        'status' => '0',
                        'description' => 'The user "' . $dataMainUser['firstname'] . ' ' . $dataMainUser['last_name'] . '" deposited $100'
                    );
                    $this->transaction->upadateTransaction($dataTransactionUpdate);

                    //      EOF Update Transaction
                }
            }
        }


//      EOF Check Reffering Member
//      BOF Send Mail

        $userEmailData['entry_amount'] = !empty($balance_user_amount) ? $balance_user_amount : 0;
        $userEmailData['fees'] = $open_fees;
        $userEmailData['password'] = $password;
        $userEmailData['email'] = $postsData['email'];
        sendmailform($postsData['email'], 'register', $userEmailData, null, 'Admin Manager', 'html');


        $adminEmailData = array(
            'fullname' => $postsData['firstname'] . ' ' . $postsData['lastname'],
            'address' => $postsData['address'],
            'phone' => $postsData['phone'],
            'email' => $postsData['email'],
            'payment' => $posts['mc_gross'],
        );

        sendmailform(null, 'admin_register', $adminEmailData);

        if (!empty($userReffering)) {
            $referringEmailData = array(
                'fullname' => $postsData['firstname'] . ' ' . $postsData['lastname'],
                'email' => $postsData['email']
            );
            sendmailform($userReffering->email, 'referring', $referringEmailData);
        }
//      EOF Send Mail
        $data['usermessage'] = array('success', 'green', 'Thank you for registering!', '');
        $this->session->set_flashdata('usermessage', $data['usermessage']);
        redirect('home');
    }

    public function aw_quickpay() {
        $this->data['title'] = 'Allied Wallet';
        $register_info = $this->session->userdata('register_info');
        if (empty($register_info))
            redirect(site_url('register/index'));
        $this->load->model('tmp_model');
        $tmp_id = $this->tmp_model->insert(array('tmp_info' => $register_info));
        $this->data['tmp_id'] = $tmp_id;
        $this->data['register_info_json'] = $register_info;
        $register_info = json_decode(base64_decode($register_info));

        $this->data['register_info'] = $register_info;

        if ($register_info->entry_amount > 0) {
            $register_fees = $this->data['config_data']['transaction_fee'] + $this->data['config_data']['open_fee'];
        } else {
            $register_fees = $this->data['config_data']['open_fee'];
        }
        $this->data['register_fees'] = $register_fees;
        $this->load->model('config_model', 'configs');

        $payments_config = $this->configs->getConfigs('aw_quickpay');
        $this->data['payments_config'] = $payments_config;

        $this->data['main_content'] = 'register/aw_quickpay.php';
        $this->load->view('home', $this->data);
    }

    function write_log($str) {
        $url = realpath(dirname(__FILE__)) . '/log.txt';
        $out = fopen($url, "a");
        fwrite($out, $this->aprint($str));
        fclose($out);
    }

    function aprint($arr, $return = true) {
        $wrap = '<div style=" white-space:pre; position:absolute; top:10px; left:10px; height:200px; width:100px; overflow:auto; z-index:5000;">';
        $wrap = '<pre>';
        $txt = preg_replace('/(\[.+\])\s+=>\s+Array\s+\(/msiU', '$1 => Array (', print_r($arr, true));

        if ($return)
            return $wrap . $txt . '</pre>';
        else
            echo $wrap . $txt . '</pre>';
    }

    public function aw_quickpay_process() {
        $posts = $this->input->post();
        if (!$posts)
            return FALSE;
        $payments_config = $this->configs->getConfigs('aw_quickpay');
        $money = $posts['Amount'];
        $tmp_id = $posts['MerchantReference'];
        $this->load->model('tmp_model');
        $info = $this->tmp_model->getTmp($tmp_id);
        $this->tmp_model->delete($tmp_id);
        if (empty($info))
            return FALSE;
        if ($posts['SiteName'] != $payments_config['site'] || $posts['SiteID'] != $payments_config['SiteID'])
            return FALSE;
        $register_info = json_decode(base64_decode($info['tmp_info']));
        if (!$register_info)
            return FALSE;
        $entry_amount = $register_info->entry_amount;
        $checkAmount = $entry_amount + $this->config_data['open_fee'];

        if ($entry_amount >= $this->config_data['min_enrolment_entry_amount'])
            $checkAmount += $this->config_data['transaction_fee'];

        if ($money != $checkAmount)
            return FALSE;


        $this->load->model('user_model', 'user');
        $this->load->model('balance_model', 'balance');


//        EOF Transaction
//      BOF Create Main Account
        $password = $register_info->password;
        $account_number = generate_account_number();
        $dataMainUser = array(
            'username' => $register_info->username,
            'firstname' => $register_info->firstname,
            'lastname' => $register_info->lastname,
            'email' => $register_info->email,
            'password' => md5($password),
            'main_account_number' => $account_number,
            'phone' => $register_info->phone,
            'address' => $register_info->address,
            'address2' => $register_info->address2,
            'country_id' => $register_info->country,
            'state_id' => $register_info->state,
            'zip_code' => $register_info->zip_code,
            'city' => $register_info->city,
        );
        $main_user_id = $this->user->createMainAcount($dataMainUser);
        $this->activity->addActivity($main_user_id, 'Registed');
//      EOF Create Main Account
//      Update Admin Balance
        $this->balance->updateAdminBalance($money, '+');


//      BOF Check/Create Gold Account
        $dataGoldAcount = array(
            'main_user_id' => $main_user_id,
            'acount_number' => 'G' . $account_number,
        );
        $gold_user_id = $this->user->createGoldAcount($dataGoldAcount);
        $this->activity->addActivity($main_user_id, 'Created gold account number ' . $dataGoldAcount['acount_number']);

        if (($register_info->entry_amount >= $this->config_data['min_enrolment_entry_amount'])) {

//      Update Balance 
            $dataBalanceUpdate = array(
                'user_id' => $gold_user_id,
                'balance' => $register_info->entry_amount,
            );
            $dataTransaction = $this->balance->updateBalance($dataBalanceUpdate);
            $this->activity->addActivity($main_user_id, 'Deposited to your acount ' . $dataGoldAcount['acount_number'] . ' with amount : $' . ($register_info->entry_amount), '+', $register_info->entry_amount);
        }
//      EOF Check/Create Gold Account
//      BOF Update Transaction
        $dataTransactionUpdate = array(
            'user_id' => !empty($gold_user_id) ? $gold_user_id : NULL,
            'main_user_id' => $main_user_id,
            'fees' => $this->config_data['open_fee'],
            'total' => $this->config_data['open_fee'],
            'transaction_id' => $posts['TransactionID'],
            'payment_status' => 'Completed',
            'transaction_type' => 'register',
            'transaction_text' => '+',
            'transaction_source' => 'aw_quickpay',
            'status' => '1',
        );
        $this->transaction->upadateTransaction($dataTransactionUpdate);

        if (($money - $this->config_data['open_fee']) > 0) {
            $dataDepositTransactionUpdate = array(
                'user_id' => !empty($gold_user_id) ? $gold_user_id : NULL,
                'main_user_id' => $main_user_id,
                'fees' => $this->config_data['transaction_fee'],
                'total' => $money - $this->config_data['open_fee'], //$money,
                'transaction_id' => $posts['TransactionID'],
                'payment_status' => 'Completed',
                'transaction_type' => 'deposit',
                'transaction_text' => '+',
                'transaction_source' => 'aw_quickpay',
                'status' => '1',
            );
            $this->transaction->upadateTransaction($dataDepositTransactionUpdate);
        }

//      Update Widthdraw date
        $this->user->updateWithdrawalDate($gold_user_id);
//      EOF Update Transaction
//      BOF Check Reffering Member
        $postsData = $posts;
        if ($register_info->referring) {
            $mainUser = $this->user->getUserByGoldAcount($register_info->referring);
        } else {
            $referringUserConfig = $this->config_data['default_referral_user'];
            $mainUser = $this->user->getUserByGoldAcount($referringUserConfig);
        }

        if (!empty($mainUser)) {
            $userSilverReffering = $this->user->getUserByMainId($mainUser->main_id, 1);
            if (empty($userSilverReffering)) {
                $dataSilverAcount = array(
                    'main_user_id' => $mainUser->main_id,
                    'acount_number' => 'S' . $mainUser->main_account_number,
                );
                $rsilver_user_id = $this->user->createSilverAcount($dataSilverAcount);
                $userSilverReffering = $this->user->getMainUserById($rsilver_user_id);
                $this->activity->addActivity($mainUser->main_id, 'Created silver account number ' . $userSilverReffering->acount_number);
            }

            $this->user->updateMainAcount($main_user_id, array('referring' => $mainUser->main_id));

//            $referral_fees = $this->config_data['referral_fees'] * $posts['entry_amount'] / 100;
            $referral_fees = $this->config_data['referral_fees'];
            //      BOF Update Balance
            $this->balance->updateAdminBalance($referral_fees, '-');
            $dataBalanceSilverReferralUpdate = array(
                'user_id' => $userSilverReffering->user_id,
                'balance' => $referral_fees,
            );
            $dataTransaction = $this->balance->updateBalance($dataBalanceSilverReferralUpdate);
            $this->activity->addActivity($mainUser->main_id, 'You referred a new member "' . $dataMainUser['firstname'] . ' ' . $dataMainUser['lastname'] . '"', '+', $referral_fees);
            //      EOF Update Balance
//      BOF Update Transaction
            $dataRefereTransactionUpdate = array(
                'user_id' => $userSilverReffering->user_id,
                'main_user_id' => $userSilverReffering->main_id,
                'fees' => 0,
                'total' => $referral_fees,
                'payment_status' => 'Completed',
                'transaction_type' => 'refere',
                'transaction_text' => '+',
                'transaction_source' => 'system',
                'status' => '0',
                'description' => 'User reffered the user "' . $dataMainUser['firstname'] . ' ' . $dataMainUser['last_name'] . '" succesfull'
            );
            $this->transaction->upadateTransaction($dataRefereTransactionUpdate);

            //Update Widthdraw date
            if (empty($userSilverReffering->withdrawal_date)) {
                $this->user->updateWithdrawalDate($userSilverReffering->user_id);
            }

//      EOF Update Transaction
        }
        if (!empty($gold_user_id) && !empty($mainUser)) {
            $userGoldReffering = $this->user->getUserByMainId($mainUser->main_id, 2);
            if (!empty($userGoldReffering)) {
//              get banlane gold account
                $checkExistsDeposit = $this->transaction->checkExistsDeposit($userGoldReffering->user_id);

                if ($checkExistsDeposit && $register_info->entry_amount > 0) {
                    $refereFees = $this->getRefereAmount($register_info->entry_amount, $mainUser->main_id);
                    //      BOF Update Balance
                    $this->balance->updateAdminBalance($refereFees, '-');

                    $dataBalanceGoldRefferingUpdate = array(
                        'user_id' => $userGoldReffering->user_id,
                        'balance' => $refereFees,
                    );
                    $this->balance->updateBalance($dataBalanceGoldRefferingUpdate);
                    $this->balance->updateAdminBalance($refereFees, '-');
                    $this->activity->addActivity($userGoldReffering->main_id, 'Your Gold Account ' . $userGoldReffering->acount_number . ' received a  referral fee with amount : $' . ($refereFees), '+', $refereFees);
                    //      EOF Update Balance
                    //      BOF Update Transaction
                    $dataGoldTransactionUpdate = array(
                        'user_id' => $userGoldReffering->user_id,
                        'main_user_id' => $userGoldReffering->main_id,
                        'fees' => 0,
                        'total' => $refereFees,
                        'payment_status' => 'Completed',
                        'transaction_type' => 'refere',
                        'transaction_text' => '+',
                        'transaction_source' => 'system',
                        'status' => '0',
                        'description' => 'The user "' . $dataMainUser['firstname'] . ' ' . $dataMainUser['last_name'] . '" deposited $100'
                    );
                    $this->transaction->upadateTransaction($dataGoldTransactionUpdate);
                }
                //      EOF Update Transaction
            }
        }


//      EOF Check Reffering Member
//      BOF Send Mail
        $userEmailData = array(
            'fullname' => $register_info->firstname . ' ' . $register_info->lastname,
            'gold_account_number' => $dataGoldAcount['acount_number'],
            'refere_fullname' => $mainUser->firstname . ' ' . $mainUser->lastname,
            'refere_account_number' => $register_info->referring,
            'register_amount' => '$' . $entry_amount,
            'login_url' => site_url('authentication')
        );
        sendmailform($register_info->email, 'register', $userEmailData, null, 'Admin Manager', 'html');
        sendmailform($register_info->email, 'register_letter_2', $userEmailData, null, 'Admin Manager', 'html');


        $adminEmailData = array(
            'fullname' => $register_info->firstname . ' ' . $register_info->lastname,
            'address' => $register_info->address,
            'phone' => $register_info->phone,
            'email' => $register_info->email,
            'payment' => '$' . $register_info->entry_amount,
            'login_url' => site_url('authentication')
        );

        sendmailform(null, 'admin_register', $adminEmailData);

        if (!empty($mainUser)) {
            
            $referringEmailData = array(
                'refere_fullname' => $mainUser->firstname . ' ' . $mainUser->lastname,
                'register_fullname' => $register_info->firstname . ' ' . $register_info->lastname,
                'register_account_number' => $dataGoldAcount['acount_number'],
                'register_username' => $register_info->username,
                'register_amount' => '$' . $register_info->entry_amount,
                'login_url' => site_url('authentication')
            );
            sendmailform($mainUser->email, 'referring', $referringEmailData);
        }
//      EOF Send Mail
        $this->session->unset_userdata('register_info');
        $data['usermessage'] = array('success', 'green', 'Thank you for registering!', '');
        $this->session->set_flashdata('usermessage', $data['usermessage']);
    }

    public function creditcard() {
        $this->data['title'] = 'Creditcard';
        $posts = $this->input->post();
        $register_info = $this->session->userdata('register_info');
        if (empty($register_info))
            redirect(site_url('register/index'));
        $register_info = json_decode(base64_decode($register_info));
        $this->data['register_info'] = $register_info;
        if ($register_info->entry_amount > 0) {
            $register_fees = $this->data['config_data']['transaction_fee'] + $this->data['config_data']['open_fee'];
        } else {
            $register_fees = $this->data['config_data']['open_fee'];
        }
        $this->data['register_fees'] = $register_fees;
        if ($posts) {
            $this->load->model('user_model', 'user');
            $this->load->model('balance_model', 'balance');

//      BOF  Transaction

            $money = $register_fees + $register_info->entry_amount;

            $dataTransactionFees = array(
                'card_num' => $posts['card_num'],
                'cc_owner' => $posts['cc_owner'],
                'exp_date' => $posts['exp_date'],
                'amount' => $money,
                'cc_cvv2' => $posts['cc_cvv2'],
            );

            $this->load->helper('authorize');
            $payment_status = payment_creditcard_authorize($dataTransactionFees);

            if ($payment_status['message'] == 'error') {
                $error = array('error', 'darkred', 'Register errors', $payment_status['error']);
                $this->session->set_flashdata(array('usermessage' => $error));
                redirect(site_url('register'));
            }

//      Duplicate transaction  
            if ($this->transaction->checkTransactionExists($payment_status['transaction_id'])) {
                $data['usermessage'] = array('success', 'green', 'Thank you for registering!', '');
                $this->session->set_flashdata('usermessage', $data['usermessage']);
                redirect('home');
            }
//      EOF Transaction
//      BOF Create Main Account
            $password = $register_info->password;
            $account_number = generate_account_number();
            $dataMainUser = array(
                'username' => $register_info->username,
                'firstname' => $register_info->firstname,
                'lastname' => $register_info->lastname,
                'email' => $register_info->email,
                'password' => md5($password),
                'main_account_number' => $account_number,
                'phone' => $register_info->phone,
                'address' => $register_info->address,
                'address2' => $register_info->address2,
                'country_id' => $register_info->country,
                'state_id' => $register_info->state,
                'zip_code' => $register_info->zip_code,
                'city' => $register_info->city,
            );
            $main_user_id = $this->user->createMainAcount($dataMainUser);
            $this->activity->addActivity($main_user_id, 'Registed');
//      EOF Create Main Account
//      Update Admin Balance
            $this->balance->updateAdminBalance($money, '+');


//      BOF Check/Create Gold Account
            $dataGoldAcount = array(
                'main_user_id' => $main_user_id,
                'acount_number' => 'G' . $account_number,
            );
            $gold_user_id = $this->user->createGoldAcount($dataGoldAcount);
            $this->activity->addActivity($main_user_id, 'Created gold account number ' . $dataGoldAcount['acount_number']);

            if (($register_info->entry_amount >= $this->config_data['min_enrolment_entry_amount'])) {

//      Update Balance 
                $dataBalanceUpdate = array(
                    'user_id' => $gold_user_id,
                    'balance' => $register_info->entry_amount,
                );
                $dataTransaction = $this->balance->updateBalance($dataBalanceUpdate);
                $this->activity->addActivity($main_user_id, 'Deposited to your acount ' . $dataGoldAcount['acount_number'] . ' with amount : $' . ($register_info->entry_amount), '+', $register_info->entry_amount);
            }
//      EOF Check/Create Gold Account
//      BOF Update Transaction
            $dataTransactionUpdate = array(
                'user_id' => !empty($gold_user_id) ? $gold_user_id : NULL,
                'main_user_id' => $main_user_id,
                'fees' => $this->config_data['open_fee'],
                'total' => $this->config_data['open_fee'],
                'transaction_id' => $payment_status['transaction_id'],
                'payment_status' => 'Completed',
                'transaction_type' => 'register',
                'transaction_text' => '+',
                'transaction_source' => 'creditcard',
                'status' => '1',
            );
            $this->transaction->upadateTransaction($dataTransactionUpdate);

            if (($money - $this->config_data['open_fee']) > 0) {
                $dataDepositTransactionUpdate = array(
                    'user_id' => !empty($gold_user_id) ? $gold_user_id : NULL,
                    'main_user_id' => $main_user_id,
                    'fees' => $this->config_data['transaction_fee'],
                    'total' => $money - $this->config_data['open_fee'], //$money,
                    'transaction_id' => $payment_status['transaction_id'],
                    'payment_status' => 'Completed',
                    'transaction_type' => 'deposit',
                    'transaction_text' => '+',
                    'transaction_source' => 'creditcard',
                    'status' => '1',
                );
                $this->transaction->upadateTransaction($dataDepositTransactionUpdate);
            }

//      Update Widthdraw date
            $this->user->updateWithdrawalDate($gold_user_id);
//      EOF Update Transaction
//      BOF Check Reffering Member
            $postsData = $posts;
            if ($register_info->referring) {
                $mainUser = $this->user->getUserByGoldAcount($register_info->referring);
            } else {
                $referringUserConfig = $this->config_data['default_referral_user'];
                $mainUser = $this->user->getUserByGoldAcount($referringUserConfig);
            }

            if (!empty($mainUser)) {
                $userSilverReffering = $this->user->getUserByMainId($mainUser->main_id, 1);
                if (empty($userSilverReffering)) {
                    $dataSilverAcount = array(
                        'main_user_id' => $mainUser->main_id,
                        'acount_number' => 'S' . $mainUser->main_account_number,
                    );
                    $rsilver_user_id = $this->user->createSilverAcount($dataSilverAcount);
                    $userSilverReffering = $this->user->getMainUserById($rsilver_user_id);
                    $this->activity->addActivity($mainUser->main_id, 'Created silver account number ' . $userSilverReffering->acount_number);
                }

                $this->user->updateMainAcount($main_user_id, array('referring' => $mainUser->main_id));

//            $referral_fees = $this->config_data['referral_fees'] * $posts['entry_amount'] / 100;
                $referral_fees = $this->config_data['referral_fees'];
                //      BOF Update Balance
                $this->balance->updateAdminBalance($referral_fees, '-');
                $dataBalanceSilverReferralUpdate = array(
                    'user_id' => $userSilverReffering->user_id,
                    'balance' => $referral_fees,
                );
                $dataTransaction = $this->balance->updateBalance($dataBalanceSilverReferralUpdate);
                $this->activity->addActivity($mainUser->main_id, 'You referred a new member "' . $dataMainUser['firstname'] . ' ' . $dataMainUser['lastname'] . '"', '+', $referral_fees);
                //      EOF Update Balance
//      BOF Update Transaction
                $dataRefereTransactionUpdate = array(
                    'user_id' => $userSilverReffering->user_id,
                    'main_user_id' => $userSilverReffering->main_id,
                    'fees' => 0,
                    'total' => $referral_fees,
                    'payment_status' => 'Completed',
                    'transaction_type' => 'refere',
                    'transaction_text' => '+',
                    'transaction_source' => 'system',
                    'status' => '0',
                    'description' => 'User reffered the user "' . $dataMainUser['firstname'] . ' ' . $dataMainUser['last_name'] . '" succesfull'
                );
                $this->transaction->upadateTransaction($dataRefereTransactionUpdate);

                //Update Widthdraw date
                if (empty($userSilverReffering->withdrawal_date)) {
                    $this->user->updateWithdrawalDate($userSilverReffering->user_id);
                }

//      EOF Update Transaction
            }
            if (!empty($gold_user_id) && !empty($mainUser)) {
                $userGoldReffering = $this->user->getUserByMainId($mainUser->main_id, 2);
                if (!empty($userGoldReffering)) {
//              get banlane gold account
                    $checkExistsDeposit = $this->transaction->checkExistsDeposit($userGoldReffering->user_id);

                    if ($checkExistsDeposit && $register_info->entry_amount > 0) {
                        $refereFees = $this->getRefereAmount($register_info->entry_amount, $mainUser->main_id);
                        //      BOF Update Balance
                        $this->balance->updateAdminBalance($refereFees, '-');

                        $dataBalanceGoldRefferingUpdate = array(
                            'user_id' => $userGoldReffering->user_id,
                            'balance' => $refereFees,
                        );
                        $this->balance->updateBalance($dataBalanceGoldRefferingUpdate);
                        $this->balance->updateAdminBalance($refereFees, '-');
                        $this->activity->addActivity($userGoldReffering->main_id, 'Your Gold Account ' . $userGoldReffering->acount_number . ' received a  referral fee with amount : $' . ($refereFees), '+', $refereFees);
                        //      EOF Update Balance
                        //      BOF Update Transaction
                        $dataGoldTransactionUpdate = array(
                            'user_id' => $userGoldReffering->user_id,
                            'main_user_id' => $userGoldReffering->main_id,
                            'fees' => 0,
                            'total' => $refereFees,
                            'payment_status' => 'Completed',
                            'transaction_type' => 'refere',
                            'transaction_text' => '+',
                            'transaction_source' => 'system',
                            'status' => '0',
                            'description' => 'The user "' . $dataMainUser['firstname'] . ' ' . $dataMainUser['last_name'] . '" deposited $100'
                        );
                        $this->transaction->upadateTransaction($dataGoldTransactionUpdate);
                    }
                    //      EOF Update Transaction
                }
            }


//      EOF Check Reffering Member
//      BOF Send Mail

            $userEmailData = array(
                'fullname' => $register_info->firstname . ' ' . $register_info->lastname,
                'gold_account_number' => $dataGoldAcount['acount_number'],
                'refere_fullname' => $mainUser->firstname . ' ' . $mainUser->lastname,
                'refere_account_number' => $register_info->referring,
                'register_amount' => '$' . $money,
                'login_url' => site_url('authentication')
            );
            sendmailform($register_info->email, 'register', $userEmailData, null, 'Admin Manager', 'html');
            sendmailform($register_info->email, 'register_letter_2', $userEmailData, null, 'Admin Manager', 'html');


            $adminEmailData = array(
                'fullname' => $register_info->firstname . ' ' . $register_info->lastname,
                'address' => $register_info->address,
                'phone' => $register_info->phone,
                'email' => $register_info->email,
                'payment' => '$' . $money,
                'login_url' => site_url('authentication')
            );

            sendmailform(null, 'admin_register', $adminEmailData);

            if (!empty($mainUser)) {
                $referringEmailData = array(
                    'refere_fullname' => $mainUser->firstname . ' ' . $mainUser->lastname,
                    'register_fullname' => $register_info->firstname . ' ' . $register_info->lastname,
                    'register_account_number' => $dataGoldAcount['acount_number'],
                    'register_username' => $register_info->username,
                    'register_amount' => '$' . $register_info->entry_amount,
                    'login_url' => site_url('authentication')
                );
                sendmailform($mainUser->email, 'referring', $referringEmailData);
            }
            $this->session->unset_userdata('register_info');
//      EOF Send Mail
            $data['usermessage'] = array('success', 'green', 'Thank you for registering!', '');
            $this->session->set_flashdata('usermessage', $data['usermessage']);
            redirect('home');
        }

        $this->data['main_content'] = 'register/creditcard.php';

        $this->load->view('home', $this->data);
    }

    public function cancel_return() {
        $error = array('error', 'darkred', 'Transaction is cancel', '');
        $this->session->set_flashdata(array('usermessage' => $error));
        redirect('register');
    }

    public function forgot() {
        $this->load->model('user_model', 'user');

        $this->data['title'] = 'Forgot password';
        $step = 0 + $this->input->post('step', TRUE);
        if ($step <= 1) {
            $this->form_validation->set_rules('username', 'Username', 'required|xss_clean|max_length[64]|callback_check_user');
            $this->form_validation->set_message('valid_username', 'The %s field must contain a valid username.');
            $this->form_validation->set_rules('recaptcha_response_field', 'Captcha', 'required|callback_check_captcha');
            $this->data['recaptcha'] = $this->recaptcha->get_html();
            if ($this->input->post('username')) {
                $this->data['username'] = $this->input->post('username');
            } else {
                $this->data['username'] = "";
            }
            if ($this->form_validation->run() == FALSE) {
                $this->data['main_content'] = 'register/reset_pass_step1.php';
                $this->load->view('home', $this->data);
            } else {
                $username = $this->input->post('username');
                $user_email = $this->user->getMainUser(array('username' => $username));
                $email_to = $user_email->email;
                $this->data['email'] = $email_to;
                $id = $user_email->main_id;
                $this->data['forget_code'] = random_string('numeric', 10);
                $this->session->set_flashdata('step', 2);
                $this->data['main_content'] = 'register/reset_pass_step2.php';
                $this->user->updateMainAcount($id, array('forgotten_password_code' => $this->data['forget_code']));
                //======================= Send Email ====================================
                $contentEmail['forget_code'] = $this->data['forget_code'];
                sendmailform($email_to, 'forgot_password', $contentEmail, 'admin@website.com', 'Admin Manager', 'html');
                $this->load->view('home', $this->data);
                //==========================End send mail====================
            }
        } else if ($step == 2) {

            $username = $this->input->post('username', TRUE);
            $user_email = $this->user->getMainUser(array('username' => $username));
            $this->email = $user_email->email;
            $this->username = $user_email->username;
            $id = $user_email->main_id;
            $fp = $user_email->forgotten_password_code;
            if ($this->input->post('username')) {
                $this->data['username'] = $this->input->post('username');
            } else {
                $this->data['username'] = "";
            }

            $this->form_validation->set_rules('reset_code', 'Reset Code', 'required|trim|xss_clean|numeric|exact_length[10]|callback_checkResetcode');
            if (($fp != $this->input->post('reset_code'))) {
                $this->data['main_content'] = 'register/reset_pass_step2.php';
                $this->load->view('home', $this->data);
            } else {
                $this->data['main_content'] = 'register/reset_pass_step3.php';
                $this->load->view('home', $this->data);
            }
        } else if ($step == 3) {

            $this->data['username'] = $this->input->post('username', TRUE);
            $this->username = $this->data['username'];
            $email_user = $this->user->getMainUser(array('username' => $this->data['username']));
            $id = $email_user->main_id;
            $this->form_validation->set_rules('password', 'Password', 'required|trim|xss_clean|min_length[6]');
            $this->form_validation->set_rules('repassword', 'Second Password', 'required|trim|matches[password]');
            if ($this->form_validation->run() == FALSE) {
                $this->data['main_content'] = 'register/reset_pass_step3.php';
                $this->load->view('home', $this->data);
            } else {
                $new_pass = $this->input->post('password', TRUE);

                $password = md5($new_pass);
                $update_data = array('password' => $password);
                $this->user->updateMainAcount($id, $update_data);
                redirect('authentication/');
            }
        }
        else
            redirect('register/index/', 'refresh');
    }

    public function checkEmail() {
        $email = $this->input->get('email');
        if ($this->register_model->checkEmail($email)) {
            echo 'false';
            exit();
        } else {
            echo 'true';
            exit();
        }
    }

    public function checkUser() {
        $this->load->model('user_model', 'user');
        $user_name = $this->input->get('username');
        $user = $this->user->getMainUserByUsername($user_name);
        if (empty($user)) {
            echo 'true';
            exit();
        }
        echo 'false';
        exit();
    }

    public function check_username($username) {
        $this->load->model('user_model', 'user');
        $user = $this->user->getMainUser(array('username' => $username));
        if (!$user) {
            $this->form_validation->set_message('check_username', 'This User is Not registered in our system. Please use a different one.');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function checkResetcode($code) {
        if (!$this->register_model->check_reset($this->email, $code)) {
            $this->form_validation->set_message('check_resetcode', "The reset code doesn't match one sent to you. Please check your information and try again.");
            return FALSE;
        } else {
            return TRUE;
        }
    }

    function validateForm() {
        $this->form_validation->set_rules('fullname', 'Full Name', 'required|trim|xss_clean|max_length[150]');
        $this->form_validation->set_rules('password', 'Password', 'required|xss_clean|max_length[50]|valid_repassword');
        $this->form_validation->set_rules('repassword', 'Re-Password', 'required|trim|xss_clean|matches[password]');
        $this->form_validation->set_rules('address', 'Address', 'required|trim|xss_clean|max_length[150]');
        $this->form_validation->set_rules('phone', 'Phone', 'required|trim|xss_clean|numeric|max_length[12]');
        $this->form_validation->set_rules('email', 'Email', 'required|xss_clean|valid_email|max_length[64]|callback_checkEmail');
        $this->form_validation->set_rules('fax', 'Fax', 'required|trim|xss_clean|numeric|max_length[12]');
        $this->form_validation->set_rules('birthday', 'Birthday', 'required|trim|xss_clean|max_length[15]|callback_valid_date');
        if ($this->form_validation->run() == TRUE) {
            return true;
        } else {
            return false;
        }
    }

    function valid_date($date) {
        $ddmmyyy = '/^(0[1-9]|1[012])[- \/.](0[1-9]|[12][0-9]|3[01])[- \/.](19|20)[0-9]{2}$/';
        if (preg_match($ddmmyyy, $date)) {
            return TRUE;
        } else {
            $this->form_validation->set_message('valid_date', 'Please enter mm-dd-yyyy');
            return FALSE;
        }
    }

    public function ajax_search() {
        $this->load->model('user_model', 'user');
        $user = $_GET['term'];
        $data = $this->user->searchUser($user);

        $results = array();
        foreach ($data as $sub) {
            $results[$sub->acount_number] = $sub->acount_number;
        }
        echo json_encode($results);
    }

}