<?php

require_once("GenerateFileEntity.php");

class GenClassSql extends GenerateFileEntity{

  public function __construct(Entity $entity) {
    $dir = $_SERVER["DOCUMENT_ROOT"]."/".PATH_SRC."/class/model/sql/";
    $name = "_" . $entity->getName("XxYy") . ".php";
    parent::__construct($dir, $name, $entity);
  }

  protected function generateCode(){
    $this->start();
    $this->mappingField();
    $this->methodFields();
    $this->methodJoin();
    //$this->conditionSearch();
    $this->filters();
    $this->format();
    $this->json(); //este metodo no coincide con la responsabilidad de la clase SQL pero por el momento se deja aqui hasta encontrar un lugar mas apropiado
    //$this->values(); este metodo transforma el resultado json en values, pero por el momento se descarta
    //$this->order(); hay un metodo general que resuelve la tarea de ordenamiento para ambos motores
    $this->end();
  }

  protected function start(){
    $this->string .= "<?php
require_once(\"class/model/Sql.php\");

class _" .  $this->getEntity()->getName("XxYy") . "Sql extends EntitySql{

  public function __construct(){
    parent::__construct();
    \$this->entity = Entity::getInstanceRequire('{$this->getEntity()->getName()}');
  }


";
  }

  protected function end(){
    $this->string .= "

}
" ;
  }

  protected function values(){
    require_once("sql/method/Values.php");
    $gen = new ClassSql_values($this->getEntity());
    $this->string .= $gen->generate();
  }

    protected function json(){
      require_once("sql/method/_Json.php");
      $gen = new ClassSql__json($this->getEntity());
      $this->string .= $gen->generate();
    }


  protected function mappingField(){
    require_once("sql/method/_mappingField/_MappingField.php");
    $gen = new GenSql_mappingField($this->getEntity());
    $this->string .= $gen->generate();

    require_once("sql/method/MappingField.php");
    $gen = new ClassSql_mappingField($this->getEntity());
    $this->string .= $gen->generate();
  }

  protected function methodFields(){
    require_once("sql/method/fields/_Fields.php");
    $gen = new Sql__fields($this->getEntity());
    $this->string .= $gen->generate();

    require_once("sql/method/fields/_FieldsDb.php");
    $gen = new Sql__fieldsDb($this->getEntity());
    $this->string .= $gen->generate();

    require_once("sql/method/fields/Fields.php");
    $gen = new Sql_fields($this->getEntity());
    $this->string .= $gen->generate();
  }

  protected function methodJoin(){
    require_once("sql/method/Join.php");
    $gen = new ClassSql_join($this->getEntity());
    $this->string .= $gen->generate();
  }

  /*
  protected function conditionSearch(){
    require_once("sql/method/ConditionSearch.php");
    $gen = new ClassSql_conditionSearch($this->getEntity());
    $this->string .= $gen->generate();

    require_once("sql/method/_ConditionSearch.php");
    $gen = new ClassSql__conditionSearch($this->getEntity());
    $this->string .= $gen->generate();

  }*/



  protected function filters(){
    require_once("sql/method/_ConditionFieldStruct.php");
    $gen = new ClassSql__conditionFieldStruct($this->getEntity());
    $this->string .= $gen->generate();

    require_once("sql/method/ConditionFieldStruct.php");
    $gen = new ClassSql_conditionFieldStruct($this->getEntity());
    $this->string .= $gen->generate();

    require_once("sql/method/ConditionFieldAux.php");
    $gen = new ClassSql_conditionFieldAux($this->getEntity());
    $this->string .= $gen->generate();
  }




  //Este metodo funciona pero actualmente no se genera, se utiliza un método más sencillo que resuelve el problema del ordemiento
  protected function order(){
    require_once("sql/method/Order.php");
    $gen = new ClassSql_order($this->getEntity());
    $this->string .= $gen->generate();
  }

  protected function format(){
    require_once("sql/method/Format.php");
    $gen = new Sql_FormatSql($this->getEntity());
    $this->string .= $gen->generate();
  }

}
