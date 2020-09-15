<?php

require_once("GenerateEntityRecursiveFk.php");

class ClassSql_mappingField extends GenerateEntityRecursiveFk {

  protected function start(){
    $this->string .= "  public function mappingField(\$field){
    if(\$f = \$this->container->getMapping(\$this->entity->getName())->_eval(\$field)) return \$f;
";
}

  protected function body(Entity $entity, $prefix) {
    $this->string .= "    if(\$f = \$this->container->getMapping('{$entity->getName()}', '" . $prefix . "')->_eval(\$field)) return \$f;
";
  }

  protected function end(){
  $this->string .= "    throw new Exception(\"Campo no reconocido para {\$this->entity->getName()}: {\$field}\");
  }

";
  }



}
