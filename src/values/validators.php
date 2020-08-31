<?php


class ClassValues_validators extends GenerateEntity {


  public function generate(){
    $this->success($this->getEntity()->getPk());
    $pkNfFk = $this->getEntity()->getFieldsByType(["nf", "fk"]);

    foreach ( $pkNfFk as $field ) {

      switch($field->getDataType()){
        case "date": case "timestamp": case "year": case "time": $this->checkMethod2($field, ["isA('DateTime')"]); break;
        default: $this->checkMethod2($field);
      }
    }
    return $this->string;  
  }

  protected function checkMethod($field, $method){
    $r = ($field->isNotNull()) ? "->required()" : "";
    $this->string .= "  public function check{$field->getName('XxYy')}(\$value) { 
    \$this->_logs->resetLogs(\"{$field->getName()}\");
    if(Validation::is_undefined(\$value)) return null;
    \$v = Validation::getInstanceValue(\$value)->{$method}(){$r};
    foreach(\$v->getErrors() as \$error){ \$this->_logs->addLog(\"{$field->getName()}\", \"error\", \$error); }
    return \$v->isSuccess();
  }

";
  }

  protected function defecto(Field $field){
    ($field->isNotNull()) ? $this->notNull($field) : $this->success($field);
  }

  protected function success(Field $field){
    $this->string .= "  public function check{$field->getName('XxYy')}(\$value) { 
      if(Validation::is_undefined(\$value)) return null;
      return true; 
  }

";
  }

  
  protected function checkMethod2($field, array $methods = []){
    if ($field->isNotNull()) array_unshift($methods, "required()"); //required debe chequearse primero
    if(empty($methods)) return $this->success($field);

    $this->string .= "  public function check{$field->getName('XxYy')}(\$value) { 
    \$this->_logs->resetLogs(\"{$field->getName()}\");
    if(Validation::is_undefined(\$value)) return null;
    \$v = Validation::getInstanceValue(\$value)->" . implode("->", $methods). ";
    foreach(\$v->getErrors() as \$error){ \$this->_logs->addLog(\"{$field->getName()}\", \"error\", \$error); }
    return \$v->isSuccess();
  }

";
  }

  protected function date(Field $field){
    $methods = array("isA('DateTime')");
    if ($field->isNotNull()) array_push($methods, "required()");
    $this->string .= "  public function check{$field->getName('XxYy')}(\$value) { 
    \$this->_logs->resetLogs(\"{$field->getName()}\");
    if(Validation::is_undefined(\$value)) return null;
    \$v = Validation::getInstanceValue(\$value)->required();
    foreach(\$v->getErrors() as \$error){ \$this->_logs->addLog(\"{$field->getName()}\", \"error\", \$error); }
    return \$v->isSuccess();
  }

";
  }

  protected function notNull(Field $field){
    $this->string .= "  public function check{$field->getName('XxYy')}(\$value) { 
    \$this->_logs->resetLogs(\"{$field->getName()}\");
    if(Validation::is_undefined(\$value)) return null;
    \$v = Validation::getInstanceValue(\$value)->required();
    foreach(\$v->getErrors() as \$error){ \$this->_logs->addLog(\"{$field->getName()}\", \"error\", \$error); }
    return \$v->isSuccess();
  }

";
  }

  


}
