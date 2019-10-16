<?php

class CustomException extends Exception {
  public function errorMessage() {
    //error message
    $errorMsg = 'Error on line '.$this->getLine().' in '.$this->getFile()
    .': <b>'.$this->getMessage().'</b> is not a valid file name';
    return $errorMsg;
  }

  public function columnMismatch(){
    return "Mismatch";
  }
}
