<?php


class Values_toArray extends GenerateEntity {


   public function generate(){
    $this->start();
    $this->body();
    $this->end();
    return $this->string;
  }
  
  protected function start(){
    $this->string .= "  public function _toArray(){
    \$row = [];
";
  }



  protected function body(){
    $pkNfFk = $this->getEntity()->getFields();
    foreach ( $pkNfFk as $field ) {
      switch($field->getDataType()){
        case "date": case "timestamp": case "time": case "year":  $this->method($field, "c"); break;
        default: $this->method($field); break;
      }
    }
  }


  protected function end(){
      $this->string .= "    return \$row;
  }

";
    }

  protected function method($field, $format = null){
    $f = empty($format) ? "" : "\"{$format}\"";
    $this->string .= "    if(\$this->{$field->getName('xxYy')} !== UNDEFINED) \$row[\"" . $field->getName() . "\"] = \$this->{$field->getName('xxYy')}({$f});
"; 
  }
    
  protected function boolean($field){
    $this->string .= "    if(\$this->{$field->getName('xxYy')} !== UNDEFINED) \$row[\"" . $field->getName() . "\"] = (\$this->{$field->getName('xxYy')}) ? true : false;        
";
  }

  protected function defecto($field){
    $this->string .= "    if(\$this->{$field->getName('xxYy')} !== UNDEFINED) \$row[\"" . $field->getName() . "\"] = \$this->{$field->getName('xxYy')};
";
  }


}
