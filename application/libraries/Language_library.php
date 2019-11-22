<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
 *	@author 	: Nicodemus Karisa
 *	@date		: 27th September, 2018
 *	Finance management system for NGOs
 *	https://techsysnow.com
 *	NKarisa@ke.ci.org
 */

class Language_library extends Grants
{

  private $CI;
  private $language = 'en';
  private $default_language_path = APPPATH.'language'.DIRECTORY_SEPARATOR;
  //private $context = 'system';
  private $lang_strings = [];

  function __construct(){
    parent::__construct();
    $this->CI =& get_instance();
  }

  function index(){

  }
  
  function set_language($locale){
    $this->language = $locale;
    return $this;
  }

  // function set_context($controller){
  //   $this->context = $controller;
  //   return $this;
  // }
	
	protected function load_language()
	{
		$lang = array();
    
    if(!file_exists($this->default_language_path)){
      mkdir($this->default_language_path);
    }

    if(!file_exists($this->default_language_path.$this->language.'.php')){
      $fp = fopen($this->default_language_path.$this->language.'.php', 'a');
      fwrite($fp,'<?php '.PHP_EOL);
    }


		include($this->default_language_path.$this->language.'.php');
    
      foreach($lang as $handle => $lang_string){
        if(!isset($this->lang_strings[$handle])){
          $this->lang_strings[$handle] = $lang_string;
        }  
      } 


	}
	
	
	function language_phrase($handle, $context = ''){

    if($context != ''){
      $this->context = $context;
    }

    $this->load_language();

		if(!array_key_exists($handle, $this->lang_strings))
		{
				
			$phrase = ucwords(implode(" ",explode("_", $handle)));
			
			//Add the new lang phrase to the language file
			$new_lang_phrase = "	\$lang['".$handle."'] = '".$phrase."';".PHP_EOL;
			$fp = fopen($this->default_language_path.$this->language.'.php', 'a');
			fwrite($fp, $new_lang_phrase);
			fclose($fp);
			
			$this->lang_strings[$handle] = $phrase;
		}
			
    return $this->lang_strings[$handle];
	}	
	
	
	
}
