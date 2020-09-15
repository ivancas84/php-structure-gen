<?php

require_once("GenerateFileEntity.php");

class GenClassMapping extends GenerateFileEntity{

  public function __construct(Entity $entity) {
    $dir = $_SERVER["DOCUMENT_ROOT"]."/".PATH_SRC."/class/model/mapping/";
    $name = "_" . $entity->getName("XxYy") . ".php";
    parent::__construct($dir, $name, $entity);
  }

  protected function generateCode(){
    $this->start();

    $this->struct();
    $this->aggregatePk();
    $this->aggregateNf();
    $this->aggregateFk();
    $this->label();
    $this->end();
  }

  protected function start(){
    $this->string .= "<?php
require_once(\"class/model/entityOptions/Mapping.php\");

class _" .  $this->getEntity()->getName("XxYy") . "Mapping extends MappingEntityOptions{

";
  }

  protected function end(){
    $this->string .= "

}
" ;
  }

  

  protected function struct(){
    foreach ($this->getEntity()->getFields() as $field){
      $this->string .= "  public function " . $field->getName('xxYy') . "() { return \$this->_pt() . \"." . $field->getName() . "\"; }
";
      switch($field->getDataType()){
        case "timestamp":
          $this->string .= "  public function " . $field->getName('xxYy') . "Date() { return \"CAST({\$this->_pt()}." . $field->getName() . " AS DATE)\"; }
  public function " . $field->getName('xxYy') . "Ym() { return \"DATE_FORMAT({\$this->_pt()}." . $field->getName() . ", '%Y-%m')\"; }
  public function " . $field->getName('xxYy') . "Y() { return \"DATE_FORMAT({\$this->_pt()}." . $field->getName() . ", '%Y')\"; }
";  
        break;
      }
    }
  }

  protected function aggregatePk(){
    $this->string .= "
  public function minId() { return \"MIN({\$this->_pt()}.id)\"; }
  public function maxId() { return \"MAX({\$this->_pt()}.id)\"; }
  public function countId() { return \"COUNT({\$this->_pt()}.id)\"; }

";
  }

  protected function aggregateNf(){
    foreach ($this->getEntity()->getFieldsNf() as $field){
      switch($field->getDataType()){
        case "float": case "integer":
          $this->string .= "  public function sum" . $field->getName('XxYy') . "() { return \"SUM({\$this->_pt()}.{$field->getName()})\"; }
  public function avg" . $field->getName('XxYy') . "() { return \"AVG({\$this->_pt()}.{$field->getName()})\"; }
  public function min" . $field->getName('XxYy') . "() { return \"MIN({\$this->_pt()}.{$field->getName()})\"; }
  public function max" . $field->getName('XxYy') . "() { return \"MAX({\$this->_pt()}.{$field->getName()})\"; }
  public function count" . $field->getName('XxYy') . "() { return \"COUNT({\$this->_pt()}.{$field->getName()})\"; }

";
        break;
        case "date": case "timestamp":
          $this->string .= "  public function avg" . $field->getName('XxYy') . "() { return \"AVG({\$this->_pt()}.{$field->getName()})\"; }
  public function min" . $field->getName('XxYy') . "() { return \"MIN({\$this->_pt()}.{$field->getName()})\"; }
  public function max" . $field->getName('XxYy') . "() { return \"MAX({\$this->_pt()}.{$field->getName()})\"; }
  public function count" . $field->getName('XxYy') . "() { return \"COUNT({\$this->_pt()}.{$field->getName()})\"; }

";
        break;
        default:
        $this->string .= "  public function min" . $field->getName('XxYy') . "() { return \"MIN({\$this->_pt()}.{$field->getName()})\"; }
  public function max" . $field->getName('XxYy') . "() { return \"MAX({\$this->_pt()}.{$field->getName()})\"; }
  public function count" . $field->getName('XxYy') . "() { return \"COUNT({\$this->_pt()}.{$field->getName()})\"; }

";
        break;
      }

    }
  }

  protected function aggregateFk(){
    foreach ($this->getEntity()->getFieldsFk() as $field){
      $this->string .= "  public function min" . $field->getName("XxYy") . "() { return \"MIN({\$this->_pt()}.{$field->getName()})\"; }
  public function max" . $field->getName("XxYy") . "() { return \"MAX({\$this->_pt()}.{$field->getName()})\"; }
  public function count" . $field->getName("XxYy") . "() { return \"COUNT({\$this->_pt()}.{$field->getName()})\"; }

";

    }
  }

  protected function label(){
    require_once("mapping/_Label.php");
    $gen = new GenMappingField_label($this->getEntity());
    $this->string .= $gen->generate();
  }





}
