<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

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
    // $center_group_user_table = "";

    // if($this->action == 'view'){

    //   $user_id = hash_id($this->uri->segment(3),'decode');

    //   $center_group_user_table = $this->get_center_group_hierarchy_user_table_name($user_id);
    // }

    // return array($center_group_user_table,'department_user');
    return array();
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
    * get_center_group_table_name
    * Gets the name of the center group hierarchy
    * @param int $user_id
    * @return Array - Array of the center group hierarchy record
    */
   function get_user_context_definition(int $user_id):Array{

    $center_group_hierarchy_record = "";

    $this->db->select(array('context_definition_id','context_definition_name',
    'context_definition_level','context_definition_is_active'));
    
    $this->db->join('user','user.fk_context_definition_id=context_definition.context_definition_id');
    $center_group_obj = $this->db->get_where('context_definition',
    array('user_id'=>$user_id));

    if($center_group_obj->num_rows() > 0){
      $center_group_hierarchy_record =  $center_group_obj->row_array();
    }
    
    return $center_group_hierarchy_record;
  }


    /**
     * get_user_context_offices
     * 
     * This method returns offices the user has an association with in his/her context
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

      $this->db->select(array('fk_office_id'));
      $this->db->join($context_table,$context_table.'.'.$context_table.'_id='.$context_user_table.'.fk_'.$context_table.'_id');
      $user_context_obj = $this->db->get_where($context_user_table,array('fk_user_id'=>$user_id));
      
      $user_offices =  array();    

      if($user_context_obj->num_rows()>0){
        $user_offices = array_column($user_context_obj->result_array(),'fk_office_id'); 
      }
      
      return $user_offices;
    }

       /**
    * get_user_context_association
    *
    * This method retrieves an array of context records related to a certain user
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

     
      $this->db->select(array($context_users_table_id,'fk_user_id',
      $context_table.'_id','fk_designation_id'));
      
      //$this->db->join('context_definition','context_definition.context_definition_id=');
      $this->db->join($context_table,$context_table.'.'.$context_table.'_id='.$context_users_table.'.fk_'.$context_table.'_id');
      $associations = $this->db->get_where($context_users_table,
      array('fk_user_id'=>$user_id));

      if($associations->num_rows()>0){
        $associations_array = $associations->result_array();
      }
      
      return $associations_array; 
    }

    function user_hierarchy_offices($user_id,$show_context = false){
      
      $user_context = 'country'; // Template variable

      $context_definitions = $this->grants->context_definitions();
      
      $user_context_table = $context_definitions[$user_context]['context_table'];
      $user_context_table_user = $context_definitions[$user_context]['context_user_table'];
      
      $user_context_level = $this->db->get_where('context_definition',array('context_definition_name'=>$user_context))->row()->context_definition_level;

      $user_context_id = 1; // Template variable

      $this->db->select(array('context_definition_name'));
      $hierachy_context_obj = $this->db->order_by('context_definition_level','ASC')
      ->get_where('context_definition',array('context_definition_level<='=>$user_context_level))->result_array();

      $hierachy_contexts = array_column($hierachy_context_obj,'context_definition_name');
      
      $user_hierarchy_offices = array();

      foreach($hierachy_contexts as $hierarchy_context){
        if($show_context) 
          $office_ids[$hierarchy_context] = $this->get_office_hierarchy($user_context_table, $user_context_level, $user_context_id, $hierarchy_context);
        else
          $office_ids = $this->get_office_hierarchy($user_context_table, $user_context_level, $user_context_id, $hierarchy_context);
        
        $user_hierarchy_offices = array_merge($user_hierarchy_offices,$office_ids);
      }
      
      return $user_hierarchy_offices;
    }
    
    //Context can be global, region, country, cohort, cluster, center 
    function get_office_hierarchy($user_context_table, $user_context_level, $user_context_id, $hierarchy_context){

      if($hierarchy_context == 'center'){

        $this->db->select(array('context_center.fk_office_id as office_id'));
        if($user_context_level > 5) $this->db->join('context_region','context_region.fk_context_global_id=context_global.context_global_id');
        if($user_context_level > 4) $this->db->join('context_country','context_country.fk_context_region_id=context_region.context_region_id');
        if($user_context_level > 3) $this->db->join('context_cohort','context_cohort.fk_context_country_id=context_country.context_country_id');
        if($user_context_level > 2) $this->db->join('context_cluster','context_cluster.fk_context_cohort_id=context_cohort.context_cohort_id');
        if($user_context_level > 1) $this->db->join('context_center','context_center.fk_context_cluster_id=context_cluster.context_cluster_id');  
        
      }elseif($hierarchy_context == 'cluster'){

        $this->db->select(array('context_cluster.fk_office_id as office_id'));
        if($user_context_level > 5) $this->db->join('context_region','context_region.fk_context_global_id=context_global.context_global_id');
        if($user_context_level > 4) $this->db->join('context_country','context_country.fk_context_region_id=context_region.context_region_id');
        if($user_context_level > 3) $this->db->join('context_cohort','context_cohort.fk_context_country_id=context_country.context_country_id');
        if($user_context_level > 2) $this->db->join('context_cluster','context_cluster.fk_context_cohort_id=context_cohort.context_cohort_id');
        
      }elseif($hierarchy_context == 'cohort'){
        
        $this->db->select(array('context_cohort.fk_office_id as office_id'));
        if($user_context_level > 5) $this->db->join('context_region','context_region.fk_context_global_id=context_global.context_global_id');
        if($user_context_level > 4) $this->db->join('context_country','context_country.fk_context_region_id=context_region.context_region_id');
        if($user_context_level > 3) $this->db->join('context_cohort','context_cohort.fk_context_country_id=context_country.context_country_id');
 
      }elseif($hierarchy_context == 'country'){
        
        $this->db->select(array('context_country.fk_office_id as office_id'));
        if($user_context_level > 5) $this->db->join('context_region','context_region.fk_context_global_id=context_global.context_global_id');
        if($user_context_level > 4) $this->db->join('context_country','context_country.fk_context_region_id=context_region.context_region_id');
        
      }elseif($hierarchy_context == 'region'){
        
        $this->db->select(array('context_region.fk_office_id as office_id'));
        if($user_context_level > 5) $this->db->join('context_region','context_region.fk_context_global_id=context_global.context_global_id');

      }

      $hierarchy_offices = $this->db->get_where($user_context_table,array($user_context_table.'_id'=>$user_context_id))->result_array();
      
      $hierarchy_offices_ids = array_column($hierarchy_offices,'office_id');

      return $hierarchy_offices_ids;
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

    function get_user_center_unit($user_id){
      // $center_group_info = $this->get_center_group_hierarchy_information($user_id);
      // $unit_table_name = $center_group_info['center_group_hierarchy_unit_table_name'];

      // $this->db->join($unit_table_name,$unit_table_name.'.fk_center_id=center.center_id');
      // return $this->db->get_where('center',array(''))->row();
    }

    // This method is too long and unkept. It requires review though working.
    function get_centers_in_center_group_hierarchy($user_id){

      $hierarchy_info = $this->get_center_group_hierarchy_information($user_id);

      $hierarchy_table_name = $hierarchy_info['center_group_hierarchy_table_name'];

      $hierarchy_user_table_name = $hierarchy_info['center_group_hierarchy_user_table_name'];

      $level = $hierarchy_info['center_group_hierarchy_level'];

      //$hierarchy_table = strtolower($hierarchy_info['center_group_hierarchy_name']);

      //$associations = $this->get_user_context_association($user_id);
      //$this->db->select(array('fk_center_id',''));
      $this->db->join($hierarchy_table_name,$hierarchy_table_name.'.'.$hierarchy_table_name.'_id='.$hierarchy_user_table_name.'.fk_'.$hierarchy_table_name.'_id');
      $associations = $this->db->get_where($hierarchy_user_table_name)->result_array();

      $center_group_hierarchy_id = $this->db->get_where('user',
      array('user_id'=>$user_id))->row()->fk_center_group_hierarchy_id;


      $list_of_centers = array();

      if($level == 1){
        $list_of_centers = array_column($associations,'fk_center_id');       
      }else{
        $this->db->select(array('center_group_hierarchy_table_name'));
        $center_group_hierarchy_level = $this->db->order_by('center_group_hierarchy_level', 'ASC')
        ->get_where('center_group_hierarchy',
        array('center_group_hierarchy_level<='=>$level));

        $raw = $center_group_hierarchy_level->result_array();

        $center_group_tables = array_column($raw,'center_group_hierarchy_table_name');

        for($i=0;$i<count($center_group_tables);$i++){
            
          if(isset($center_group_tables[$i+1])){
            $deep_table = strtolower($center_group_tables[$i]);
            $joining_table = strtolower($center_group_tables[$i+1]);
            
            // $str .= $joining_table.','.$joining_table.'.'.$joining_table.'_id='.$deep_table.'.fk_'.$joining_table.'_id</br>';
            $this->db->join($joining_table,$joining_table.'.'.$joining_table.'_id='.$deep_table.'.fk_'.$joining_table.'_id');
          }
          
        }

        $associations_array = array_column($associations,'fk_'.$hierarchy_table_name.'_id');

        //$this->db->where($hierarchy_table_name."_id IN (".implode(',',$associations_array).")");

        //$this->db->select(array('center_id'));
          
        //$list_of_centers = array_column($this->db->get('center')->result_array(),'center_id');
        
      }
      
      return $list_of_centers;

    }

    function get_users_with_center_group_hierarchy_name($center_group_hierarchy_name){
      // $center_group_hierarchy_id = $this->db->get_where('center_group_hierarchy',
      // array('center_group_hierarchy_name'=>$center_group_hierarchy_name))->row()->center_group_hierarchy_id;

      // $this->db->select(array('user_id','user_name'));
      // $result = $this->db->get_where('user',
      // array('fk_center_group_hierarchy_id'=>$center_group_hierarchy_id))->result_array();

      //return $result;
      return [1,'nkarisa'];
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
      $this->db->select(array('menu_derivative_controller','permission_type','permission_label_name','permission_field','permission_name'));
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

  function check_if_user_has_center_data_view_edit_permission(){
    
    $has_permission = true;
    
    if($this->action == 'view' || $this->action == 'edit'){
      $lookup_tables = $this->grants->lookup_tables($this->controller);

      if(in_array('center',$lookup_tables)){
        $center_id = $this->db->get_where($this->controller,
        array($this->grants->primary_key_field($this->controller)=>hash_id($this->id,'decode')))->row()->fk_center_id;
        
        if(!in_array($center_id,$this->get_centers_in_center_group_hierarchy($this->session->user_id))){
          $has_permission = false;
        }

      }
      
    }

    return $has_permission;
  }

  /**
   * check_role_has_permissions
   * 
   * Check if a user user has permission to access a page or 
   * any of the controlled fields in of a selected table.   
   * 
   * @param $active_controller String : Selected Table
   * @param $permission_label String : Permission label [Can be create, read, update or delete]
   * @param $permission_type int : Can with be 1 0r 2; 1 means Page Access Permission and 2 means Field Access Permission
   * 
   * @return Boolean
   */
  function check_role_has_permissions(String $active_controller,String $permission_label,int $permission_type = 1): bool {
      $permission = $this->session->role_permissions;

      $has_permission = false;

      $active_controller = ucfirst($active_controller);

      $lookup_tables = $this->grants->lookup_tables($this->controller);

      if( (array_key_exists($active_controller,$permission) && 
          array_key_exists($permission_type,$permission[$active_controller]) &&
          array_key_exists($permission_label,$permission[$active_controller][$permission_type]) 
          && count($this->get_user_context_association($this->session->user_id)) > 0 
          && $this->check_if_user_has_center_data_view_edit_permission()
          ) ||
          $this->session->system_admin
        ){
          $has_permission = true;
        } 
  
       return $has_permission; 
  }

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
  

}