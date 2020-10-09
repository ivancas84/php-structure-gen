<?php


require_once("GenerateEntityRecursiveFk.php");

class Rel_conditionAux extends GenerateEntityRecursiveFk{



  protected function start(){
    $this->string .= "  public function conditionAux(\$field, \$option, \$value) {
    if(\$c = \$this->container->getConditionAux(\$this->entityName)->_eval(\$field, [\$option, \$value])) return \$c;
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
