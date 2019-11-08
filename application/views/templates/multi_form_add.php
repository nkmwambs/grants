<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
  //print_r($result);
  //echo $this->grants->check_role_has_field_permission('Voucher_detail','create','voucher_detail_description');
  //print_r($this->user_model->get_user_permissions(2));
  extract($result);
  //print_r($detail_table);
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

              <?php echo form_open(base_url().$this->controller.'/'.$this->action , array('class' => 'form-horizontal form-groups-bordered', 'enctype' => 'multipart/form-data'));

                  foreach ($fields as $column => $field) {

                    if( strpos($column,'_id') == true ||
                        strpos($column,'_track_number') == true ||
                        strpos($column,'_created_date') == true ||
                        strpos($column,'_last_modified_date') == true ||
                        strpos($column,'_last_modified_by') == true ||
                        strpos($column,'_created_by') == true
                        //strpos($column,'_name') == true
                    ){
                      continue;
                    }
                ?>
                  <div class="form-group">
                    <label for="" class="control-label col-xs-3"><?=ucwords(str_replace("_"," ",$column));?></label>
                    <div class="col-xs-9">
                      <?php
                        //echo $this->grants->header_row_field($column);
                        echo $field;
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
                  <div class="col-xs-12">
                    <label class=""><?=get_phrase('attach_a_file(s)');?></label>
                    <input type="file" name="attachments" multiple />
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

  $(document).on('change','.master',function(){
    var all_false_keys = '<?=json_encode($detail_false_keys);?>';
    var elem = $(this);
    var obj = JSON.parse(all_false_keys);

    $.each(obj,function(i,el){

        if(elem.hasClass(i)){
          var representing_key = el.representing_key;
          var lookup_keys = el.lookup_keys;
          //alert(representing_key);
          $(".th_data").each(function(thi,th){

            if($(th).attr('id') == 'th_voucher_'+representing_key){
              //$(th).prop('id','th_expense_account_name');
              $.each(lookup_keys,function(lki,lkel){

                if($.inArray(parseInt(elem.val()),lkel) > -1){
                  //alert('hello');
                  $(th).prop('id','th_'+lki);
                }

              });
            }

          });

        }else{
          //alert('Not a false key trigger '+ i +' = '+elem.attr('id'));
        }
    });

  });

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
