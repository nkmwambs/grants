<div class="row" style="margin-top:45px;">
    <div class="col-xs-4">
        <div class="pull-right">Search Phrase</div>
    </div>
    <div class="col-xs-4">
        <input type="text" id="search" class="form-control" />
    </div>
</div>

<div class="row" style="margin-top:45px;">
    <div class="col-xs-12">
        <?php

        ob_start();
        include APPPATH."language/en.php";
        ob_get_contents();
        ob_end_clean();

        $chunks = array_chunk($lang,4,true);
        //print_r($columns);
      ?>
        <form id="form">
            <table id="phrase_table" class="table">
                <thead>
                    <tr>
                        <th colspan="4">Transalate Phrases</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                            //$max_rows = 0;
                            foreach($chunks as $row){
                                //if($max_rows == 3) break;
                        ?>
                    <tr>
                        <?php        
                                foreach($row as $lang_key => $phrase){
                        ?>
                        <td><input type="text" class="form-control lang" name="<?=$lang_key;?>" id="<?=$lang_key;?>"
                                value="<?=$phrase;?>" /></td>
                        <?php 
                                }
                        ?>
                    </tr>
                    <?php
                             //$max_rows++;        
                            }
                        ?>
                </tbody>
            </table>

        </form>
    </div>
</div>



<script>
$("#search").keyup(function() {
    var value = this.value.toLowerCase().trim();
    
    $("table tr").each(function(index) {
        if (!index) return;
        $(this).find("td").each(function() {
            var id = $(this).find('input').val().toLowerCase().trim();

            if (id.indexOf(value) != -1) {
                $(this).find('input').css('border', '3px solid orange');
            } else {
                $(this).find('input').removeAttr('style');
            }

            var not_found = (id.indexOf(value) == -1);
            $(this).closest('tr').toggle(!not_found);
            return not_found;
        });
    });
});

$(".lang").change(function() {
    var url = "<?=base_url().$this->controller;?>/translator";
    //var data = $("#form").serializeArray();
    var data = {
        'key': $(this).attr('name'),
        'phrase': $(this).val()
    };

    $.ajax({
        url: url,
        type: "POST",
        data: data,
        beforeSend: function() {

        },
        success: function(resp) {
            //alert(resp);
        },
        error: function() {

        }
    });
});
</script>