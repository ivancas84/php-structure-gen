<?php

class ClassValues_setters extends GenerateEntity {

  public function generate(){
    $this->string .= "
";
    $this->pk();
    $this->nf();
    $this->fk();
    $this->string .= "
";
    return $this->string;
  }

  public function pk() {
    $this->defecto($this->getEntity()->getPk());
  }
  
  public function nf(){
    $pkNfFk = $this->getEntity()->getFieldsNf();

    foreach ( $pkNfFk as $field ) {

      switch($field->getDataType()){
        case "year": $this->dateTime($field); break;
        case "time": $this->dateTime($field); break;
        case "date": $this->date($field); break;
        case "timestamp": $this->dateTime($field); break;
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
    
    $this->string .= "  public function set{$field->getName('XxYy')}(\$p) { \$this->{$field->getName('xxYy')} = (is_null(\$p)) ? null : intval(\$p); }
";
  }

  protected function float(Field $field){
    $default = ($field->getDefault()) ? $field->getDefault() : "null";

    $this->string .= "  public function set{$field->getName('XxYy')}(\$p) { \$this->{$field->getName('xxYy')} = (is_null(\$p)) ? null : floatval(\$p); }
";
  }

  protected function boolean(Field $field){
    $default = ($field->getDefault()) ? $field->getDefault() : "null";

    $this->string .= "  public function set{$field->getName('XxYy')}(\$p) { \$this->{$field->getName('xxYy')} = settypebool(\$p); }
";
  }

  protected function defecto(Field $field){
    $this->string .= "  public function set{$field->getName('XxYy')}(\$p) { \$this->{$field->getName('xxYy')} = (is_null(\$p)) ? null : (string)\$p; }
";
  }

  protected function date(Field $field){
    $this->string .= "  public function _set{$field->getName('XxYy')}(DateTime \$p = null) { \$this->{$field->getName('xxYy')} = \$p; }

  public function set{$field->getName('XxYy')}(\$p) {
    if(!is_null(\$p)) {
      \$p = new SpanishDateTime(\$p);
      if(\$p) \$p->setTimeZone(new DateTimeZone(date_default_timezone_get()));
      \$p->setTime(0,0,0);
    }
    \$this->{$field->getName('xxYy')} = \$p;
  }

";
  }

  protected function dateTime(Field $field){
    $this->string .= "  public function _set{$field->getName('XxYy')}(DateTime \$p = null) { \$this->{$field->getName('xxYy')} = \$p; }

  public function set{$field->getName('XxYy')}(\$p) {
    if(!is_null(\$p)) {
      \$p = new SpanishDateTime(\$p);    
      if(\$p) \$p->setTimeZone(new DateTimeZone(date_default_timezone_get()));
    }
    \$this->{$field->getName('xxYy')} = \$p;  
  }

";
  }


}