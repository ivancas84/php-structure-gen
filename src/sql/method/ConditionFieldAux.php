<?php


require_once("GenerateEntityRecursiveFk.php");

class ClassSql_conditionFieldAux extends GenerateEntityRecursiveFk{



  protected function start(){
    $this->string .= "  protected function conditionFieldAux(\$field, \$option, \$value) {
    if(\$c = \$this->container->getConditionAux(\$this->entity->getName())->_eval(\$field, [\$option, \$value])) return \$c;
";
  }


  protected function body(Entity $entity, $prefix){
    $this->string .= "    if(\$c = \$this->container->getConditionAux('{$entity->getName()}','{$prefix}')->_eval(\$field, [\$option, \$value])) return \$c;
";
  }

  protected function end(){
    $this->string .= "  }

";
  }







}
