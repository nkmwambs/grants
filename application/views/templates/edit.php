<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
//echo hash_id($this->id,'decode');
// print_r($result);

extract($result);

?>

<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default" data-collapsed="0">
        	<div class="panel-heading">
            	<div class="panel-title" >
            		<i class="entypo-plus-circled"></i>
					<?php echo get_phrase('edit_'.$this->controller);?>
            	</div>
            </div>
			
            <div class="panel-body">

              <?php echo form_open(base_url().$this->controller.'/edit/'.$this->uri->segment(3,0) , array('class' => 'form-horizontal form-groups-bordered', 'enctype' => 'multipart/form-data'));

                  //foreach ($keys as $column => $value) {
                  foreach ($fields as $column => $field) {

                    if( strpos($column,'_id') == true ||
                        strpos($column,'_track_number') == true ||
                        strpos($column,'_created_date') == true ||
                        strpos($column,'_last_modified_date') == true ||
                        strpos($column,'_created_by') == true ||
                        strpos($column,'_last_modified_by') == true
                    ){
                      continue;
                    }
                ?>
                  <div class="form-group">
                    <label for="" class="control-label col-xs-3"><?=ucwords(str_replace("_"," ",$column));?></label>
                    <div class="col-xs-9">
                      <?php
                        //echo $this->grants->header_row_field($column, $value);
                        //echo $value;
                        echo $field;
                      ?>
                    </div>
                  </div>
                <?php
                  }
                 ?>

                 <div class="form-group">
                   <div class="col-xs-12">
                     <label class=""><?=get_phrase('attach_a_file(s)');?></label>
                     <input type="file" name="attachments" multiple />
                   </div>
                </div>


                 <div class="form-group">
                   <div class="col-xs-12" style="text-align:center;">
                     <button class="btn btn-default edit"><?=get_phrase('edit');?></button>
                     <button class="btn btn-default edit_continue back"><?=get_phrase('edit_and_continue');?></button>
                   </div>
                 </div>
               </form>  
          </div>
      </div>
    </div>
</div>

<script>
$(".edit, .edit_continue").on('click',function(ev){
  pre_record_post();

  var url = "<?=base_url().$this->controller;?>/<?=$this->action;?>/<?=$this->uri->segment(3,0);?>";

  var data = $(this).closest('form').serializeArray();

  $.ajax({
    url:url,
    data:data,
    type:"POST",
    beforeSend:function(){

    },
    success:function(response){
      alert(response);

      // if($(this).hasClass('back')){
			//   window.history.back(1);        
      // } else {
      //   window.location.reload();
      // }
      on_record_post();
    },
    error:function(){

    }
  });

  post_record_post();
  ev.preventDefault();
});

</script>