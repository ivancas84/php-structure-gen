<?php

require_once("GenerateEntity.php");

class GetEntityRelElement extends GenerateEntity {
  protected $names = [];

  protected function defineName($name){
    if (!in_array($name, $this->names)){
      array_push($this->names, $name);
      return $name;
    } else {
      $match = preg_split('/(?<=\D)(?=\d)/', $name);
      $name = (count($match) < 2) ? $name . "1" :  $match[0] . strval((intval($match[1]) + 1));
      return $this->defineName($name);
    }
  }

  public function generate() {
    if(!$this->getEntity()->hasRelationsFk()) return "";

    $this->start();
    $this->defineName($this->getEntity()->getName()); //inicializar names con la entidad actual
    $this->fk($this->entity, array());
    $this->end();

    return $this->string;
  }

  protected function start() {
    $this->string .= "    case '" . $this->entity->getName() . "': return [
";
  }
  
  protected function fk($entity, array $tablesVisited, $prefix = "") {
    array_push ($tablesVisited, $entity->getName());
    $fk = $entity->getFieldsFkNotReferenced($tablesVisited);
    
    $prefixAux = (empty ($prefix)) ? "" : $prefix . "_";

    foreach ($fk as $field) {
      $fieldId = $this->defineName($field->getName());

      $prefixTemp = $prefixAux . $field->getAlias();

      $this->string .= "  '{$prefixTemp}' => ['field_id'=>'{$fieldId}', 'field_name'=>'{$field->getName()}', 'entity_name'=>'{$field->getEntityRef()->getName()}'],
";
      
      if(!in_array($field->getEntityRef()->getName(), $tablesVisited)) $this->fk($field->getEntityRef(), $tablesVisited, $prefixTemp);

    }
  }

  protected function recursive(Entity $entity, array $tablesVisited = NULL) {
    if(is_null($tablesVisited)) $tablesVisited = array();
    array_push ($tablesVisited, $entity->getName());
    $fk = $entity->getFieldsFkNotReferenced($tablesVisited);
    //$u_ = $entity->getFieldsU_NotReferenced($tablesVisited);

    $this->fk($fk, $tablesVisited);
  }

  protected function end() {
    $this->string .= "    ];

";
  }
}
