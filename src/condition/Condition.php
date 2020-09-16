<?php

require_once("GenerateFileEntity.php");

class GenClassCondition extends GenerateFileEntity{

  public function __construct(Entity $entity) {
    $dir = $_SERVER["DOCUMENT_ROOT"]."/".PATH_SRC."/class/model/condition/";
    $name = "_" . $entity->getName("XxYy") . ".php";
    parent::__construct($dir, $name, $entity);
  }

  protected function generateCode(){
    $this->start();

    $this->condition();
    $this->end();
  }

  protected function start(){
    $this->string .= "<?php
require_once(\"class/model/entityOptions/Condition.php\");

class _" .  $this->getEntity()->getName("XxYy") . "Condition extends ConditionEntityOptions{

";
  }

  protected function end(){
    $this->string .= "

}
" ;
  }

  protected function condition(){
    foreach ( $this->getEntity()->getFields() as $field) {
      switch ( $field->getDataType() ) {

        case "string":
        case "text": $this->string($field); break;
        case "boolean": $this->boolean($field); break;
        case "date": $this->date($field); break;
        case "time": $this->time($field); break;
        case "timestamp": $this->timestamp($field); break;

        //integer, float, year...
        default: $this->defecto($field);
      }
    }
    $this->string .= "
";
  }


  
  protected function string($field) {
    $this->_text($field);
    $this->_isSet($field);
  }

  protected function defecto($field) {
    $this->_condition($field);
    $this->_isSet($field);
	}

  protected function date($field) {
    $this->_date($field);
    $this->_date($field, "Ym");
    $this->_year($field, "Y");
    $this->_isSet($field);
  }

  

  protected function timestamp($field) {
    $this->_date($field);
    $this->_date($field, "Date");
    $this->_date($field, "Ym");
    $this->_year($field, "Y");
    $this->_isSet($field);
  }
  
  protected function time($field) {
    $this->_date($field);
    $this->_date($field, "Hm");
    $this->_isSet($field);
  }
  
  public function boolean($field, $sufix = ""){
    $this->string .= "  public function {$field->getName('xxYy')}{$sufix}(\$option, \$value) { 
    \$field = \$this->mapping->{$field->getName('xxYy')}{$sufix}();
    if(\$c = \$this->_exists(\$field, \$option, \$value)) return \$c;
    \$this->value->set{$field->getName('XxYy')}{$sufix}(\$value);
    if(!\$this->value->check{$field->getName('XxYy')}{$sufix}()) throw new Exception(\"Valor incorrecto: {$field->getName('Xx Yy')} {$sufix}\");
    return \"({\$field} {\$option} {\$this->value->sql{$field->getName('XxYy')}{$sufix}()})\";  
  }
  
";
}


  public function _condition($field, $sufix = ""){
    $this->string .= "  public function {$field->getName('xxYy')}{$sufix}(\$option, \$value) { 
    \$field = \$this->mapping->{$field->getName('xxYy')}{$sufix}();
    if(\$c = \$this->_exists(\$field, \$option, \$value)) return \$c;
    if(\$c = \$this->_approxCast(\$field, \$option, \$value)) return \$c;
    \$this->value->set{$field->getName('XxYy')}{$sufix}(\$value);
    if(!\$this->value->check{$field->getName('XxYy')}{$sufix}()) throw new Exception(\"Valor incorrecto: {$field->getName('Xx Yy')} {$sufix}\");
    return \"({\$field} {\$option} {\$this->value->sql{$field->getName('XxYy')}{$sufix}()})\";  
  }

  ";
  }

  public function _date($field, $sufix = ""){
    $this->string .= "  public function {$field->getName('xxYy')}{$sufix}(\$option, \$value) { 
    \$field = \$this->mapping->{$field->getName('xxYy')}{$sufix}();
    if(\$c = \$this->_exists(\$field, \$option, \$value)) return \$c;
    if(\$c = \$this->_approxCast(\$field, \$option, \$value)) return \$c;
    \$this->value->set{$field->getName('XxYy')}(\$value);
    if(!\$this->value->check{$field->getName('XxYy')}()) throw new Exception(\"Valor incorrecto: {$field->getName('Xx Yy')} {$sufix}\");
    return \"({\$field} {\$option} {\$this->value->sql{$field->getName('XxYy')}{$sufix}()})\";  
  }

";
  }

  public function _year($field){
    $this->string .= "  public function {$field->getName('xxYy')}Y(\$option, \$value) { 
    \$field = \$this->mapping->{$field->getName('xxYy')}Y();
    if(\$c = \$this->_exists(\$field, \$option, \$value)) return \$c;
    if(\$c = \$this->_approxCast(\$field, \$option, \$value)) return \$c;
    \$this->value->set{$field->getName('XxYy')}Y(\$value);
    if(!\$this->value->check{$field->getName('XxYy')}()) throw new Exception(\"Valor incorrecto: {$field->getName('Xx Yy')} Y\");
    return \"({\$field} {\$option} {\$this->value->sql{$field->getName('XxYy')}Y()})\";  
  }

";
  }

  public function _text($field){
    $this->string .= "  public function {$field->getName('xxYy')}(\$option, \$value) { 
    \$field = \$this->mapping->{$field->getName('xxYy')}();
    if(\$c = \$this->_exists(\$field, \$option, \$value)) return \$c;
    if(\$c = \$this->_approx(\$field, \$option, \$value)) return \$c;
    \$this->value->set{$field->getName('XxYy')}(\$value);
    if(!\$this->value->check{$field->getName('XxYy')}()) throw new Exception(\"Valor incorrecto: {$field->getName('Xx Yy')}\");
    return \"({\$field} {\$option} {\$this->value->sql{$field->getName('XxYy')}()})\";  
  }

";
  }


  public function _isSet($field){
    $this->string .= "  public function {$field->getName('xxYy')}IsSet(\$option, \$value) { 
    return \$this->_exists(\$this->mapping->{$field->getName('xxYy')}(), \$option, settypebool(\$value));
  }

";
  }

}
