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