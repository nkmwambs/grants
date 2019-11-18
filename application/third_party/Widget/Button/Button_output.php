<?php

class Button_output{
    
    function __construct(){

    }

    function index(){

    }

    function output(...$args){
        $label = $args[0];
        $action = $args[1];
        return '
            <div class="btn btn-default" id="btn" onclick="btn_action(this);">'
            .ucfirst($label).
            '</div>

            <script>
                function btn_action(elem){
                    var url = "'.base_url().$action.'";

                    $.ajax({
                        url:url,
                        beforeSend:function(){
                            
                        },
                        success:function(response){
                            alert(response);
                        },
                        error:function(err){
                            alert(err);
                        }
                    });
                }
            </script>
        ';
    }
}
