<?php

require_once("GenerateEntityRecursiveFk.php");

class GenSql_mappingField_label extends GenerateEntityRecursiveFk{

  public $fields = [];

  public function generate(){
    $this->start();
    $this->body($this->entity, null);
    $this->recursive($this->getEntity());
    $this->defineFields();
    $this->end();
    return $this->string;
  }


  protected function start(){
    $this->string .= "      case \$p.'_label': return \"CONCAT_WS(' ',
";
  }

  
  protected function body(Entity $entity, $prefix) {
    $fieldsPkNf = $entity->getFieldsByType(["pk","nf"]);
    $prf = (empty($prefix)) ? "{\$t}." : "{\$p}".$prefix.".";
    foreach($fieldsPkNf as $field){
      if($field->isMain()) array_push($this->fields, $prf.$field->getName()); 
    }
    
  }

  protected function defineFields(){
    $this->string .= implode(", 
", $this->fields);
  }

  protected function end(){
      $this->string .= "
)\";
";
  }


  public function fk(Entity $entity, array $tablesVisited, $prefix){
    $fk = $entity->getFieldsFkNotReferenced($tablesVisited);
    $prf = (empty($prefix)) ? "" : $prefix . "_";
    array_push($tablesVisited, $entity->getName());

    foreach($fk as $field){
      if($field->isMain()) $this->recursive($field->getEntityRef(), $tablesVisited, $prf . $field->getAlias());
    }
  }





}
