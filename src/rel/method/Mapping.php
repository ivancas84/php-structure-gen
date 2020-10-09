<?php

require_once("GenerateEntityRecursiveFk.php");

class Rel_mapping extends GenerateEntityRecursiveFk {

  protected function start(){
    $this->string .= "  public function mapping(\$field){
    if(\$f = \$this->container->getMapping(\$this->entityName)->_eval(\$field)) return \$f;
";
}

  protected function body(Entity $entity, $prefix) {
    $this->string .= "    if(\$f = \$this->container->getMapping('{$entity->getName()}', '" . $prefix . "')->_eval(\$field)) return \$f;
";
  }

  protected function end(){
  $this->string .= "    throw new Exception(\"Campo no reconocido para {\$this->entityName}: {\$field}\");
  }

";
  }



}