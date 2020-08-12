<?php


class ClassValues_validators extends GenerateEntity {


  public function generate(){
    $this->success($this->getEntity()->getPk());
    $pkNfFk = $this->getEntity()->getFieldsByType(["nf", "fk"]);

    foreach ( $pkNfFk as $field ) {

      switch($field->getDataType()){
        default: $this->defecto($field);
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
