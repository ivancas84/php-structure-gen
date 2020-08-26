<?php

require_once("GenerateEntityRecursiveFk.php");

class ClassSql_mappingField extends GenerateEntityRecursiveFk {

  protected function start(){
    $this->string .= "  public function mappingField(\$field){
    if(\$f = \$this->_mappingField(\$field)) return \$f;
";
}

  protected function body(Entity $entity, $prefix) {
    $this->string .= "    if(\$f = \$this->container->getSql('{$entity->getName()}', '" . $prefix . "')->_mappingField(\$field)) return \$f;
";
  }

  protected function end(){
  $this->string .= "    throw new Exception(\"Campo no reconocido para {\$this->entity->getName()}: {\$field}\");
  }

";
  }



}
