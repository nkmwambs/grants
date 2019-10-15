<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
  //print_r($result);
  //print_r($this->db->field_data($this->controller));
  extract($result);
?>

<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default" data-collapsed="0">
        	<div class="panel-heading">
            	<div class="panel-title" >
            		<i class="entypo-plus-circled"></i>
					<?php echo get_phrase('add_'.$this->controller);?>
            	</div>
            </div>
			         <div class="panel-body">

              <?php echo form_open(base_url().$this->controller.'/add' , array('class' => 'form-horizontal form-groups-bordered', 'enctype' => 'multipart/form-data'));

                  foreach ($keys as $column) {

                    if( strpos($column,'_id') == true ||
                        strpos($column,'_track_number') == true ||
                        strpos($column,'_created_date') == true ||
                        strpos($column,'_last_modified_date') == true
                        //strpos($column,'_name') == true
                    ){
                      continue;
                    }
                ?>
                  <div class="form-group">
                    <label for="" class="control-label col-xs-3"><?=ucwords(str_replace("_"," ",$column));?></label>
                    <div class="col-xs-9">
                      <?php
                        echo $this->grants->header_row_field($column);
                      ?>

                    </div>
                  </div>
                <?php
                  }
                 ?>
          </div>
      </div>
    </div>
</div>
