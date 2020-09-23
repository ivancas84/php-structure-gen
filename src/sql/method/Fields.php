<?php

require_once("GenerateEntityRecursiveFk.php");

class Sql_fields extends GenerateEntityRecursiveFk {
  public $fields = [];

  protected function start(){
    $this->string .= "  public function fields(){
    return implode(\",\", \$this->container->getFieldAlias(\$this->entity->getName())->_toArray()) . ',
' . ";
  }

 
  protected function body(Entity $entity, $prefix){
    $this->string .= "implode(\",\", \$this->container->getFieldAlias('{$entity->getName()}', '{$prefix}')->_toArray()) . ',
' . ";

  }

  protected function end(){
    $pos = strrpos($this->string, ",");
    $this->string = substr_replace($this->string , "" , $pos, 6);
    $this->string .= "
';
  }

";
  }







}
