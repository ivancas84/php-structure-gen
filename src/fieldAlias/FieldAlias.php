<?php

require_once("GenerateFileEntity.php");

class GenClassFieldAlias extends GenerateFileEntity{

  public function __construct(Entity $entity) {
    $dir = $_SERVER["DOCUMENT_ROOT"]."/".PATH_SRC."/class/model/fieldAlias/";
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
require_once(\"class/model/entityOptions/FieldAlias.php\");

class _" .  $this->getEntity()->getName("XxYy") . "FieldAlias extends FieldAliasEntityOptions{

";
  }

  protected function end(){
    $this->string .= "

}
" ;
  }

  

  protected function struct(){
    foreach ($this->getEntity()->getFields() as $field){
      $this->string .= "  public function " . $field->getName('xxYy') . "() { return \$this->mapping->{$field->getName('xxYy')}() . \" AS \" . \$this->_pf() . \"{$field->getName()}\"; }
";
      switch($field->getDataType()){
        case "timestamp":
          $this->string .= "  public function " . $field->getName('xxYy') . "Date() { return \$this->mapping->{$field->getName('xxYy')}Date() . \" AS \" . \$this->_pf() . \"{$field->getName()}_date\"; }
  public function " . $field->getName('xxYy') . "Ym() { return \$this->mapping->{$field->getName('xxYy')}Ym() . \" AS \" . \$this->_pf() . \"{$field->getName()}_ym\"; }
  public function " . $field->getName('xxYy') . "Y() { return \$this->mapping->{$field->getName('xxYy')}Y() . \" AS \" . \$this->_pf() . \"{$field->getName()}_y\"; }
";  
        break;
      }
    }
  }

  protected function aggregatePk(){
    $this->string .= "
  public function minId() { return \$this->mapping->minId() . \" AS \" . \$this->_pf() . \"min_id\"; }
  public function maxId() { return \$this->mapping->maxId() . \" AS \" . \$this->_pf() . \"max_id\"; }
  public function countId() { return \$this->mapping->countId() . \" AS \" . \$this->_pf() . \"count_id\"; }

";
  }

  protected function aggregateNf(){
    foreach ($this->getEntity()->getFieldsNf() as $field){
      switch($field->getDataType()){
        case "float": case "integer":
          $this->string .= "  public function sum" . $field->getName('XxYy') . "() { return \$this->mapping->sum" . $field->getName('XxYy') . "() . \" AS \" . \$this->_pf() . \"sum_{$field->getName()}\"; }
  public function avg" . $field->getName('XxYy') . "() { return \$this->mapping->avg" . $field->getName('XxYy') . "() . \" AS \" . \$this->_pf() . \"avg_{$field->getName()}\"; }
  public function min" . $field->getName('XxYy') . "() { return \$this->mapping->min" . $field->getName('XxYy') . "() . \" AS \" . \$this->_pf() . \"min_{$field->getName()}\"; }
  public function max" . $field->getName('XxYy') . "() { return \$this->mapping->max" . $field->getName('XxYy') . "() . \" AS \" . \$this->_pf() . \"max_{$field->getName()}\"; }
  public function count" . $field->getName('XxYy') . "() { return \$this->mapping->count" . $field->getName('XxYy') . "() . \" AS \" . \$this->_pf() . \"count_{$field->getName()}\"; }

";
        break;
        case "date": case "timestamp":
          $this->string .= "  public function avg" . $field->getName('XxYy') . "() { return \$this->mapping->avg" . $field->getName('XxYy') . "() . \" AS \" . \$this->_pf() . \"avg_{$field->getName()}\"; }
  public function min" . $field->getName('XxYy') . "() { return \$this->mapping->min" . $field->getName('XxYy') . "() . \" AS \" . \$this->_pf() . \"min_{$field->getName()}\"; }
  public function max" . $field->getName('XxYy') . "() { return \$this->mapping->max" . $field->getName('XxYy') . "() . \" AS \" . \$this->_pf() . \"max_{$field->getName()}\"; }
  public function count" . $field->getName('XxYy') . "() { return \$this->mapping->count" . $field->getName('XxYy') . "() . \" AS \" . \$this->_pf() . \"count_{$field->getName()}\"; }

";
        break;
        default:
        $this->string .= "  public function min" . $field->getName('XxYy') . "() { return \$this->mapping->min" . $field->getName('XxYy') . "() . \" AS \" . \$this->_pf() . \"min_{$field->getName()}\"; }
  public function max" . $field->getName('XxYy') . "() { return \$this->mapping->max" . $field->getName('XxYy') . "() . \" AS \" . \$this->_pf() . \"max_{$field->getName()}\"; }
  public function count" . $field->getName('XxYy') . "() { return \$this->mapping->count" . $field->getName('XxYy') . "() . \" AS \" . \$this->_pf() . \"count_{$field->getName()}\"; }

";
        break;
      }

    }
  }

  protected function aggregateFk(){
    foreach ($this->getEntity()->getFieldsFk() as $field){
      $this->string .= "  public function min" . $field->getName("XxYy") . "() { return \$this->mapping->min" . $field->getName('XxYy') . "() . \" AS \" . \$this->_pf() . \"min_{$field->getName()}\"; }
  public function max" . $field->getName("XxYy") . "() { return \$this->mapping->max" . $field->getName('XxYy') . "() . \" AS \" . \$this->_pf() . \"max_{$field->getName()}\"; }
  public function count" . $field->getName("XxYy") . "() { return \$this->mapping->count" . $field->getName('XxYy') . "() . \" AS \" . \$this->_pf() . \"count_{$field->getName()}\"; }

";

    }
  }

  protected function label(){
    $this->string .= "  public function label() { return \$this->mapping->label() . \" AS \" . \$this->_pf() . \"label\"; }

";
  }





}
