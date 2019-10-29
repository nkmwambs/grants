<?php

//require_once(FCPATH.'vendor/autoload.php');

class Rbac_base{

    private $CI = null;
    private $Permissions;
    private $Roles;
    private $Users;
    private $Rbac;

    function __construct($unit_test = ''){

      // Create an object of Rbac class
      $this->Rbac = new \PhpRbac\Rbac();

      //Load CI Singleton Instance
      $this->CI =& get_instance();

      //Load rba config
      $this->CI->load->config('rbac');
    }

    /**
    * add_permissions
    * This method checks if a permission does not exists and adds it if it does not
    *
    * @return void
    */

    function add_permissions(){
      // Only add permissions if not existing in the permissions table
      $permissions = $this->CI->config->item('permissions');

      $list_all_permissions = array_column($this->CI->db->get('phprbac_permissions')->result_array(),'Title');

      foreach ($permissions as $permission => $permission_description) {
        if(!in_array($permission,$list_all_permissions)){
            $this->Rbac->Permissions->add($permission, $permission_description);
        }
      }

    }

    /**
    * add_roles
    * This method checks if a role does not exists and adds it if it does not
    *
    * @return void
    */

    function add_roles(){
      // Only add roles if not existing in the roles table
      $roles = $this->CI->config->item('roles');

      $list_all_roles = array_column($this->CI->db->get('phprbac_roles')->result_array(),'Title');

      foreach ($roles as $role => $role_description) {
        if(!in_array($role,$list_all_roles)){
          $this->Rbac->Roles->add($role, $role_description);
        }

      }

    }


}
