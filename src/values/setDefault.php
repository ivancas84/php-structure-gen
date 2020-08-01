<?php

class GenValues_setDefault extends GenerateEntity {
  public function generate(){
    $this->start();
    $this->body();
    $this->end();

    return $this->string;
  }

  protected function start(){
    $this->string .= "
  public function _setDefault(){
";
  }


  public function body(){
    $pkNfFk = $this->getEntity()->getFields();

    foreach ( $pkNfFk as $field ) {
      switch($field->getDataType()){
        case "date": case "timestamp": case "year": case "time": $this->datetime($field); break; 
        case "integer": $this->withoutQuotes($field); break;
        default: $this->withQuotes($field); break;
      }
      
      
    }
  }

  protected function end(){
    $this->string .= "    return \$this;
  }

";
  }


  protected function withoutQuotes($field){
    $default = ($field->getDefault()) ? $field->getDefault() : "null";
    $this->string .= "    \$this->set{$field->getName('XxYy')}({$default});
";
  }
  
  protected function withQuotes($field){
    $default = ($field->getDefault()) ? "'".$field->getDefault() . "'": "null";
    $this->string .= "    \$this->set{$field->getName('XxYy')}({$default});
";
  }

  protected function datetime($field){
    if(strpos(strtolower($field->getDefault()), "current") !== false){
      $default = "date('c')";
    } else {
      $default = ($field->getDefault()) ? "'" . $field->getDefault() . "'" : "null";
    }
    $this->string .= "    \$this->set{$field->getName('XxYy')}({$default});
";
  }


  


}
