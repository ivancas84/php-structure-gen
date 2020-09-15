<?php

require_once("GenerateFileEntity.php");

class GenClassValue extends GenerateFileEntity{

  public function __construct(Entity $entity) {
    $dir = $_SERVER["DOCUMENT_ROOT"]."/".PATH_SRC."/class/model/value/";
    $name = "_" . $entity->getName("XxYy") . ".php";
    parent::__construct($dir, $name, $entity);
  }

  protected function generateCode(){
    $this->start();

    $this->properties();
    $this->setDefault();
   
    $this->isEmpty();

    $this->getters();
    $this->setters();
    $this->resetters();
    $this->validators();
    $this->sql();

    $this->end();
  }

  protected function start(){
    $this->string .= "<?php
require_once(\"class/model/entityOptions/Value.php\");

class _" .  $this->getEntity()->getName("XxYy") . "Value extends ValueEntityOptions{

";
  }

  protected function end(){
    $this->string .= "

}
" ;
  }


  protected function properties(){
    foreach($this->entity->getFieldsByType(["pk", "nf", "fk"]) as $field) $this->string .= "  protected \${$field->getName('xxYy')} = UNDEFINED;
";

$this->string .= "
";
  }

  protected function setDefault(){
    require_once("value/_setDefault.php");
    $g = new GenValue_setDefault($this->getEntity());
    $this->string .=  $g->generate();
  }

  protected function getters(){
    require_once("value/_getters.php");
    $g = new GenValue_getters($this->getEntity());
    $this->string .=  $g->generate();
  }

  protected function isEmpty(){
    require_once("value/_isEmpty.php");
    $g = new GenValue_isEmpty($this->getEntity());
    $this->string .=  $g->generate();
  }

  protected function setters(){
    require_once("value/_setters.php");
    $g = new GenValue_setters($this->getEntity());
    $this->string .=  $g->generate();
  }

  protected function resetters(){
    require_once("value/_resetters.php");
    $g = new GenValue_resetters($this->getEntity());
    $this->string .=  $g->generate();
  }

  protected function validators(){
    require_once("value/_validators.php");
    $g = new GenValue_validators($this->getEntity());
    $this->string .=  $g->generate();
  }

  protected function sql(){
    require_once("value/_sql.php");
    $g = new GenValue_sql($this->getEntity());
    $this->string .=  $g->generate();
  }
}
