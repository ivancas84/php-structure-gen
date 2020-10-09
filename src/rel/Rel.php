<?php

require_once("GenerateFileEntity.php");

class GenClassRel extends GenerateFileEntity{

  public function __construct(Entity $entity) {
    $dir = $_SERVER["DOCUMENT_ROOT"]."/".PATH_SRC."/class/model/rel/";
    $name = "_" . $entity->getName("XxYy") . ".php";
    parent::__construct($dir, $name, $entity);
  }

  protected function generateCode(){
    if(!$this->getEntity()->hasRelations()) return;
    $this->start();
    $this->mapping();
    $this->fields();
    $this->methodJoin();
    $this->condition();
    $this->conditionAux();
    $this->json();
    $this->value();
    $this->end();
  }

  protected function start(){
    $this->string .= "<?php
require_once(\"class/model/Rel.php\");

class _" .  $this->getEntity()->getName("XxYy") . "Rel extends EntityRel{

";
  }

  protected function end(){
    $this->string .= "

}
" ;
  }


  protected function mapping(){
    require_once("rel/method/Mapping.php");
    $gen = new Rel_mapping($this->getEntity());
    $this->string .= $gen->generate();
  }

  protected function fields(){
    require_once("rel/method/Fields.php");
    $gen = new Rel_fields($this->getEntity());
    $this->string .= $gen->generate();
  }

  protected function methodJoin(){
    require_once("rel/method/Join.php");
    $gen = new Rel_join($this->getEntity());
    $this->string .= $gen->generate();
  }

  protected function condition(){
    require_once("rel/method/Condition.php");
    $gen = new Rel_condition($this->getEntity());
    $this->string .= $gen->generate();
  }

  protected function conditionAux(){
    require_once("rel/method/ConditionAux.php");
    $gen = new Rel_conditionAux($this->getEntity());
    $this->string .= $gen->generate();
  }


  protected function json(){
    require_once("rel/method/Json.php");
    $gen = new Rel_json($this->getEntity());
    $this->string .= $gen->generate();
  }

  
  protected function value(){
    require_once("rel/method/Value.php");
    $gen = new Rel_value($this->getEntity());
    $this->string .= $gen->generate();

  }



}
