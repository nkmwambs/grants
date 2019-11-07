<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
 *	@author 	: Nicodemus Karisa
 *	date		: 6th June, 2018
 *	AFR Staff Recognition system
 *	https://www.compassion.com
 *	NKarisa@ke.ci.org
 */

//require_once('saml2/libautoload.php');

class Login extends CI_Controller {

public $auth;

    function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->model('user_model');
    }

    //Default function, redirects to logged in user area
    public function index() {

        if ($this->session->userdata('user_login') == 1)
          redirect(base_url().'dashboard');

        $this->load->view('general/login');

    }

    //Ajax login function
    function ajax_login() {
        $response = array();

        //Recieving post input of email, password from ajax request
        $email = $_POST["email"];
        $password = $_POST["password"];
        $response['submitted_data'] = $_POST;

        //Validating login
        $login_status = $this->validate_login($email, $password);
        $response['login_status'] = $login_status;
        if ($login_status == 'success') {
            $response['redirect_url'] = '';
        }

        //Replying ajax request with validation response
        echo json_encode($response);
    }


	function create_user_session ($row,$first_login_attempt = false){

		    $this->session->set_userdata('user_login', '1');
		    $this->session->set_userdata('user_id', $row->user_id);
		    $this->session->set_userdata('name', $row->user_firstname.' '.$row->user_lastname);
        $this->session->set_userdata('role_id', $row->fk_role_id);

        $this->session->set_userdata('breadcrumb_list',array());

        $this->session->set_userdata('role_permissions',
        $this->user_model->get_user_permissions($row->fk_role_id));

        $this->session->set_userdata('system_admin',$row->user_system_admin);
        //$this->session->set_userdata('role_permissions',$this->user_model->perms($row->role_id));
        
		return 'success';
	}
    //Validating login from ajax request
    function validate_login($email = '', $password = '') {
        $credential = array('user_email' => $email,"user_is_active"=>1,"user_password"=>md5($password));

        // Checking login credential for admin
        $query = $this->db->get_where('user', $credential);

        if ($query->num_rows() > 0) {
			        $row = $query->row();
		  	      return $this->create_user_session($row);

        }

        return 'invalid';
    }

    /*     * *DEFAULT NOR FOUND PAGE**** */

    function four_zero_four() {
        $this->load->view('four_zero_four');
    }

    // PASSWORD RESET BY EMAIL
    function forgot_password()
    {
        $this->load->view('backend/forgot_password');
    }

    function ajax_forgot_password()
    {
        $resp                   = array();
        $resp['status']         = 'false';
        $email                  = $_POST["email"];
        //$reset_account_type     = '';
        //resetting user password here
        $new_password           =   substr( md5( rand(100000,200000) ) , 0,7);

        // Checking credential for user
        $query = $this->db->get_where('user' , array('user_email' => $email));
        if ($query->num_rows() > 0)
        {
            $this->db->where('user_email' , $email);
            $this->db->update('user' , array('user_password' => md5($new_password)));
            $resp['status']         = 'true';
        }


        // send new password to user email
        $this->email_model->password_reset_email($new_password , $email);
        //$this->email_model->manage_account_email($query->row()->user_id,"password_reset",true,$new_password);

        $resp['submitted_data'] = $_POST;

        echo json_encode($resp);
    }

    // function access_denied_error(){
    //   $this->load->view('general/access_denied_error');
    // }

    /*     * *****LOGOUT FUNCTION ****** */

    function logout() {
        $this->session->sess_destroy();
        $this->session->set_flashdata('logout_notification', 'logged_out');
        redirect(base_url(), 'refresh');

    }

}
