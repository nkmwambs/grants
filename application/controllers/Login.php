<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

define('DS',DIRECTORY_SEPARATOR);    

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
public $controller;

    function __construct() {
        parent::__construct();
        $this->load->database();

        $this->load->add_package_path(APPPATH.'third_party/Packages/Core');
        $this->load->model('user_model');
        $this->load->library('Language_library');
        $this->load->model('Language_model');

        // To be placed in all controller constructors but a remedy has been met in the htaccess Files block
        $this->output->set_header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
        $this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate");
        $this->output->set_header("Cache-Control: post-check=0, pre-check=0", false);
        $this->output->set_header("Pragma: no-cache"); 

        $this->controller = $this->session->default_launch_page;
    }

    //Default function, redirects to logged in user area
    public function index() {

        if(!$this->db->table_exists('setting') || $this->db->get('setting')->num_rows() == 0){
            $this->load->model('setting_model');

            // Create all tables in the database
            $this->grants_model->initialize_db_schema();
            
            // Populate setting table
            $this->setting_model->intialize_table();

        }

        // if system_setup_completed = 0, empty all tables, insert_missing_approveable_item, 
        // populate setup tables, add mandatory fields, create item approval flow and permissions
        $this->system_setup_check();
        

        if ($this->session->userdata('user_login') == 1){
             //Create missing library and models files for the loading object/ controller
             if(parse_url(base_url())['host'] == 'localhost'){
                $this->grants->create_missing_system_files_from_yaml_setup(); 
              }
            
              // Create table permissions
             $this->grants_model->create_missing_page_access_permission();
            
            // Create mandatory role_permission for default launch page  
            $this->create_mandatory_role_permissions();
            
            redirect(base_url().strtolower($this->session->default_launch_page).'/list');
        }
          

        $this->load->view('general/login');

    }

    function create_mandatory_role_permissions(){
        
        $default_page = $this->config->item('default_launch_page');
        
        $this->db->join('permission','permission.permission_id=role_permission.fk_permission_id');
        $this->db->join('menu','menu.menu_id=permission.fk_menu_id');
        $role_permission_obj = $this->db->get_where('role_permission',
        array('menu.menu_name'=>$default_page,
        'role_permission.fk_role_id'=>$this->session->role_id));

        $role_name = $this->db->get_where('role',
        array('role_id'=>$this->session->role_id))->row()->role_name;
        
        if($role_permission_obj->num_rows() == 0){
            
            $this->db->join('menu','menu.menu_id=permission.fk_menu_id');
            $permission_obj = $this->db->get_where('permission',
            array('menu_name'=>$default_page));

            $role_permission_data['role_permission_name'] = "Read permission for ".$default_page." by ".$role_name;
            $role_permission_data['role_permission_is_active'] = 1;
            $role_permission_data['fk_role_id'] = $this->session->role_id;
            $role_permission_data['fk_permission_id'] = $permission_obj->row()->permission_id;
            
            $role_permission_data_to_insert = $this->grants_model->merge_with_history_fields('role_permission',$role_permission_data,false);

            $this->db->insert('role_permission',$role_permission_data_to_insert);
        }
    }

    function system_setup_check(){
        $system_setup_state = $this->db->get_where('setting',
        array('type'=>'system_setup_completed'))->row()->description;
      
        if($system_setup_state == false){
            
            // Check if context tables exists or create if missing
            $this->grants_model->create_context_tables();

            $db_tables = $this->db->list_tables();

            // Empty all tables are reset by using truncate
            foreach($db_tables as $db_table){

                if($db_table == 'setting') continue;

                // Disable foreign keys check
                $this->db->query('SET foreign_key_checks = 0');
                $this->db->truncate($db_table);
                // Enable foreign keys check after truncating
                $this->db->query('SET foreign_key_checks = 1');
                
                // Reset the auto-increment field to 1
                $reset_auto_increment = "ALTER TABLE ".$db_table." AUTO_INCREMENT = 1";
                $this->db->query($reset_auto_increment);
            }

            // Insert approve items
            foreach($db_tables as $db_table){
                if(!$this->db->table_exists($db_table) && $db_table == 'setting') continue;
                $this->grants_model->insert_missing_approveable_item($db_table);
            }

          // Insert records for system required tables        
          $are_tables_populated = $this->grants_model->populate_initial_table_data();
          
          // Set user_id session for super user
          $this->session->set_userdata('user_id',1);

          $tables_that_dont_require_history_fields = $this->config->item('table_that_dont_require_history_fields');

          foreach($db_tables as $db_table){
              
              if(!in_array($db_table,$tables_that_dont_require_history_fields)){

               if(!$this->db->table_exists($db_table)) continue;

                // Create mandatory fields in a table i.e. created_date, last_modified_date, created_by, created_by, fk_status_id and fk_approval_id
                $this->grants_model->mandatory_fields($db_table);

                //$this->grants_model->insert_missing_approveable_item($db_table);

                // Insert approve item and status of a selected table
                $this->grants_model->insert_status_if_missing($db_table);
              }
            
          }

          //Update system_setup_completed setting to true if all tables are set up
          if($are_tables_populated){
            $this->db->update('setting',array('description'=>true),array('type'=>'system_setup_completed'));
          }

          // Create upload folders
          $this->grants->create_resource_upload_directory_structure();
          
        }
        
      }

    //Ajax login function
    function ajax_login() {
        $response = array();

        //Recieving post input of email, password from ajax request
        $email = $_POST["email"];
        // $password = !isset($_POST["password"])?$this->db->get_where('setting',array('type'=>'setup_password'))->description:$_POST["password"];
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
        $this->session->set_userdata('role_permissions',
            $this->user_model->get_user_permissions($row->fk_role_id));
        $this->session->set_userdata('system_admin',$row->user_is_system_admin); 
        $this->session->set_userdata('user_locale',$this->db->get_where('language',
            array('language_id'=>$row->fk_language_id))->row()->language_code); 
        $this->session->set_userdata('user_currency_id',$this->db->get_where('country_currency',
            array('country_currency_id'=>$row->fk_country_currency_id))->row()->country_currency_id);           
        
        $this->session->set_userdata('user_currency_code',$this->db->get_where('country_currency',
            array('country_currency_id'=>$row->fk_country_currency_id))->row()->country_currency_code);           
        
        $this->session->set_userdata('user_account_system',$row->fk_account_system_id);           
            
        $this->session->set_userdata('base_currency_id',
            $this->db->get_where('setting',array('type'=>'base_currency_code'))->row()->description);
            
        /**
         * These are Center Group Hierarchy related sessions
         */
        
         // This session carries the ids of the departments related to the current user.
         // A user may or may not have a department. A user can have multiple departments
        
        $this->session->set_userdata('departments',
           $this->user_model->user_department($row->user_id));
        
        // This session carries an array of context records related to a certain user 
        // i.e. if the user is of context country, it give an array of the records in the context_country
        // table related to this user with fields context_country_user_id, context_country_id, fk_designation_id   
        
        $this->session->set_userdata('context_associations',
           $this->user_model->get_user_context_association($row->user_id));
        
        // Retrieves the user's context definition record with 4 fields 
        // i.e. context_definition_id, context_definition_name, context_definition_level and context_definition_is_active
        // A user can only have 1 context definition relationship as defined in their user record fk_context_definition_id

        $this->session->set_userdata('context_definition',
        $this->user_model->get_user_context_definition($row->user_id));

        // This method returns office ids the user has an association with in his/her context 
        // A user can have multiple offices associated to him or her e.g. A user of context definition of a country
        // can be associated to multiple countries.  
    
        $this->session->set_userdata('context_offices',
           $this->user_model->get_user_context_offices($this->session->user_id));
        
        // This method crreates an array of all office ids in the entire context hierachy of the user. 
        // If the context of the user is country called Kenya and Uganda, this 
        // methods gives all offices related to kenya and Uganda from 
        // the cohort level (immediate next level to a country) to the center level  
        
        $this->session->set_userdata('hierarchy_offices',
           $this->user_model->user_hierarchy_offices($row->user_id));

        
        $this->session->set_userdata('role_is_department_strict',
           $this->user_model->check_role_department_strictness($this->session->role_id));

              
        
        /**
         * Breadcrumb and default page sessions
         */  
        $this->session->set_userdata('breadcrumb_list',array());        
        $default_launch_page = $this->user_model->default_launch_page($row->user_id);
        $this->session->set_userdata('default_launch_page',$default_launch_page);

        // This is a testing session. By default set to empty array
        //$this->session->set_userdata('testing',array());
        
		return 'success';
    }
    
    function isValidMd5($md5 ='') {
        return strlen($md5) == 32 && ctype_xdigit($md5);
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
        $this->load->view('general/forgot_password');
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
