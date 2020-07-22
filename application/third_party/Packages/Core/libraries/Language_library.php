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

    ob_start();
		include($this->default_language_path.$this->language.'.php');
    ob_get_contents();
    ob_end_clean();

    $this->lang_strings = $lang;

	}
	
	
	function language_phrase($handle){

    $this->load_language();

		if(strlen($handle) > 1  && !array_key_exists($handle, $this->lang_strings) && !is_numeric($handle))
		{
				
			$phrase = ucwords(implode(" ",explode("_", $handle)));
			
			//Add the new lang phrase to the language file
			$new_lang_phrase = "	\$lang['".$handle."'] = '".$phrase."';".PHP_EOL;
			$fp = fopen($this->default_language_path.$this->language.'.php', 'a');
			fwrite($fp, $new_lang_phrase);
			fclose($fp);
			
			$this->lang_strings[$handle] = $phrase;
		}
			
    return isset($this->lang_strings[$handle])?$this->lang_strings[$handle]:"";
	}	
	
	
	
}
