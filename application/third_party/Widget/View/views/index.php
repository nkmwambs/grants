<form>
    <label for="" class="label-control col-xs-3" style="text-align:right;font-weight:bold;">
    <?=get_phrase('views');?></label>
    <div class="col-xs-6">
        <select class="form-control">
            <option><?=get_phrase('select_view');?></option>
        </select>
    </div>
    <div class="col-xs-3"> 
        <a href="#"><?=get_phrase('create_view');?></a>  &nbsp; 
        <a href="#"><?=get_phrase('edit_view');?></a> &nbsp; 
        <a href="#"><?=get_phrase('clone_view');?></a></div>
</form>