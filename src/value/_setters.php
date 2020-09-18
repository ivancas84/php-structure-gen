<?php

class GenValue_setters extends GenerateEntity {

  public function generate(){
    $this->pk();
    $this->nf();
    $this->fk();
    return $this->string;
  }

  public function pk() {
    $this->defecto($this->getEntity()->getPk());
  }
  
  public function nf(){
    $pkNfFk = $this->getEntity()->getFieldsNf();

    foreach ( $pkNfFk as $field ) {

      switch($field->getDataType()){
        case "year": 
          $this->_dateTime($field);
          $this->year($field); 
        break;
        case "time": 
          $this->_dateTime($field);
          $this->dateTime($field);
        break;
        case "date": 
          $this->_dateTime($field);
          $this->dateTime($field); 
          $this->year($field, "Y");
        break;
        case "timestamp": 
          $this->_dateTime($field);
          $this->dateTime($field);
          $this->year($field, "Y");

        break;
        case "integer": $this->integer($field); break;
        case "float": $this->float($field); break;
        case "boolean": $this->boolean($field); break;
        //case "string": case "text": $this->text($field); break;
        default: $this->defecto($field);

      }
    }
  }

  public function fk(){
    $pkNfFk = $this->getEntity()->getFieldsFk();

    foreach ( $pkNfFk as $field ) {
      switch($field->getDataType()){
        default: $this->defecto($field); break;
      }
    }
  }

  protected function integer(Field $field){
    $default = ($field->getDefault()) ? $field->getDefault() : "null";
    
    $this->string .= "  public function _set{$field->getName('XxYy')}(integer \$p = null) { return \$this->{$field->getName('xxYy')} = \$p; }    
  public function set{$field->getName('XxYy')}(\$p) { return \$this->{$field->getName('xxYy')} = (is_null(\$p)) ? null : intval(\$p); }

";
  }

  protected function float(Field $field){
    $default = ($field->getDefault()) ? $field->getDefault() : "null";

    $this->string .= "  public function _set{$field->getName('XxYy')}(float \$p = null) { return \$this->{$field->getName('xxYy')} = \$p; }  
  public function set{$field->getName('XxYy')}(\$p) { return \$this->{$field->getName('xxYy')} = (is_null(\$p)) ? null : floatval(\$p); }

";
  }

  protected function boolean(Field $field){
    $default = ($field->getDefault()) ? $field->getDefault() : "null";

    $this->string .= "  public function _set{$field->getName('XxYy')}(boolean \$p = null) { return \$this->{$field->getName('xxYy')} = \$p; }  
  public function set{$field->getName('XxYy')}(\$p) { return \$this->{$field->getName('xxYy')} = settypebool(\$p); }

";
  }

  protected function defecto(Field $field){
    $this->string .= "  public function _set{$field->getName('XxYy')}(string \$p = null) { return \$this->{$field->getName('xxYy')} = \$p; }  
  public function set{$field->getName('XxYy')}(\$p) { return \$this->{$field->getName('xxYy')} = (is_null(\$p)) ? null : (string)\$p; }

";
  }

  protected function _dateTime(Field $field){
    $this->string .= "  public function _set{$field->getName('XxYy')}(DateTime \$p = null) { return \$this->{$field->getName('xxYy')} = \$p; }  

";
  }

  protected function dateTime(Field $field, $sufix = ""){
    $this->string .= "  public function set{$field->getName('XxYy')}{$sufix}(\$p) {
    if(!is_null(\$p) && !(\$p instanceof DateTime)) \$p = new SpanishDateTime(\$p);
    if(\$p instanceof DateTime) \$p->setTimeZone(new DateTimeZone(date_default_timezone_get()));
    return \$this->{$field->getName('xxYy')}{$sufix} = \$p;
  }

";
  }

  protected function year(Field $field, $sufix = ""){
    $this->string .= "  public function set{$field->getName('XxYy')}{$sufix}(\$p) {
    if(!is_null(\$p) && !(\$p instanceof DateTime)) {
      \$p = (strlen(\$p) == 4) ? SpanishDateTime::createFromFormat('Y', \$p) : new SpanishDateTime(\$p);
    }
    if(\$p instanceof DateTime) \$p->setTimeZone(new DateTimeZone(date_default_timezone_get()));
    return \$this->{$field->getName('xxYy')} = \$p;
  }

";
  }

}