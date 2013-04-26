<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

$config['tables']['groups'] = 'groups';
$config['tables']['admins'] = 'admins';
$config['tables']['admins_groups'] = 'admins_groups';
$config['tables']['meta'] = 'meta';
/**
 * Site Title, example.com
 */
$config['site_title'] = "Cyacash";

/**
 * Admin Email, admin@example.com
 */
$config['admin_email'] = "no_reply@cyacash.com";

/**
 * Default group, use name
 */
$config['default_group'] = 'members';

/**
 * Default administrators group, use name
 */
$config['admin_group'] = 'admin';

/**
 * Users table column and Group table column you want to join WITH.
 * Joins from users.id
 * Joins from groups.id
 * */
$config['join']['users'] = 'admin_id';
$config['join']['groups'] = 'group_id';

/**
 * A database column which is used to
 * login with.
 * */
$config['identity'] = 'username'; //'email';

/**
 * Minimum Required Length of Password
 * */
$config['min_password_length'] = 6;

/**
 * Maximum Allowed Length of Password
 * */
$config['max_password_length'] = 20;

/**
 * Email Activation for registration
 * */
$config['email_activation'] = false;

/**
 * Manual Activation for registration
 * */
$config['manual_activation'] = false;

/**
 * Allow users to be remembered and enable auto-login
 * */
$config['remember_users'] = true;

/**
 * How long to remember the user (seconds)
 * */
$config['user_expire'] = 86500;

/**
 * Extend the users cookies everytime they auto-login
 * */
$config['user_extend_on_login'] = false;

/**
 * Send Email using the builtin CI email class
 * if false it will return the code and the identity
 * */
$config['use_ci_email'] = FALSE; //donghp

/**
 * Email content type
 * */
$config['email_type'] = 'html';

/**
 * Folder where email templates are stored.
 * Default : auth/
 * */
$config['email_templates'] = 'auth/email/';

/**
 * activate Account Email Template
 * Default : activate.tpl.php
 * */
$config['email_activate'] = 'activate.tpl.php';

/**
 * Forgot Password Email Template
 * Default : forgot_password.tpl.php
 * */
$config['email_forgot_password'] = 'forgot_password.tpl.php';

/**
 * Forgot Password Complete Email Template
 * Default : new_password.tpl.php
 * */
$config['email_forgot_password_complete'] = 'new_password.tpl.php';

/**
 * Salt Length
 * */
$config['salt_length'] = 10;

/**
 * Should the salt be stored in the database?
 * This will change your password encryption algorithm, 
 * default password, 'password', changes to 
 * fbaa5e216d163a02ae630ab1a43372635dd374c0 with default salt.
 * */
$config['store_salt'] = false;

/**
 * Message Start Delimiter
 * */
$config['message_start_delimiter'] = '<p>';

/**
 * Message End Delimiter
 * */
$config['message_end_delimiter'] = '</p>';

/**
 * Error Start Delimiter
 * */
$config['error_start_delimiter'] = '<p>';

/**
 * Error End Delimiter
 * */
$config['error_end_delimiter'] = '</p>';

/* End of file ion_auth.php */
/* Location: ./system/application/config/ion_auth.php */
