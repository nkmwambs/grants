<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

$action_labels = $this->grants->action_labels($this->controller,hash_id($this->id,'decode'));

//print_r($this->grants->get_record_office_id('budget_item',22));

//echo hash_id($this->id,'decode');

extract($result['master']);

//$this->grants->unset_lookup_tables_ids($keys);

// Make the master detail table have columns as per the config
$columns = array_chunk($keys,$this->config->item('master_table_columns'),true);

?>