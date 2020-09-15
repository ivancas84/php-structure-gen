<?php


class GenValue_validators extends GenerateEntity {


  public function generate(){
    $this->success($this->getEntity()->getPk());
    $pkNfFk = $this->getEntity()->getFieldsByType(["nf", "fk"]);

    foreach ( $pkNfFk as $field ) {

      switch($field->getDataType()){
        case "date": case "timestamp": case "year": case "time": $this->checkMethod($field, ["isA('DateTime')"]); break;
        default: $this->checkMethod($field);
      }
    }
    return $this->string;  
  }


  protected function success(Field $field){
    $this->string .= "  public function check{$field->getName('XxYy')}() { 
      if(Validation::is_undefined(\$this->{$field->getName('xxYy')})) return null;
      return true; 
  }

";
  }

  
  protected function checkMethod($field, array $methods = []){
    if ($field->isNotNull()) array_unshift($methods, "required()"); //required debe chequearse primero
    if ($l = $field->getLength()) array_push($methods, "max({$l})");
    if ($l = $field->getMinLength()) array_push($methods, "min({$l})");
    if(empty($methods)) return $this->success($field);

    $this->string .= "  public function check{$field->getName('XxYy')}() { 
    \$this->_logs->resetLogs(\"{$field->getName()}\");
    if(Validation::is_undefined(\$this->{$field->getName('xxYy')})) return null;
    \$v = Validation::getInstanceValue(\$this->{$field->getName('xxYy')})->" . implode("->", $methods). ";
    foreach(\$v->getErrors() as \$error){ \$this->_logs->addLog(\"{$field->getName()}\", \"error\", \$error); }
    return \$v->isSuccess();
  }

";
  }

}
