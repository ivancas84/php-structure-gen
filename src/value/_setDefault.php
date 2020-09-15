<?php

require_once("function/settypebool.php");

class GenValue_setDefault extends GenerateEntity {
  public function generate(){
    $this->pk();
    $this->body();

    return $this->string . "
";
  }

  public function pk(){
    $this->string .= "  public function setDefaultId() { if(\$this->id === UNDEFINED) \$this->setId(uniqid()); }
";
  }

  public function body(){
    foreach ( $this->getEntity()->getFieldsByType(["nf", "fk"]) as $field ) {
      switch($field->getDataType()){
        case "boolean": $this->boolean($field); break;
        case "date": case "timestamp": case "year": case "time": $this->datetime($field); break; 
        case "integer": $this->withoutQuotes($field); break;
        default: $this->withQuotes($field); break;
      }
    }
  }
  
  protected function boolean($field){
    if(!is_null($field->getDefault())){
      $default =  settypebool($field->getDefault()) ? "true" : "false";
    } else {
      $default = "null";
    }
    $this->string .= "  public function setDefault{$field->getName('XxYy')}() { if(\$this->{$field->getName('xxYy')} === UNDEFINED) \$this->set{$field->getName('XxYy')}({$default}); }
";
  }


  protected function withoutQuotes($field){
    $default = ($field->getDefault()) ? $field->getDefault() : "null";
    $this->string .= "  public function setDefault{$field->getName('XxYy')}() { if(\$this->{$field->getName('xxYy')} === UNDEFINED) \$this->set{$field->getName('XxYy')}({$default}); }
";
  }
  
  protected function withQuotes($field){
    $default = ($field->getDefault()) ? "'".$field->getDefault() . "'": "null";
    $this->string .= "  public function setDefault{$field->getName('XxYy')}() { if(\$this->{$field->getName('xxYy')} === UNDEFINED) \$this->set{$field->getName('XxYy')}({$default}); }
";
  }

  protected function datetime($field){
    if(strpos(strtolower($field->getDefault()), "current") !== false){
      $default = "date('c')";
    } else {
      $default = ($field->getDefault()) ? "'" . $field->getDefault() . "'" : "null";
    }
    $this->string .= "  public function setDefault{$field->getName('XxYy')}() { if(\$this->{$field->getName('xxYy')} === UNDEFINED) \$this->set{$field->getName('XxYy')}({$default}); }
";
  }

}
