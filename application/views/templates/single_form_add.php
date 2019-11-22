<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

  //echo $this->id;

  extract($result);
  //echo isset($this->session->master_table)?$this->session->master_table:"Not set";
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

              <?php echo form_open(base_url().$this->controller.'/add' , array('id'=>'edit_form','class' => 'form-horizontal form-groups-bordered', 'enctype' => 'multipart/form-data'));

                  foreach ($fields as $column => $field) {

                    if( strpos($column,'_id') == true ||
                        strpos($column,'_track_number') == true ||
                        strpos($column,'_created_date') == true ||
                        strpos($column,'_last_modified_date') == true ||
                        strpos($column,'_created_by') == true ||
                        strpos($column,'_last_modified_by') == true ||
                        $column == 'approval_name' ||
                        $column == 'status_name' 
                    ){
                      continue;
                    }
                ?>
                  <div class="form-group">
                    <label for="" class="control-label col-xs-3"><?=ucwords(str_replace("_"," ",$column));?></label>
                    <div class="col-xs-9">
                      <?php
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
                     <div class="btn btn-default"><?=get_phrase('reset');?></div>
                     <button class="btn btn-default save back"><?=get_phrase('save');?></button>
                     <button class="btn btn-default save_new"><?=get_phrase('save_and_new');?></button>
                   </div>
                 </div>
               <form>  
          </div>
      </div>
    </div>
</div>

<script>

$('.form-control').keydown(function(){
  $(this).removeAttr('style');
});

$(".save, .save_new").on('click',function(ev){
  
  var elem = $(this);

  //Check if all required fields are filled
  var empty_fields_count = 0;
  $('.form-control').each(function(i,el){
    if($(el).val() == ''){
      $(el).css('border','1px solid red');
      empty_fields_count++;
    }
  });

  if(empty_fields_count>0){
    alert('1 or more required fields are empty');
  }else{
      pre_record_post();

      var url = "<?=base_url().$this->controller;?>/<?=$this->action;?>";

      if('<?=$this->uri->segment(3,0);?>' !== 0){
        url = "<?=base_url().$this->controller;?>/<?=$this->action;?>/<?=$this->uri->segment(3,0);?>";
      }

      var data = $(this).closest('form').serializeArray();

      $.ajax({
        url:url,
        data:data,
        type:"POST",
        beforeSend:function(){

        },
        success:function(response){
          alert(response);
          //window.location.reload();
          on_record_post();

          //If Save , use the browser history and go back
          if(elem.hasClass('back')){
            window.history.back(1);        
          } else{
            document.getElementById('edit_form').reset();
          }

        },
        error:function(){

        }
      });

      post_record_post();
  }
  ev.preventDefault();
});

</script>
