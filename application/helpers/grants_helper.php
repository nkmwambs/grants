<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * This is the main helper file
 */

require_once(FCPATH.'/vendor/autoload.php');

if ( ! function_exists('fk_to_name_field'))
{
	function fk_to_name_field($fk_field = '') {
		$xlpd = explode('_',substr($fk_field,0,-3));
    unset($xlpd[0]);
    return implode("_",$xlpd)."_name";
	}
}

if ( ! function_exists('elevate_array_element_to_key'))
{
	function elevate_array_element_to_key($unevelavated_array, $element_to_elevate) {
		$elevated_array = array();
	  foreach ($unevelavated_array as $item) {

			//Cast $item to array if object
			$item = is_object($item)?(array)$item:$item;

			$elevated_array[$item[$element_to_elevate]] =  $item;

			unset($elevated_array[$item[$element_to_elevate]][$element_to_elevate]);

		}

		return $elevated_array;
	}
}

if ( ! function_exists('elevate_assoc_array_element_to_key'))
{
	function elevate_assoc_array_element_to_key($unevelavated_array, $element_to_elevate) {
		$elevated_array = array();
		$cnt = 0;
	  foreach ($unevelavated_array as $item) {

			//Cast $item to array if object
			$item = is_object($item)?(array)$item:$item;

			$elevated_array[$item[$element_to_elevate]][$cnt] =  $item;

			unset($elevated_array[$item[$element_to_elevate]][$cnt][$element_to_elevate]);
			$cnt++;
		}

		return $elevated_array;
	}
}

if ( ! function_exists('hash_id'))
{
	function hash_id($id,$action = 'encode') {
		$hashids = new Hashids\Hashids('#Compassion321',10);

		if($action == 'encode'){
			return $hashids->encode($id);
		}elseif(isset($hashids->decode($id)[0])){
			//print_r($hashids->decode($id));exit();
			return $hashids->decode($id)[0];
		}else{
			return null;
		}

	}
}

//Camel cases header elements of list table

if( ! function_exists('camel_case_header_element')){
	function camel_case_header_element($header_element){
	     return  get_phrase($header_element);//ucwords(str_replace('_',' ',$header_element));
	}
}

//Create the th elements of a list table with camel cased headers from keys elements of grants library list result return
// It escapes putting a field with Key and id in its string

if( ! function_exists('render_list_table_header') ){
	function render_list_table_header($table_name,$header_array){
		$string = '<tr><th nowrap="nowrap">'.get_phrase("action").'</th>';

		foreach ($header_array as $th_value) {
			if(strpos($th_value,'key') == true || strpos($th_value,'_id') ==true  ) {
				continue;
			}

			$string .= '<th nowrap="nowrap">'.camel_case_header_element($th_value).'</th>';
		}
		$string .='</tr>';

		return $string;
	}
}

if( ! function_exists('list_table_edit_action')){
	function list_table_edit_action($table_controller,$primary_key){

		$string = '<a class="list_edit_link" href="'.base_url().ucfirst($table_controller).'/edit/'.hash_id($primary_key,'encode').'">'.get_phrase("edit").'</a>';

		return $string;
	}
}

if( ! function_exists('list_table_delete_action')){
	function list_table_delete_action($table_controller,$primary_key){

		$string = '<a class="list_delete_link" href="'.base_url().ucfirst($table_controller).'/delete/'.hash_id($primary_key).'">'.get_phrase("delete").'</a>';

		return $string;
	}
}

if( ! function_exists('list_table_approval_action')){
	function list_table_approval_action($table_controller,$primary_key){

		$string = '<a class="list_approval_link" href="'.base_url().ucfirst($table_controller).'/approve/'.hash_id($primary_key).'">'.get_phrase("approve").'</a>';

		return $string;
	}
}

if( ! function_exists('list_table_decline_action')){
	function list_table_decline_action($table_controller,$primary_key){

		$string = '<a class="list_decline_link" href="'.base_url().ucfirst($table_controller).'/decline/'.hash_id($primary_key).'">'.get_phrase("decline").'</a>';

		return $string;
	}
}

if( ! function_exists('add_record_button') ){
	function add_record_button($table_controller,$has_details,$id = null ,$has_listing = false){
		$add_view = $has_listing?"multi_form_add":"single_form_add";
		$link = "";
		$CI =& get_instance();

		if($id !== null){
			$link =  '<a href="'.base_url().ucfirst($table_controller).'/'.$add_view.'/'.$id.'/'.$CI->controller.'" class="btn btn-default">'.get_phrase('add_'.$table_controller).'</a>';
		}else{
			$link =  '<a style="margin-bottom:-70px;z-index:100;position:relative;" href="'.base_url().$table_controller.'/'.$add_view.'" class="btn btn-default">'.get_phrase('add_'.$table_controller).'</a>';
		}

		return $link;
	}
}

if( ! function_exists('create_breadcrumb') ){
	function create_breadcrumb(){

		$CI =& get_instance();

		$CI->menu_library->create_breadcrumb();

		$breadcrumb_list = $CI->session->breadcrumb_list;

		$string = '<nav aria-label="breadcrumb"><ol class="breadcrumb">';

		foreach ($breadcrumb_list as $menuItem) {
			if($CI->read_db->get_where('menu',
			array('menu_name'=>$menuItem,'menu_is_active'=>0))->num_rows() > 0) continue;
			
			$string .= '<li class="breadcrumb-item"><a href="'.base_url().$menuItem.'/list">'.get_phrase($menuItem).'</a></li>';
		}

		$string .= '</ol></nav>';
		
		return $string;
	}
}


if(! function_exists('record_prefix')){
	function record_prefix($string){
		$lead_string = substr($string,0,2);
		$trail_string = substr($string,-2,2);
		
		return strtoupper($lead_string.$trail_string);
	}
}

if(!function_exists('condition_operators')){
	function condition_operators(){
		$operators = [
			'equal'=> get_phrase('equal'),
			'great_than'=> get_phrase('great_than'),
			'less_than'=> get_phrase('less_than'),
			'less_or_equal'=> get_phrase('less_or_equal'),
			'great_or_equal'=> get_phrase('great_or_equal'),
			'between'=> get_phrase('between'),
			'contains'=> get_phrase('contains'),
		];

		return $operators;
	}
}

if ( ! function_exists('model_exists')){
    function model_exists($name){
        $CI = &get_instance();
		foreach($CI->config->_config_paths as $config_path){
			if(file_exists(FCPATH . $config_path . 'models/' . $name . '.php')){
				return true;
			}else{
				return false;
			}
		}
        
    }
}

if ( ! function_exists('combine_name_with_ids')){
    function combine_name_with_ids($array,$id_field_name,$name_field_name){
		
		$names = array_column($array,$name_field_name);
		$ids = array_column($array,$id_field_name);
		
		return array_combine($ids,$names);
    }
}

if ( ! function_exists('cap_url_controller')){
    function cap_url_controller($url){
		$url_segments = parse_url($url);

		$path_array = explode("/",ltrim($url_segments['path'],'/'));

		array_shift($path_array);

		$arguments_array = array_map(function($segment,$index){

		if($index == 0){
			return ucfirst($segment);
		}else{
			return $segment;
		}

		},$path_array,array_keys($path_array));

		echo base_url().implode("/",$arguments_array);
    }
}

if ( ! function_exists('approval_action_buttons')){
    function approval_action_buttons($logged_role_id,$table,$primary_key){
		?>
			<style>
				.btn{
					margin:5px;
				}
			</style>
		<?php
		
		$CI =& get_instance();

		$approver_status = $CI->general_model->display_approver_status_action($logged_role_id,$table,$primary_key);
		$current_user_role = $CI->session->role_id;
		$buttons = "";
		
		if(	
			$current_user_role == $approver_status['current_actor_role_id'] &&
			$approver_status['show_label_as_button'] == true
		){
			$buttons = "<a title='".$approver_status['status_name']."' href='".base_url().$CI->controller."/approve/".$CI->id."' class='btn btn-default'>".$approver_status['button_label']."</a>";

			if($approver_status['show_decline_button'] == true){
				$buttons .= "<a href='".base_url().$CI->controller."/decline/".$CI->id."' class='btn btn-default'>Decline</a>";
			}
			
		}
		
		return $buttons;
    }
}

if(! function_exists('directory_iterator')){
	function directory_iterator($path){

		$array = array();

		if(file_exists($path)){
			foreach ($iterator = new RecursiveIteratorIterator(
				new RecursiveDirectoryIterator($path, 
					RecursiveDirectoryIterator::SKIP_DOTS),
				RecursiveIteratorIterator::SELF_FIRST) as $item) {
				// Note SELF_FIRST, so array keys are in place before values are pushed.

					$subPath = $iterator->getSubPathName();
						if($item->isDir()) {
							// Create a new array key of the current directory name.
							$array[$subPath] = array();
						}
						else {
							// Add a new element to the array of the current file name.
							$array[$subPath]['file_name'] = $subPath;
							$array[$subPath]['file_size'] = human_filesize(filesize($path.DIRECTORY_SEPARATOR.$subPath));
							$array[$subPath]['last_modified_date'] = date('Y-m-d',filemtime($path.DIRECTORY_SEPARATOR.$subPath));
							$array[$subPath]['url'] = $path.DIRECTORY_SEPARATOR.$subPath;
						}
				}
			}
		return $array;	
	}
}


if(!function_exists('human_filesize')){
	function human_filesize($bytes, $decimals = 2) {
		$sz = 'BKMGTP';
		$factor = floor((strlen($bytes) - 1) / 3);
		return sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)) . @$sz[$factor];
	  }
}


if(!function_exists('upload_url')){
	function upload_url($controller,$record_id,$extra_keys = []) {
		return "uploads".DS."attachments".DS.$controller.DS.$record_id.DS.implode(DS,$extra_keys);
	  }
}

if(!function_exists('currency_conversion')){
	function currency_conversion($office_id) {
		
		$CI =& get_instance();
		
		$office_currency_id = $CI->db->get_where('office',
			array('office_id'=>$office_id))->row()->fk_country_currency_id;

		$user_currency_id = $CI->session->user_currency_id;

		$base_currency_id = $CI->session->base_currency_id;

		$conversion_month = "2020-05-01";// To be computed
		
		$CI->db->join('currency_conversion','currency_conversion.currency_conversion_id=currency_conversion_detail.fk_currency_conversion_id');
		$office_rate_obj = $CI->db->get_where('currency_conversion_detail',
		array('fk_country_currency_id'=>$office_currency_id));
		
		$office_rate = 1;
		
		if($office_rate_obj->num_rows() > 0){
			$office_rate = $office_rate_obj->row()->currency_conversion_detail_rate;
		}


		$CI->db->join('currency_conversion','currency_conversion.currency_conversion_id=currency_conversion_detail.fk_currency_conversion_id');
		$user_rate_obj = $CI->db->get_where('currency_conversion_detail',
		array('fk_country_currency_id'=>$user_currency_id));

		$user_rate = 1;

		if($user_rate_obj->num_rows() > 0){
			$user_rate = $user_rate_obj->row()->currency_conversion_detail_rate;
		}

		$computed_rate = 1;

		if($user_currency_id !== $base_currency_id){
			//if($user_rate > $office_rate){
				$computed_rate = $user_rate/$office_rate;				
			//}else{
			//	$computed_rate = $office_rate/$user_rate;
			//}
		}else{
			$computed_rate = 1/$office_rate;
		}
		
		return $computed_rate;// .' - '. $user_rate . ' - '.$office_rate;
	}
}


if(!function_exists('show_logo')){
	function show_logo($office_id) {
		$logo = "";
		$CI =& get_instance();

		if(!$CI->config->item('use_default_logo') && file_exists(APPPATH."../uploads/office_logos/".$office_id.".png")){
			$logo ='<img src="'.base_url().'uploads/office_logos/'.$office_id.'.png"  style="max-height:150px;" alt="Logo"/>';
		}else{
			$logo = '<img src="'.base_url().'uploads/logo.png"  style="max-height:150px;" alt="Logo"/>';
		}

		return $logo;
	}
}

// Some how not working
if(!function_exists('is_valid_array_from_contract_method')){
	function is_valid_array_from_contract_method($method_class_name,$contract_method,$check_if_result_is_array_not_empty = false){
		$CI =& get_instance();
		$is_valid = false;
		
		if($check_if_result_is_array_not_empty){
			if(
				method_exists($CI->{$method_class_name},$contract_method) &&
				is_array($CI->{$method_class_name}->{$contract_method}()) &&
				count($CI->{$method_class_name}->{$contract_method}()) > 0
			){
				$is_valid = true;
			}
		}else{
			if(method_exists($method_class_name,$contract_method)){
				$is_valid = true;
			}
		}
		
		return $is_valid;
	}
}


if(!function_exists('check_and_load_account_system_model_exists')){
	function check_and_load_account_system_model_exists($model_name,$package_name = 'Grants',$class_type = 'model'){
		$CI =& get_instance();
		$user_account_system = $CI->session->user_account_system;
		$is_existing = false; 
		$class_type_dir = $class_type == 'model' ? 'models' : 'libraries';
		$path = APPPATH.'third_party'.DS.'Packages'.DS.$package_name.DS.$class_type_dir.DS.'as_'.$class_type_dir.DS.$user_account_system.DS.$model_name.'.php';

		if(file_exists($path) && !$CI->load->is_loaded($model_name)){
			$CI->load->{$class_type}('as_'.$class_type_dir.'/'.$user_account_system.'/'.$model_name);
			$is_existing = true; 
		}

		return $is_existing;
	}
}

if(!function_exists('sanitize_characters')){

	function sanitize_characters($string) {
		$string = str_replace(' ', '', $string); // Replaces all spaces with hyphens.
		return strtolower(preg_replace('/[^A-Za-z0-9]/', '', $string)); // Removes special chars.
		
	 }

}


if(!function_exists('list_detail_tables')){
	function list_detail_tables($master_table = ''){

		$CI =& get_instance();
		
		if($master_table == ''){
			$master_table = strtolower($CI->controller);
		}
		
		$tables = $CI->read_db->list_tables();

        foreach($tables as $row_id => $table){
            if(!in_array('fk_'.$master_table.'_id',$CI->read_db->list_fields($table))){
                unset($tables[$row_id]);
            }
        }

        return $tables;
	}
}

if(!function_exists('tables_with_account_system_relationship')){
	function tables_with_account_system_relationship(){
		
		$CI =& get_instance();

		$tables = $CI->read_db->list_tables();
		
		$tables_with_account_system_relationship = [];

		foreach($tables as $table){
			$table_fields = $CI->read_db->list_fields($table);

			foreach($table_fields as $table_field){
				if($table_field == 'fk_account_system_id'){
					$tables_with_account_system_relationship[] = $table;
				}
			}
		}

		return $tables_with_account_system_relationship;
	}
}	

if(!function_exists('list_lookup_tables')){
	function list_lookup_tables($table_name = ''){
		
		$CI =& get_instance();

		$table_name = $table_name == '' ? $CI->controller : $table_name;

		$table_fields = $CI->read_db->list_fields($table_name);

		$list_lookup_tables = [];

		foreach($table_fields as $table_field){
			if(substr($table_field,0,3) =='fk_'){
				$list_lookup_tables[] = substr($table_field,3,-3);
			}
		}

		return $list_lookup_tables;
	}
}

if(!function_exists('financial_year_quarter_months')){
	function financial_year_quarter_months($month_number){
		
		$CI =& get_instance();

		$CI->read_db->select(array('month_number'));
      	$CI->read_db->order_by('month_order ASC');
      	$months = $CI->read_db->get('month')->result_array();

      	$month_mumbers = array_column($months,'month_number');

		$count_of_reviews_in_year = $CI->read_db->get_where('budget_review_count',array('fk_account_system_id'=>$CI->session->user_account_system_id))->row()->budget_review_count_number;
		$count_of_months_in_period = count($month_mumbers)/$count_of_reviews_in_year;
		/**
		 * 1 - 12 
		 * 2 - 6  
		 * 3 - 4
		 * 4 - 3
		 */
		$range_of_reviews = range(1,$count_of_reviews_in_year);// [1,2,3,4] - Assume the $count_of_reviews_in_year = 4
		$month_arrays_in_period = array_chunk($month_mumbers,$count_of_months_in_period);//[[7,8,9],[10,11,12],[1,2,3],[4,5,6]]

      	$months_in_quarters = array_combine($range_of_reviews,$month_arrays_in_period);

      	$current_quarter_months = [];

      	foreach($months_in_quarters as $quarter_number => $months_in_quarter){
        	if(in_array($month_number,$months_in_quarter)){
          	$current_quarter_months['quarter_number'] = $quarter_number;
          	$current_quarter_months['months_in_quarter'] = $months_in_quarter;
        	}
		  }
		  
		return $current_quarter_months;
	}
}

if(!function_exists('budget_review_buffer_month')){
	function budget_review_buffer_month($current_month){

		$CI =& get_instance();

		$current_month_with_buffer = $current_month + $CI->config->item('budget_review_buffer_months');

		if($current_month_with_buffer > 12){

			if($current_month_with_buffer > 24){
				$current_month_with_buffer = $current_month_with_buffer % 12;
			}else{
				$current_month_with_buffer = $current_month_with_buffer - 12;
			}

		}

		return $current_month_with_buffer;
	}
}


if(!function_exists('addOrdinalNumberSuffix')){
	function addOrdinalNumberSuffix($num) {
		if (!in_array(($num % 100),array(11,12,13))){
		  switch ($num % 10) {
			// Handle 1st, 2nd, 3rd
			case 1:  return $num.'st';
			case 2:  return $num.'nd';
			case 3:  return $num.'rd';
		  }
		}
		return $num.'th';
	  }
}

if(!function_exists('get_fy')){
	function get_fy($date_string,$override_fy_year_digits_config = false){
		
		$CI =& get_instance();
		
		$start_of_fy_month = $CI->read_db->get_where('month',array('month_order'=>1))->row()->month_number;//$CI->config->item('start_of_fy_month'); 
		$fy_year_reference = $CI->config->item('fy_year_reference');
		$fy_year_digits = $CI->config->item('fy_year_digits');

		$fy_format = ($fy_year_digits == 2 && !$override_fy_year_digits_config)?'y':'Y';

		$date_year = date($fy_format,strtotime($date_string));

		$month_count_from_date_string_to_end_of_year = $start_of_fy_month + 11;

		$list_of_months = range($start_of_fy_month,$month_count_from_date_string_to_end_of_year);

		$list_of_months_with_year = [];

		foreach($list_of_months as $month){
			$_date_year = $date_year;

			if($month > 12){
				$_month = $month - 12;
				$_date_year++;
				$list_of_months_with_year[] = $_month.'-'.$_date_year;
			}else{
				$list_of_months_with_year[] = $month.'-'.$_date_year;
			}
			
		}

		$check_if_month_in_list_of_months = in_array(date('n-'.$fy_format,strtotime($date_string)),$list_of_months_with_year);

		$fy_year = $date_year;

		if($check_if_month_in_list_of_months && ($fy_year_reference == 'next' && !$override_fy_year_digits_config)){
			$fy_year++;
		}
		
		return $fy_year;
	}
}

if(!function_exists('fy_start_date')){
	function fy_start_date($date_string){
		$CI =& get_instance();

		$fy = get_fy($date_string,true);
		$start_of_fy_month = $CI->read_db->get_where('month',array('month_order'=>1))->row()->month_number;//$CI->config->item('start_of_fy_month'); 

		$formatted_month = strlen($start_of_fy_month) == 1?'0'.$start_of_fy_month:$start_of_fy_month;

		return $fy.'-'.$formatted_month.'-01';

	}
}

if(!function_exists('formatBytes')){
	function formatBytes($bytes, $precision = 2) { 
		$units = array('B', 'KB', 'MB', 'GB', 'TB'); 
	
		$bytes = max($bytes, 0); 
		$pow = floor(($bytes ? log($bytes) : 0) / log(1024)); 
		$pow = min($pow, count($units) - 1); 
	
		// Uncomment one of the following alternatives
		$bytes /= pow(1024, $pow);
		// $bytes /= (1 << (10 * $pow)); 
	
		return round($bytes, $precision) . ' ' . $units[$pow]; 
	} 
}