<?php


require_once("GenerateEntityRecursiveFk.php");

class EntityRelations_attribRel extends GenerateEntityRecursiveFk{

  protected function start(){
    $this->string .= "    case '" . $this->entity->getName() . "': return [
";
  }


  protected function body(Entity $entity, $prefix){
    $this->string .= "      '{$prefix}' => '{$entity->getName()}',
";
  }

  protected function end(){
    $this->string .= "    ];

";
  }







}
