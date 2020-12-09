<script>
// $(document).ready(function(){

//     var url = "<?=base_url();?>Status/get_status_roles";
//     $.get(url,function(response){
//         console.log(response);
//         var role_obj = JSON.parse(response);
//         var options = "<option value=''><?=get_phrase('select_a_role');?></option>";

//         for(i=0;i<role_obj.length;i++){
//             options += "<option value='"+role_obj[i].role_id+"'>"+role_obj[i].role_name+"</option>";
//         };

//         $('form .form-group').last().prev().after('<div class="form-group"><label class="col-xs-3 control-label">Status Role</label><div class="col-xs-9"><select class="form-control" name="extra["status_role"]["fk_role_id"]">'+options+'</select></div></div>')
//     });

// });
</script>