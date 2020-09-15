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
        case "text":
        case "year": $this->string($field); break;

        case "integer":
        case "float": $this->number($field); break;

        case "boolean": $this->boolean($field); break;

        case "date": $this->date($field); break;
        case "time": $this->time($field); break;

        case "timestamp": $this->timestamp($field); break;

      }
    }
    $this->string .= "
";
  }


  
  protected function string($field) {
    $this->string .= "  public function {$field->getName('xxYy')}(\$option, \$value) { return \$this->format->conditionText(\$this->mapping->{$field->getName('xxYy')}(), \$value, \$option); }
  public function {$field->getName('xxYy')}IsSet(\$option, \$value) { return \$this->format->conditionIsSet(\$this->mapping->{$field->getName('xxYy')}(), \$value, \$option); }

" ;
  }

  protected function number($field) {
    $this->string .= "  public function {$field->getName('xxYy')}(\$option, \$value) { return \$this->format->conditionNumber(\$this->mapping->{$field->getName('xxYy')}(), \$value, \$option); }
  public function {$field->getName('xxYy')}IsSet(\$option, \$value) { return \$this->format->conditionIsSet(\$this->mapping->{$field->getName('xxYy')}(), \$value, \$option); }

" ;
	}

  protected function date($field) {
    $this->string .= "  public function {$field->getName('xxYy')}(\$option, \$value) { return \$this->format->conditionDateTime(\$this->mapping->{$field->getName('xxYy')}(), \$value, \$option, \"Y-m-d\"); }
  public function {$field->getName('xxYy')}IsSet(\$option, \$value) { return \$this->format->conditionIsSet(\$this->mapping->{$field->getName('xxYy')}(), \$value, \$option); }

" ;
  }

  protected function timestamp($field) {
    $this->string .= "  public function {$field->getName('xxYy')}(\$option, \$value) { return \$this->format->conditionDateTime(\$this->mapping->{$field->getName('xxYy')}(), \$value, \$option, \"Y-m-d H:i:s\"); }
  public function {$field->getName('xxYy')}Date(\$option, \$value) { return \$this->format->conditionDateTime(\$this->mapping->{$field->getName('xxYy')}Date(), \$value, \$option, \"Y-m-d\"); }
  public function {$field->getName('xxYy')}IsSet(\$option, \$value) { return \$this->format->conditionIsSet(\$this->mapping->{$field->getName('xxYy')}(), \$value, \$option); }
  public function {$field->getName('xxYy')}Ym(\$option, \$value) { return \$this->format->conditionDateTimeAux(\$this->mapping->{$field->getName('xxYy')}Ym(), \$value, \$option, \"Y-m\"); }
  public function {$field->getName('xxYy')}Y(\$option, \$value) { return \$this->format->conditionDateTimeAux(\$this->mapping->{$field->getName('xxYy')}Y(), \$value, \$option, \"Y\"); }

" ;
  }
  
  protected function time($field) {
    $this->string .= "  public function {$field->getName('xxYy')}(\$option, \$value) { return \$this->format->conditionDateTime(\$this->mapping->{$field->getName('xxYy')}(), \$value, \$option, \"H:i:s\"); }
  public function {$field->getName('xxYy')}Hm(\$option, \$value) { return \$this->format->conditionDateTime(\$this->mapping->{$field->getName('xxYy')}Hm(), \$value, \$option, \"H:i\"); }
  public function {$field->getName('xxYy')}IsSet(\$option, \$value) { return \$this->format->conditionIsSet(\$this->mapping->{$field->getName('xxYy')}(), \$value, \$option); }

" ;
  }
  
  protected function year($field) {
    $this->string .= "  public function {$field->getName('xxYy')}(\$option, \$value) { return \$this->format->conditionDateTimeAux(\$this->mapping->{$field->getName('xxYy')}(), \$value, \$option, \"Y\"); }
  public function {$field->getName('xxYy')}IsSet(\$option, \$value) { return \$this->format->conditionIsSet(\$this->mapping->{$field->getName('xxYy')}(), \$value, \$option); }

" ;
  }

  protected function boolean($field) {
    $this->string .= "  public function {$field->getName('xxYy')}(\$option, \$value) { return \$this->format->conditionBoolean(\$this->mapping->{$field->getName('xxYy')}(), \$value); }
  public function {$field->getName('xxYy')}IsSet(\$option, \$value) { return \$this->format->conditionIsSet(\$this->mapping->{$field->getName('xxYy')}(), \$value, \$option); }

" ;
  }

}
