<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
 *	@author 	: Nicodemus Karisa
 *	@date		: 27th September, 2018
 *	Finance management system for NGOs
 *	https://techsysnow.com
 *	NKarisa@ke.ci.org
 */


class Language extends MY_Controller implements CrudModelInterface
{

  function __construct(){
    parent::__construct();

  }

  function index(){}

function translator(){

  $locale = $this->session->user_locale;

  $key = $this->input->post('key');
  $phrase = $this->input->post('phrase');

  $reading = fopen(APPPATH.'language/'.$locale.'.php', 'r');
  $writing = fopen(APPPATH.'language/myfile.tmp', 'w');

  $replaced = false;

  while (!feof($reading)) {
    $line = fgets($reading);
    
    if (stristr($line,$key)) {
      $line = "\t\$lang['".$key."'] = '".$phrase."';\n";
      $replaced = true;
    }

    fputs($writing, $line);
  }
  fclose($reading); fclose($writing);
  // might as well not overwrite the file if we didn't replace anything
  if ($replaced) 
  {
    rename(APPPATH.'language/myfile.tmp', APPPATH.'language/'.$locale.'.php');
  } else {
    unlink(APPPATH.'language/myfile.tmp');
  }

  //return $phrase;
}


  static function get_menu_list(){

  }

}