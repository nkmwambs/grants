<?php 

class Comment_output{

    /**
     * @var Object $CI - A property that hold CodeIgniter Singleton class instance
     */
    protected $CI = null;

    /**
     * @var String $controller - Hold the active/ selected table/controller name
     */
    protected $controller;

    /**
     * @var String $current_model - holds the active model name
     */
    protected $current_model;

    /**
     * @var Object $access - hold the access_base object
     */
    protected $access = null;

    function __construct(){

        // Class property initialization
        $this->CI =& get_instance();
        $this->access = new Access_base();
        $this->controller = $this->CI->controller;
        $this->current_model = $this->CI->current_model;
    }

    static function index(){

    }

    function output(...$args){
        //return $this->CI->load->view('templates/widgets/comment',true);
        return '
        <section class="profile-feed">
                        
                <form class="profile-post-form" method="post">
                    
                    <textarea class="form-control autogrow" placeholder="What\'s on your mind?"></textarea>
                    
                    <div class="form-options">
                        
                        <div class="post-type">
                        
                            <a href="#" class="tooltip-primary" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Upload a Picture">
                                <i class="entypo-camera"></i>
                            </a>
                        
                            <a href="#" class="tooltip-primary" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Attach a file">
                                <i class="entypo-attach"></i>
                            </a>
                            
                            <a href="#" class="tooltip-primary" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Show comments">
                                <i class="fa fa-bars"></i>
                            </a>
                            
                            <button type="button" class="btn btn-primary pull-right">POST</button>
                        </div>
                        
                        
                    </div>
                </form>
                
            </section>
            
        <style>
        .profile-feed{
        margin-bottom:45px;
        }

        .post-type{
        margin-top:10px;
        }
        </style>      
        ';
    }

}
