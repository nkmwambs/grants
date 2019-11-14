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

        if ($this->session->userdata('user_login') == 1){
             //Create missing library and models files for the loading object/ controller
            $this->create_missing_system_files(); 
            
            redirect(base_url().strtolower($this->session->default_launch_page).'/list');
        }
          

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
        $this->session->set_userdata('center_id',9);

        $this->session->set_userdata('breadcrumb_list',array());

        $this->session->set_userdata('role_permissions',
        $this->user_model->get_user_permissions($row->fk_role_id));

        $this->session->set_userdata('system_admin',$row->user_system_admin);
        
        $default_launch_page = $this->user_model->default_launch_page($row->user_id);
        $this->session->set_userdata('default_launch_page',$default_launch_page);
          
        
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


    
function create_missing_system_files(){
  
    $raw_specs = file_get_contents(APPPATH.'version'.DIRECTORY_SEPARATOR.'spec.yaml');
  
    $specs_array = yaml_parse($raw_specs,0);
    
    $assets_temp_path = FCPATH.'assets'.DIRECTORY_SEPARATOR.'temp'.DIRECTORY_SEPARATOR;
    $controllers_path = APPPATH.'controllers'.DIRECTORY_SEPARATOR;
  
    foreach($specs_array['tables'] as $table_name => $setup){
      if(!file_exists($controllers_path.$table_name.'.php')){
        $this->create_missing_controller($table_name,$assets_temp_path);
        $this->create_missing_model($table_name,$assets_temp_path,$setup);
        $this->create_missing_library($table_name,$assets_temp_path);
      }
    }
  
  }
  
  function create_missing_controller($table, $assets_temp_path){
  
    $controllers_path = APPPATH.'controllers'.DIRECTORY_SEPARATOR;
  
    // Copy contents of assets/temp_library to the created file after the tag above
    $replaceables = array("%controller%"=>ucfirst($table),'%library%'=>$table.'_library');
  
    $this->write_file_contents($table, $controllers_path ,$assets_temp_path, $replaceables, 'controller');
  
  }
  
  function create_missing_library($table, $assets_temp_path){
   
    $libararies_path = APPPATH.'libraries'.DIRECTORY_SEPARATOR; 
  
    // Copy contents of assets/temp_library to the created file after the tag above
    $replaceables = array("%library%"=>ucfirst($table).'_library');
  
    $this->write_file_contents($table, $libararies_path ,$assets_temp_path, $replaceables, 'library');
  }
  
  function create_missing_model($table, $assets_temp_path, $table_specs){
  
    $models_path = APPPATH.'models'.DIRECTORY_SEPARATOR;
   
        // Copy contents of assets/temp_model to the created file after the tag above
        $lookup_tables = "";
        if(array_key_exists('lookup_tables',$table_specs)){
          $specs = $table_specs['lookup_tables'];
  
          $lookup_tables = implode(',', array_map(array($this,'quote_array_elements'),$specs) );
        
        }
         $replaceables = array(
           "%model%"=>ucfirst($table).'_model',
           "%table%"=>$table,
           '%dependant_table%'=> '',
           '%name%'=>$table.'_name',
           '%created_date%'=>$table.'_created_date',
           '%created_by%'=>$table.'_created_by',
           '%last_modified_date%'=>$table.'_last_modified_date',
           '%last_modified_by%'=>$table.'_last_modified_by',
           '%deleted_at%'=>$table.'_deleted_at',
           '%lookup_tables%'=>$lookup_tables
         );
   
     $this->write_file_contents($table, $models_path ,$assets_temp_path, $replaceables, 'model');
   
  }
  
  function write_file_contents($table, $sys_file_path ,$assets_temp_path, $replaceables, $temp_type = 'controller'){
  
    // Check if model is available and if not create the file
    if(!file_exists($sys_file_path.$table.'_'.$temp_type.'.php')){
  
        // Create the file  
        $handle = null;
  
        if($temp_type == 'model' || $temp_type == 'library'){
          $handle = fopen($sys_file_path.ucfirst($table).'_'.$temp_type.'.php', "w") or die("Unable to open file!");  
        }else{
          $handle = fopen($sys_file_path.ucfirst($table).'.php', "w") or die("Unable to open file!");
        }
          
        // Add the PHP opening tag to the file 
        $php_tag = '<?php';
        fwrite($handle, $php_tag);
  
        $replacefrom = array_keys($replaceables);
        
        $replacedto = array_values($replaceables);
      
        $file_raw_contents = file_get_contents($assets_temp_path.'temp_'.$temp_type.'.php');
      
        $file_contents = str_replace($replacefrom,$replacedto,$file_raw_contents);
      
        $file_code = "\n".$file_contents;
            
        fwrite($handle, $file_code);
    }
    
  }
  
  function quote_array_elements($elem){
    return ("'$elem'");
  }

}
