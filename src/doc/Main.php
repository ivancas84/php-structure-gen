<?php

require_once("class/model/Entity.php");
require_once("GenerateFileEntity.php");

//Generar codigo de clase
class Doc extends GenerateFileEntity {

  public function __construct(Entity $entity) {
    $directorio = $_SERVER["DOCUMENT_ROOT"]."/".PATH_DOC."/relations/";
    $nombreArchivo = $entity->getName() . ".txt";
    parent::__construct($directorio, $nombreArchivo, $entity);
  }

  protected function generateCode(){
    $this->relations();
    $this->fields();
    $this->uniqueMultiple();
  }

  protected function relations(){
    require_once("doc/Relations.php");
    $g = new Doc_relations($this->getEntity());
    $this->string .=  $g->generate();
  }

  protected function fields(){
    require_once("doc/Fields.php");
    $g = new Doc_fields($this->getEntity());
    $this->string .=  $g->generate();
  }

  protected function uniqueMultiple(){
    
    if(empty($fields = $this->getEntity()->getFieldsUniqueMultiple())) return "";
    $func = function($field) {
      return $field->getName();
    };

    $this->string .= "
UNIQUE MULTIPLE: " . implode(", ", array_map($func, $fields));
  }


}
