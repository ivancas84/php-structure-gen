<?php


class GenValues_reset extends GenerateEntity {


   public function generate(){
    $this->start();
    $this->body();
    $this->end();
    return $this->string;
  }
  
  protected function start(){
    $this->string .= "  public function _reset(){
";
  }



  protected function body(){
    $pkNfFk = $this->getEntity()->getFieldsNf();
    foreach ( $pkNfFk as $field ) {
      switch($field->getDataType()){
        case "string": case "text": $this->reset($field); break;
      }
    }
  }


  protected function end(){
      $this->string .= "    return \$this;
  }

";
  }

  protected function reset($field){
    $this->string .= "    \$this->reset{$field->getName('XxYy')}();
"; 
  }

}
