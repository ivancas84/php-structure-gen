<?php

require_once("GenerateFileEntity.php");

class GenClassSql extends GenerateFileEntity{

  public function __construct(Entity $entity) {
    $dir = $_SERVER["DOCUMENT_ROOT"]."/".PATH_SRC."/class/model/sql/";
    $name = "_" . $entity->getName("XxYy") . ".php";
    parent::__construct($dir, $name, $entity);
  }

  protected function generateCode(){
    if(!$this->getEntity()->hasRelations()) return;
    $this->start();
    $this->mappingField();
    $this->fields();
    $this->methodJoin();
    $this->condition();
    $this->conditionAux();
    $this->end();
  }

  protected function start(){
    $this->string .= "<?php
require_once(\"class/model/Sql.php\");

class _" .  $this->getEntity()->getName("XxYy") . "Sql extends EntitySql{

";
  }

  protected function end(){
    $this->string .= "

}
" ;
  }


  protected function mappingField(){
    require_once("sql/method/MappingField.php");
    $gen = new ClassSql_mappingField($this->getEntity());
    $this->string .= $gen->generate();
  }

  protected function fields(){
    require_once("sql/method/Fields.php");
    $gen = new Sql_fields($this->getEntity());
    $this->string .= $gen->generate();
  }

  protected function methodJoin(){
    require_once("sql/method/Join.php");
    $gen = new ClassSql_join($this->getEntity());
    $this->string .= $gen->generate();
  }

  protected function condition(){
    require_once("sql/method/ConditionFieldStruct.php");
    $gen = new ClassSql_conditionFieldStruct($this->getEntity());
    $this->string .= $gen->generate();
  }

  protected function conditionAux(){
    require_once("sql/method/ConditionFieldAux.php");
    $gen = new ClassSql_conditionFieldAux($this->getEntity());
    $this->string .= $gen->generate();
  }





}
