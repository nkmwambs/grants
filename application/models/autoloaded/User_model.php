<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

//require_once APPPATH."core/MY_Model.php";
/*
 *	@author 	: Nicodemus Karisa
 *	@date		: 27th September, 2018
 *	Finance management system for NGOs
 *	https://techsysnow.com
 *	NKarisa@ke.ci.org
 */

class User_model extends MY_Model
{
  public $table = 'user'; // you MUST mention the table name

  function __construct(){
    parent::__construct();
    $this->load->database();

  }

  /**
   * index
   * 
   * The model's index method
   * 
   * @return void
   */
  function index(){

  }

  /**
   * detail_table
   * 
   * It lists as an array all the table who have a foreign relationship to the User Table
   * 
   * @return Array : Table's foreign tables
   */
  function detail_tables():Array {
    
    if($this->controller == 'user'){
      $context_definition_name = $this->get_user_context_definition(hash_id($this->id,'decode'))['context_definition_name'];
      return array('context_'.$context_definition_name.'_user','department_user');
    }else{
      return array('department_user');
    }
    

  }

  function lookup_tables(){
    return array('language','role','context_definition');
  }

  /**
   * list
   * 
   * Alternative list query result from the grants model one
   * @todo Not used yet
   * 
   * @return Array
   */
  function list(){

  }

  /**
   * list_table_visible_columns
   * 
   * Visible/ selected columns to the user list action page
   * 
   * @return Array
   */
  function list_table_visible_columns(): Array {
    return array('user_id','user_track_number','user_name','user_firstname',
    'user_lastname','user_email','user_is_system_admin','user_is_active','context_definition_name');
  
  }

  function detail_list_table_visible_columns(){
    return array('user_id','user_track_number','user_name','user_firstname',
    'user_lastname','user_email','user_is_system_admin','role_name','user_is_active','context_definition_name');
 
  }

  function master_table_visible_columns(){
    return array('user_track_number','user_name','user_firstname',
    'user_lastname','user_email','user_is_system_admin','role_name','user_is_active');
  }

  /**
   * single_form_add_visible_columns
   * 
   * Visible or selected columns to the single_form_add action page
   * 
   * @return Array
   */

  function single_form_add_visible_columns(): Array {
    return array('user_name','user_firstname','user_lastname','user_email',
    'user_password','language_name','role_name','context_definition_name',
    'user_is_context_manager');
  }

  function edit_visible_columns(): Array {
    //center_group_hierarchy_name should not be added in this list since it should only be used when 
    // creating a new user and its not editable.
    return array('user_name','user_firstname','user_lastname','user_email',
    'user_is_system_admin','language_name','role_name',
    'user_is_context_manager');
  }

  /**
   * action_before_insert
   * 
   * This method changes the password to a hash of md5 before inserting to user table. 
   * This is a system contract method
   * 
   * @return Array
   */
  function action_before_insert($post_array): Array {
    $post_array['header']['user_password'] = md5($post_array['header']['user_password']);

    return $post_array;
  }

  // function get_users_with_center_group_hierarchy_name(){

  // }
 
  /**
   * action_after_insert
   * 
   * This method sends an email to new user.
   * This is a system contract method
   * 
   * @return Boolean
   */
  function action_after_insert($post_array,$approval_id,$header_id):bool{
    $this->email_model->user_registration_email($post_array);
    return true;
  }


  /***
   * **********************************************************************************************************
   * 
   * THE CODE BELOW COMPOSES OF SYSTEM WIDE CODE, THEIR ALTERATION MAY CAUSE PERFORMANCE ISSUES TO THIS
   * FRAMEWORK.
   * 
   * **********************************************************************************************************
   */

  function check_role_department_strictness($role_id){
    $role_is_department_strict = $this->db->get_where('role',
    array('role_id'=>$role_id))->row()->role_is_department_strict;

    return $role_is_department_strict;
  } 

  /**
   * user_department
   * 
   * Check if a logged user has a department association if not return empty array
   * A user can be associated to multiple departments
   * 
   * @param int $user_id - Queried user
   * @return Array - Array of department ids associated to the use
   */

   function user_department(int $user_id):Array{

      $this->db->select(array('fk_department_id'));
      $user_department = $this->db->get_where('department_user',
      array('fk_user_id'=>$user_id));

      $department_ids = array();

      if($user_department->num_rows()>0){
        $department_ids = array_column($user_department->result_array(),'fk_department_id');
      }

      return $department_ids;
   }

   /**
    * get_user_context_definition
    *
    * Retrieves the user's context definition record with 4 fields 
    * i.e. context_definition_id, context_definition_name, context_definition_level and context_definition_is_active
    * 
    * A user can only have 1 context definition relationship as defined in their user record fk_context_definition_id
    *
    * @param int $user_id
    * @return Array - Array of context definition
    */
   function get_user_context_definition(int $user_id):Array{

    $user_context_definition = "";

    $this->db->select(array('context_definition_id','context_definition_name',
    'context_definition_level','context_definition_is_active'));
    
    $this->db->join('user','user.fk_context_definition_id=context_definition.context_definition_id');
    $user_context_definition_obj = $this->db->get_where('context_definition',
    array('user_id'=>$user_id));

    if($user_context_definition_obj->num_rows() > 0){
      $user_context_definition =  $user_context_definition_obj->row_array();
    }
    
    return $user_context_definition;
  }


    /**
     * get_user_context_offices
     * 
     * This method returns office ids the user has an association with in his/her context
     * 
     * A user can have multiple offices associated to him or her e.g. A user of context definition of a country
     * can be associated to multiple countries.
     * 
     * @param int $user_id 
     * @return Array - Office ids
     */

    function get_user_context_offices(int $user_id):Array{

      $context_defs = $this->grants->context_definitions();
           
      // User context
      $user_context_name = strtolower($this->get_user_context_definition($user_id)['context_definition_name']);
          
      // User context user table
      $context_table = $context_defs[$user_context_name]['context_table'];
      $context_user_table = $context_defs[$user_context_name]['context_user_table'];

      $this->db->select(array('office_name','office_id'));
      
      $this->db->join($context_table,$context_table.'.'.$context_table.'_id='.$context_user_table.'.fk_'.$context_table.'_id');
      $this->db->join('office','office.office_id='.$context_table.'.fk_office_id');
      $user_context_obj = $this->db->get_where($context_user_table,array('fk_user_id'=>$user_id));
      
      $user_offices =  array();    

      if($user_context_obj->num_rows()>0){
        //$user_offices_names = array_column($user_context_obj->result_array(),'office_name'); 
        //$user_offices_ids = array_column($user_context_obj->result_array(),'office_id'); 
        //$user_offices = array_combine($user_offices_ids,$user_offices_names);
        $user_offices = $user_context_obj->result_array();
      }
      
      return $user_offices;
    }

  /**
    * get_user_context_association
    *
    * This method retrieves an array of context records related to a certain user 
    * i.e. if the user is of context country, it give an array of the records in the context_country
    * table related to this user with fields context_country_user_id, context_country_id, fk_designation_id 
    * 
    * @param int $user_id
    * @return Array - A user's context records
    */

    function get_user_context_association(int $user_id):Array {

      $associations_array = array();

      $context_definition = $this->get_user_context_definition($user_id);
      $context_table = 'context_'.strtolower($context_definition['context_definition_name']);
      $context_users_table = 'context_'.strtolower($context_definition['context_definition_name']).'_user';
      $context_users_table_id = $this->grants->primary_key_field($context_users_table);
     
      $this->db->select(array($context_users_table_id,
      $context_table.'_id','fk_designation_id'));
      
      $this->db->join($context_table,$context_table.'.'.$context_table.'_id='.$context_users_table.'.fk_'.$context_table.'_id');
      $associations = $this->db->get_where($context_users_table,
      array('fk_user_id'=>$user_id,$context_users_table.'_is_active'=>1));

      if($associations->num_rows()>0){
        $associations_array = $associations->result_array();
      }
      
      return $associations_array; 
    }

    /**
     * Need to update this to work with user_ids as well
     */
    function get_available_office_user_context_by_email_context_definition($user_email,$context_definition_id){
          
        $context_definition = $this->db->get_where('context_definition',array('context_definition_id'=>$context_definition_id))->row();
        
        $context_definition_table = 'context_'.$context_definition->context_definition_name;
        $context_definition_user_table = $context_definition_table.'_user';

        $this->db->select(array('user_id','user_email','fk_context_definition_id','context_definition_name'));
        $this->db->join('context_definition','context_definition.context_definition_id=user.fk_context_definition_id');
        $user_obj = $this->db->get_where('user',array('user_email'=>$user_email));

        $user_id = 0;

        $result = [];

        // Check if user exists
        if($user_obj->num_rows() > 0 ){
          $error_message = 'A user can only have one office context assignment. The current user office context is "'.$user_obj->row()->context_definition_name .'" and you are attempting to assign "'.$context_definition->context_definition_name.'"';
          // Check user has a context
          if(count($this->user_model->get_user_context_association($user_obj->row()->user_id)) > 0){
            // Check if user context matches the post context
            
            $array_key_exists = array_key_exists($context_definition_table.'_id',$this->user_model->get_user_context_association($user_obj->row()->user_id)[0]);

            if($array_key_exists){
              $user_assigned_context = array_column($this->user_model->get_user_context_association($user_obj->row()->user_id),$context_definition_table.'_id');
              $this->db->select(array($context_definition_table.'_id as context_table_id',$context_definition_table.'_name as context_table_name'));
              $this->db->where_not_in($context_definition_table.'_id',$user_assigned_context);
              $this->db->where(array('office_is_active'=>1));
              $this->db->join('office','office.office_id='.$context_definition_table.'.fk_office_id');//office_is_active
              $result_obj = $this->db->get($context_definition_table);
              
              if($result_obj->num_rows() > 0){
                $result['result'] = $result_obj->result_array();
                $result['message'] = true;
              }else{
                $result['result'] = [];
                $result['message'] = 'All active offices in the context '.$context_definition->context_definition_name.' definition are assigned to this user with email '.$user_email;
              }
              
            }else{
              $result['result'] = [];
              $result['message'] = $error_message;
            }
            
          }elseif($context_definition->context_definition_id == $user_obj->row()->fk_context_definition_id){
            $this->db->select(array($context_definition_table.'_id as context_table_id',$context_definition_table.'_name as context_table_name'));
            $result['result'] = $this->db->get($context_definition_table)->result_array();
            $result['message'] = true;
          }else{
            $result['result'] = [];
            $result['message'] = $error_message;
          }

        }else{
          $this->db->select(array($context_definition_table.'_id as context_table_id',$context_definition_table.'_name as context_table_name'));
          $result['result'] = $this->db->get($context_definition_table)->result_array();
          $result['message'] = true;
        }

        return $result;
    }

    function get_reporting_context_levels($user_context_level){
      
      $this->db->select(array('context_definition_name'));
      $hierachy_context = $this->db->order_by('context_definition_level','ASC')
      ->get_where('context_definition',array('context_definition_level<='=>$user_context_level))->result_array();
      
      return $hierachy_context;
    }

    function get_lowest_office_context(){
      return $this->db->get_where('context_definition',array('context_definition_level'=>1))->row();
    }

    function get_highest_office_context(){
      $context_definition_level = $this->db->select_max('context_definition_level')->get('context_definition')->row()->context_definition_level;
      return $this->db->get_where('context_definition',array('context_definition_level'=>$context_definition_level))->row();
    }

    /**
     * user_hierarchy_offices
     * 
     * This method crreates an array of all office ids in the entire context hierachy of the user.
     * 
     * If the context of the user is country called Kenya and Uganda, this 
     * methods gives all offices related to kenya and Uganda from 
     * the cohort level (immediate next level to a country) to the center level
     * 
     * @param String $user_id
     * @param Bool $show_context - If true office Ids will be grouped by their respective contexts
     * @return Array 
     * @todo  $show_context is not functional. The array produced is mixed up and cod has been commented for review
     */

    function user_hierarchy_offices($user_id,$show_context = false){
      $user_hierarchy_offices_ids = [];
      
      $user_context_definition = $this->get_user_context_definition($user_id);
      
      /**
       * $this->get_user_context_definition($user_id):
       * 
       * Array ( 
       *    [context_definition_id] => 10 
       *    [context_definition_name] => country 
       *    [context_definition_level] => 4 
       *    [context_definition_is_active] => 1 
       * )
       */

      $context_definitions = $this->grants->context_definitions();

      /**
       * $this->grants->context_definitions():
       * 
       * Array ( 
       * [center] => Array ( 
       *    [context_table] => context_center 
       *    [context_user_table] => context_center_user 
       *    [fk] => fk_context_center_id ) 
       * [cluster] => Array ( 
       *    [context_table] => context_cluster 
       *    [context_user_table] => context_cluster_user 
       *    [fk] => fk_context_cluster_id ) 
       * [cohort] => Array ( 
       *    [context_table] => context_cohort 
       *    [context_user_table] => context_cohort_user 
       *    [fk] => fk_context_cohort_id ) 
       * [country] => Array ( 
       *    [context_table] => context_country 
       *    [context_user_table] => context_country_user 
       *    [fk] => fk_context_country_id ) 
       * [region] => Array ( 
       *    [context_table] => context_region 
       *    [context_user_table] => context_region_user 
       *    [fk] => fk_context_region_id ) 
       * [global] => Array ( 
       *    [context_table] => context_global 
       *    [context_user_table] => context_global_user 
       *    [fk] => fk_context_global_id ) )
       */
      
      $user_context = $user_context_definition['context_definition_name']; // e.g. country
      $user_context_table = $context_definitions[$user_context]['context_table']; // e.g. context_country
      $user_context_table_user = $context_definitions[$user_context]['context_user_table']; // e.g. context_country_user
      
      $user_context_level = $context_definitions[$user_context]['context_definition_level'];//e.g. 1 or 2 ....n    $this->db->get_where('context_definition',array('context_definition_name'=>$user_context))->row()->context_definition_level;

      // A user can have multiple context association records e.g. Multiple countries
      $user_context_association = array_column($this->get_user_context_association($user_id),$user_context_table.'_id');
        /**
         * $this->get_user_context_association($user_id):
         * 
         * Array ( [0] => Array ( 
         *    [context_country_user_id] => 1 [context_country_id] => 1 [fk_designation_id] => 7 ) 
         *    [context_country_user_id] => 1 [context_country_id] => 2 [fk_designation_id] => 7 ) 
         * )
         */
      $hierachy_context_obj = $this->get_reporting_context_levels($user_context_level);
      /**
       * if 2 i.e. cluster level is passed to $this->get_reporting_context_levels($user_context_level):
       * 
       * Array ( 
       * [0] => Array ( [context_definition_name] => center ) 
       * [1] => Array ( [context_definition_name] => cluster ) )
       *  */ 
      $hierachy_contexts = array_column($hierachy_context_obj,'context_definition_name');
        

      $user_hierarchy_offices = array();
      $office_ids = array();

      $cnt = 0;

      foreach($user_context_association as $user_context_id){     
        //$user_context_id can be ids for centers, countries depending on the user context assigned
        foreach($hierachy_contexts as $hierarchy_context){
          //$hierarchy_context can be center or cluster or cohort depending on the user context level

            $looped_context_offices = $this->_user_hierarchy_offices($user_context, $user_context_id, $hierarchy_context);

            if($show_context){
              $user_hierarchy_offices[$hierarchy_context] = $looped_context_offices;
            }else{
              $user_hierarchy_offices = array_merge($user_hierarchy_offices,$looped_context_offices);
            }
              
            $cnt++;
            
        }
        
      }      

      return $user_hierarchy_offices;
    }
    
    //Context can be global, region, country, cohort, cluster, center 
    /**
     * user_hierarchy_offices
     * 
     * This method in looped in the user_hierarchy_offices method. It creates an array of office ids
     * in a givem context. E.g. For example if the user's context is country, 
     * it gives all offices of a passed lower context e.g. cluster for that given user's country
     * 
     * @param $user_context - The actual context of the user
     * @param $user_context_id - Id of the user office context
     * @param $looping_context - Looped hierachical context e.g. if $user_context is country then $looping_context can be either cohort, cluster or center
     * 
     * @return Array - office ids in the looped context
     * 
     * @todo - Prevent using this method in a loop of context. Consider passing param 1 and 2 and get all office ids
     */
     function _user_hierarchy_offices($user_context, $user_context_id, $looping_context){
       

      $user_context_table = 'context_'.$user_context;
      $user_context_level = $this->grants->context_definitions()[$user_context]['context_definition_level'];

      $this->db->select(array('office_id','office_name'));

      if($looping_context == 'center'){

        //$this->db->select(array('context_center.fk_office_id as office_id'));
        if($user_context_level > 5) $this->db->join('context_region','context_region.fk_context_global_id=context_global.context_global_id');
        if($user_context_level > 4) $this->db->join('context_country','context_country.fk_context_region_id=context_region.context_region_id');
        if($user_context_level > 3) $this->db->join('context_cohort','context_cohort.fk_context_country_id=context_country.context_country_id');
        if($user_context_level > 2) $this->db->join('context_cluster','context_cluster.fk_context_cohort_id=context_cohort.context_cohort_id');
        if($user_context_level > 1) $this->db->join('context_center','context_center.fk_context_cluster_id=context_cluster.context_cluster_id');  
        
      }elseif($looping_context == 'cluster'){

        //$this->db->select(array('context_cluster.fk_office_id as office_id'));
        if($user_context_level > 5) $this->db->join('context_region','context_region.fk_context_global_id=context_global.context_global_id');
        if($user_context_level > 4) $this->db->join('context_country','context_country.fk_context_region_id=context_region.context_region_id');
        if($user_context_level > 3) $this->db->join('context_cohort','context_cohort.fk_context_country_id=context_country.context_country_id');
        if($user_context_level > 2) $this->db->join('context_cluster','context_cluster.fk_context_cohort_id=context_cohort.context_cohort_id');
        
      }elseif($looping_context == 'cohort'){
        
        //$this->db->select(array('context_cohort.fk_office_id as office_id'));
        if($user_context_level > 5) $this->db->join('context_region','context_region.fk_context_global_id=context_global.context_global_id');
        if($user_context_level > 4) $this->db->join('context_country','context_country.fk_context_region_id=context_region.context_region_id');
        if($user_context_level > 3) $this->db->join('context_cohort','context_cohort.fk_context_country_id=context_country.context_country_id');
 
      }elseif($looping_context == 'country'){
        
        //$this->db->select(array('context_country.fk_office_id as office_id'));
        if($user_context_level > 5) $this->db->join('context_region','context_region.fk_context_global_id=context_global.context_global_id');
        if($user_context_level > 4) $this->db->join('context_country','context_country.fk_context_region_id=context_region.context_region_id');
        
      }elseif($looping_context == 'region'){
        
        //$this->db->select(array('context_region.fk_office_id as office_id'));
        if($user_context_level > 5) $this->db->join('context_region','context_region.fk_context_global_id=context_global.context_global_id');

      }
      
      $this->db->join('office','office.office_id=context_'.$looping_context.'.fk_office_id');
      $hierarchy_offices = $this->db->get_where($user_context_table,array($user_context_table.'_id'=>$user_context_id))->result_array();
      
      //$hierarchy_offices_ids = array_column($hierarchy_offices,'office_id');

      return $hierarchy_offices;
    }

    
    function user_associated_office_names($user_id){
      $user_associated_centers = $this->get_centers_in_center_group_hierarchy($user_id);

      $options = array();

      $this->db->select(array('center_id','center_name'));
      $this->db->where_in('center_id',$user_associated_centers); 
      $result = $this->db->get('center');
      
      if($result->num_rows()>0){
        $center_id = array_column($result->result_array(),'center_id');
        $center_name = array_column($result->result_array(),'center_name');
        $options = array_combine($center_id,$center_name);
      }
      return $options;
    }

    

  /**
   * default_launch_page
   * 
   * Setting the default launch page if user detail table has any for the logged user otherwise use the one 
   * provided by the config file (grants)
   * 
   * @param $user_id int : User id 
   * @todo Not yet able to read the data from the User detail table
   * 
   * @return String : Alternative default launch page specific to this user
   */
  function default_launch_page($user_id){

    $default_launch_page = $this->config->item('default_launch_page');

    // $this->db->select(array('user_detail_value'));
    // $this->db->join('user_detail','user_detail.fk_user_id=user.user_id');
    // $this->db->join('user_setting','user_setting.user_setting_id=user_detail.fk_user_setting_id');
    // $user_object = $this->db->get_where('user',
    // array('user_id'=>$user_id,'user_setting_name'=>'default_launch_page'));

    // if($user_object->num_rows() > 0){
    //   $default_lauch_page = $user_object->row()->default_lauch_page;
    // }

    return strtolower($default_launch_page);

  }

  /**
   * get_user_permissions
   * 
   * Get all permissions of a given role as an array of format [table:[permission_type:[permission_label:[permission_name]]]]
   * 
   * @param $role_id : Role of a user
   * 
   * @return Array
   */
  function get_user_permissions($role_id){    
 
      $role_permission_array = array();

      // Get role permissions for the role
      $this->db->select(array('menu_derivative_controller','permission_type','permission_label_name',
      'permission_field','permission_name'));
      //$this->db->select(array('menu_derivative_controller','permission_label_name','permission_name'));    
      
      $this->db->join('permission','permission.permission_id=role_permission.fk_permission_id');
      $this->db->join('permission_label','permission_label.permission_label_id=permission.fk_permission_label_id');
      $this->db->join('menu','menu.menu_id=permission.fk_menu_id');
  
      $role_permissions_object = $this->db->get_where('role_permission',
      array('fk_role_id'=>$role_id,'role_permission_is_active'=>1));
  
      // Build the $role_permission_array if $role_permissions_object is not empty
  
        if($role_permissions_object->num_rows() > 0){
  
          $role_permissions = $role_permissions_object->result_object();
  
          foreach($role_permissions as $row){   
              if($row->permission_type == 1){
                $role_permission_array[$row->menu_derivative_controller][$row->permission_type][$row->permission_label_name][] = $row->permission_name;  
              
                //Update the role_permission_array based on the permissible depth of the label $row->permission_label_name
                $role_permission_array = $this->update_permitted_permission_labels_based_on_depth($role_permission_array,$row->menu_derivative_controller,$row->permission_label_name);
              
              }elseif($row->permission_type == 2){
                $role_permission_array[$row->menu_derivative_controller][$row->permission_type][$row->permission_label_name][$row->permission_field] = $row->permission_name;
              }
              
          }
        
        }

        // Check if default permission is not present, add it

        if( !array_key_exists($this->config->item('default_launch_page'),$role_permission_array) || 
            !in_array('read',$role_permission_array)
          ){
          $role_permission_array[$this->config->item('default_launch_page')][1]['read'][] = "show_dashboard";
        }
        
        return $role_permission_array;
  }

  function check_if_user_has_office_data_view_edit_permission(){
    
    $has_permission = true;
    
    if($this->action == 'view' || $this->action == 'edit'){
      $lookup_tables = $this->grants->lookup_tables($this->controller);

      if(in_array('center',$lookup_tables)){
        $center_id = $this->db->get_where($this->controller,
        array($this->grants->primary_key_field($this->controller)=>hash_id($this->id,'decode')))->row()->fk_center_id;
        
        if(!in_array($center_id,$this->user_hierarchy_offices($this->session->user_id))){
          $has_permission = false;
        }

      }
      
    }

    return $has_permission;
  }

  /**
   * permission_label_depth
   * 
   * Creates an array of permitted permission labels based on a passed label. E.g. In order of 
   * read, create, update, delete, if update is passed, the resultant array of permitted labels will be
   * [read, create]
   * 
   * @param String $permission_label
   * @return Array - Array of permitted permission labels in the order from lower depth to higher
   * The passed permission label is excluded 
   */

  function permission_label_depth($permission_label){

    //Get permission labels by order of their depth. Remove non-applicable permission labels
    $this->db->select(array('permission_label_name'));
    $permission_labels = $this->db->order_by('permission_label_depth','ASC')
    ->get('permission_label')->result_array();

    $applicable_permission_labels = [];

    foreach($permission_labels as $row){

      // Stop building the array when we meet argument permission label
      if($row['permission_label_name'] == $permission_label) break;
      
      $applicable_permission_labels[] = $row;      
    }

    $permission_label_depth = array_column($applicable_permission_labels,'permission_label_name');

    return $permission_label_depth;
  }

  /**
   * update_permitted_permission_labels_based_on_depth
   * 
   * Rebuilds the role_permissions session if the permission_label_depth size is gt 0.
   * This means the passed label has lower siblings permission label
   * 
   * @param String $active_controller
   * @param String $permission_label
   * @param int $permission_type
   * 
   * @return void - Resets the role_permissions session
   */
  function update_permitted_permission_labels_based_on_depth($permissions, $active_controller, $permission_label, $permission_type = 1){
    $permission_label_depth = $this->permission_label_depth($permission_label);
    //$permissions = $this->session->role_permissions;

    $updated_permissions = array();

    $active_controller = ucfirst($active_controller);

    foreach($permissions as $controller => $permission){
      $controller = ucfirst($controller);

      if( $controller == $active_controller && array_key_exists($permission_type,$permissions[$controller]) 
      ){
        
        $updated_permissions[$controller][$permission_type][$permission_label][] = $permission_label."_".strtolower($controller);
        
        // Only add a applicable_permission_label if the permission_label_depth has something
        if(count($permission_label_depth) > 0 ){
            
            foreach($permission_label_depth as $applicable_permission_label){
              //Prevents re-adding the applicable_permission_label if already exists
              //if(!array_key_exists($applicable_permission_label,$permissions[$controller][$permission_type])){
                $updated_permissions[$controller][$permission_type][$applicable_permission_label][] = $applicable_permission_label.'_'.strtolower($controller);
              //}
            }
          }
      }else{
       $updated_permissions[$controller] = $permission;
      }
    }
    

    //$this->session->set_userdata('role_permissions',$updated_permissions);
    return $updated_permissions;
  }

  /**
   * check_role_has_permissions
   * 
   * Check if a user user has permission to access a page or 
   * any of the controlled fields in of a selected table.   
   * 
   * @param $active_controller String : Selected Table
   * @param $permission_label String : Permission label [Can be create, read, update or delete]
   * @param $permission_type int : Can with be 1 or 2; 1 means Page Access Permission and 2 means Field Access Permission
   * 
   * @return Boolean
   */
  function check_role_has_permissions(String $active_controller,String $permission_label,int $permission_type = 1): bool {
      $has_permission = false;

      $active_controller = ucfirst($active_controller);

      $permission = $this->session->role_permissions;

      //if(isset($permission[$active_controller][$permission_type]) && array_key_exists($permission_label,$permission[$active_controller][$permission_type])){
        //$this->update_permitted_permission_labels_based_on_depth($active_controller,$permission_label,$permission_type);//$this->session->role_permissions;
      //}

      $lookup_tables = $this->grants->lookup_tables($this->controller);

      if( 
          ( is_array($permission) && array_key_exists($active_controller,$permission) 
            && array_key_exists($permission_type,$permission[$active_controller]) 

            && array_key_exists($permission_label,$permission[$active_controller][$permission_type]) 
            
            && count($this->get_user_context_association($this->session->user_id)) > 0 
            && $this->check_if_user_has_office_data_view_edit_permission() 
            && count($this->session->departments) > 0
          ) 
          || $this->session->system_admin
        ){
          $has_permission = true;
        } 
  
       return $has_permission; 
  }

//   function check_role_has_permissions_test(String $active_controller,String $permission_label,int $permission_type = 1) {
      
//     $this->update_permitted_permission_labels_based_on_depth($active_controller,$permission_label,$permission_type);//$this->session->role_permissions;
//     $permission = $this->session->role_permissions;

//     $has_permission = false;

//     $active_controller = ucfirst($active_controller);

//     //$lookup_tables = $this->grants->lookup_tables($this->controller);

//     if( 
//         ( array_key_exists($active_controller,$permission) 
//           && array_key_exists($permission_type,$permission[$active_controller]) 
//           && array_key_exists($permission_label,$permission[$active_controller][$permission_type]) 
//           && count($this->get_user_context_association($this->session->user_id)) > 0 
//           && $this->check_if_user_has_office_data_view_edit_permission() 
//           && count($this->session->departments) > 0
//         ) 
//           || $this->session->system_admin
//       )
//       {
//         $has_permission = true;
//       } 

//      return $has_permission; 
// }

  /**
   * check_role_has_field_permission
   * It helps to check if the logged user has permission to acccess a controlled field based on their role
   * Any field that has been flagged in the permission table is referred to as a controlled field
   * 
   * @param $active_controller String : Active table
   * @param $permission_label String : Selected permission label [Can be create, update, delete or read]
   * @param $column String : Name of the passed column to check permission for
   * 
   * @return Boolean : True means has pemission while False means has no permission
   */
  function check_role_has_field_permission(String $active_controller,String $permission_label,
  String $column): bool {
    
    $has_permission = false;
    
    $active_controller = ucfirst($active_controller);

    // Forces checking a field of a detail table
    if(strpos($active_controller,"_detail") ==  true){
      $active_controller = substr($active_controller,0,-7);
    }
   

    //Is the passed column is a permission controlled field?
    /**
     * DON'T KNOW WHY THE CI QUERY DOESN'T WORK BUT THE NATIVE SQL DOES FOR EDIT ACTION PAGES
     */
    //$this->db->join('menu','menu.menu_id=permission.fk_menu_id');
    //$is_column_controlled = $this->db->get_where('permission',array('menu_derivative_controller'=>$active_controller,'permission_field'=>$column));
    
    $sql = "SELECT * FROM permission JOIN menu ON permission.fk_menu_id=menu.menu_id WHERE menu_derivative_controller = '".$active_controller."' AND permission_field='".$column."'";
    $is_column_controlled = $this->db->query($sql);

    if($is_column_controlled->num_rows() > 0){
      // Yes, it permission controlled
      $has_permission = $this->check_role_has_permissions($active_controller,$permission_label,2);
      
    }else{
      // No its not permission controlled
      $has_permission = true;
      
    }


    return $has_permission;

  }

  function detail_multi_form_add_visible_columns(){

  }

//To be implemented in the primary table model rather than in the secondary table model
  function lookup_values_where($table){
        
    // $query_condition_array = array();

    // if($this->uri->segment(4)){
    //     $hierarchy_id = $this->db->get_where('center_group_hierarchy',
    //     array('center_group_hierarchy_table_name'=>$this->uri->segment(4,'group_center')))->row()->center_group_hierarchy_id;
        
    //     $query_condition_array = array('fk_center_group_hierarchy_id'=>$hierarchy_id);
    // }

    
    // return $query_condition_array;
}
  

function get_user_full_name($user_id){
  $user = $this->db->get_where('user',array('user_id'=>$user_id))->row();

  return $user->user_firstname.' '.$user->user_lastname;
}

function intialize_table(Array $foreign_keys_values = []){

  $context_definitions = $this->config->item('context_definitions');
  $global_context_key = count($context_definitions) + 1;
  
  $user_data['user_id'] = 1;
  $user_data['user_track_number'] = $this->grants_model->generate_item_track_number_and_name('user')['user_track_number'];
  $user_data['user_name'] = 'system';
  $user_data['user_firstname'] = 'System User';
  $user_data['user_lastname'] = 'System User'; 
  $user_data['user_email'] = $this->db->get_where('setting',array('type'=>'system_email'))->row()->description;
  $user_data['fk_context_definition_id'] = $global_context_key;
  $user_data['user_is_context_manager'] = 0;
  $user_data['user_is_system_admin'] = 1;
  $user_data['fk_language_id'] = $foreign_keys_values['language_id'];
  $user_data['user_is_active'] = 1;
  $user_data['fk_role_id'] = $foreign_keys_values['role_id'];
  $user_data['user_password'] =  $this->db->get_where('setting',array('type'=>'setup_password'))->row()->description;//md5('#Compassion321');
      
  $user_data_to_insert = $this->grants_model->merge_with_history_fields('user',$user_data,false);
  $this->db->insert('user',$user_data_to_insert);

  return $this->db->insert_id();
}

}