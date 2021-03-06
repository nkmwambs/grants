<script>

$('.form-control').keydown(function(){
  $(this).removeAttr('style');
});

$(".save, .save_new").on('click',function(ev){

  var elem = $(this);

  //Check if all required fields are filled
  var empty_fields_count = 0;
  $('.form-control').each(function(i,el){

    if($(el).hasClass('select2') && $(el).is('select') ){
      // To be completed later. Check if select2 is empty
      if(!$(el).val() && $(el).attr('required')){
        $(el).closest('div').css('border','1px solid red');
        empty_fields_count++;
      }else{
        $(el).closest('div').removeAttr('style');
      }

    }else{
      if($(el).val() == '' && $(el).attr('required')){
        $(el).css('border','1px solid red');
        empty_fields_count++;
      }
    }
  });

  if(empty_fields_count>0){
    alert('1 or more required fields are empty');
  }else{
      pre_record_post();

      var url = "<?=base_url().$this->capped_controller;?>/<?=$this->action;?>";

      if('<?=hash_id($this->uri->segment(3,0),'decode');?>' !== 0){
        url = "<?=base_url().$this->capped_controller;?>/<?=$this->action;?>/<?=$this->uri->segment(3,0);?>";
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
            //window.history.back(1); 
             location.href = document.referrer     
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