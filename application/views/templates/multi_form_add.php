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

                 <div class="form-group">
                   <div class="col-xs-12" style="text-align:center;">
                       <div class="btn btn-default insert_row"><?=get_phrase('insert_'.$this->controller.'_detail_row');?></div>
                       <div class="btn btn-default"><?=get_phrase('reset');?></div>
                       <button class="btn btn-default save"><?=get_phrase('save');?></button>
                       <button class="btn btn-default save_new"><?=get_phrase('save_and_new');?></button>
                   </div>
                 </div>

                <div class="form-group">
                  <div class="col-xs-12">
                    <table class="table table-bordered detail">
                      <thead>
                        <tr>
                          <th><?=get_phrase('action');?></th>
                        <?php

                          foreach ($detail_table as $detail_table_key) {
                        ?>
                            <th class="th_data" id="<?="th_".$detail_table_key;?>"><?=ucwords(str_replace("_"," ",$detail_table_key));?></th>
                        <?php
                          }
                         ?>
                       </tr>
                      </thead>

                      <tbody></tbody>
                      <tfoot>
                          <tr>
                            <td colspan="<?=count($detail_table);?>"><?=get_phrase('grand_total')?></td>
                            <td><input type="number" readonly="readonly" class="form-control" id="grand_total" value="0" /></td>
                          </tr>
                      </tfoot>
                    </table>
                  </div>
                </div>

                <div class="form-group">
                  <div class="col-xs-12"  style="text-align:center;">
                    <div class="btn btn-default insert_row"><?=get_phrase('insert_'.$this->controller.'_detail_row');?></div>
                    <div class="btn btn-default"><?=get_phrase('reset');?></div>
                    <button class="btn btn-default save"><?=get_phrase('save');?></button>
                    <button class="btn btn-default save_new"><?=get_phrase('save_and_new');?></button>
                  </div>
                </div>

              </form>
        </div>
      </div>
    </div>
  </div>

  <script type="text/javascript">

    $('.insert_row').click(function(ev){

      pre_row_insert();


      var fields = [];

      $(".th_data").each(function(i,el){
        fields[i] = $(this).attr('id').replace('th_','');
      });

      var url = "<?=base_url();?><?=$this->controller;?>/detail_row";
      var data = {fields};

      $.ajax({
        url:url,
        data:data,
        type:"POST",
        beforeSend:function(){

        },
        success:function(response){
            //alert(response);
            var obj = JSON.parse(response);

            var detail_row = "<tr><td><div class='btn btn-danger' onclick='delete_row(this);'><?=get_phrase('delete');?></div></td>";

            $.each(obj,function(i,el){
                detail_row += "<td class='td_"+i+"'>"+el+"</td>";
            });

              detail_row += "</tr>";
           $('.detail tbody').append(detail_row);
           on_row_insert();
        },
        error:function(){

        }
      });

      post_row_insert();

    });

  function delete_row(el){
    pre_row_delete();
    var cnfm = confirm('<?=get_phrase("are_you_sure_you_want_to_delete_this_row?");?>');

    if(!cnfm){
      alert('<?=get_phrase("proccess_aborted!");?>');
    }else{
      $(el).closest('tr').remove();
      on_row_delete();
    }

    post_row_delete();

  }

  $(".save, .save_new").on('click',function(ev){
    pre_record_post();

    var url = "<?=base_url().$this->controller;?>/<?=$this->action;?>";
    var data = $(this).closest('form').serializeArray();

    $.ajax({
      url:url,
      data:data,
      type:"POST",
      beforeSend:function(){

      },
      success:function(response){
        alert(response);
        window.location.reload();
        on_record_post();
      },
      error:function(){

      }
    });

    post_record_post();
    ev.preventDefault();
  });

  </script>
